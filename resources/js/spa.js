/**
 * SPA (Single Page Application) Router
 * Enables smooth page transitions without full page reloads
 */

class SPARouter {
    constructor() {
        this.contentContainer = document.getElementById('spa-content');
        this.loadingOverlay = document.getElementById('spa-loading');
        this.currentPath = window.location.pathname;
        this.isLoading = false;
        this.cache = new Map();
        
        this.init();
    }

    init() {
        // Intercept all link clicks
        document.addEventListener('click', (e) => this.handleClick(e));
        
        // Handle browser back/forward buttons
        window.addEventListener('popstate', (e) => this.handlePopState(e));
        
        // Mark initial state
        window.history.replaceState({ path: this.currentPath }, '', this.currentPath);
        
        console.log('SPA Router initialized');
    }

    handleClick(e) {
        // Find the closest anchor tag
        const link = e.target.closest('a');
        
        if (!link) return;
        
        // Check if this link should be handled by SPA
        if (!this.shouldHandle(link)) return;
        
        e.preventDefault();
        
        // Get the pathname from the link's full URL
        let pathname;
        try {
            const url = new URL(link.href);
            pathname = url.pathname;
        } catch (err) {
            pathname = link.getAttribute('href');
        }
        
        // Don't reload if already on this page
        if (pathname === this.currentPath) return;
        
        this.navigateTo(pathname);
    }

    shouldHandle(link) {
        // Skip if link opens in new tab
        if (link.target === '_blank') return false;
        
        const href = link.getAttribute('href');
        
        // Skip if no href
        if (!href) return false;
        
        // Skip anchors
        if (href.startsWith('#')) return false;
        
        // Skip mailto and tel links
        if (href.startsWith('mailto:') || href.startsWith('tel:')) return false;
        
        // Skip file downloads
        if (href.match(/\.(pdf|zip|doc|docx|xls|xlsx)$/i)) return false;
        
        // Get the pathname from the link
        let pathname;
        
        try {
            // Use the link's resolved href property (full URL)
            const url = new URL(link.href);
            
            // Check if it's the same origin (same domain)
            if (url.origin !== window.location.origin) {
                return false; // External link
            }
            
            pathname = url.pathname;
        } catch (e) {
            // If URL parsing fails, assume it's a relative path
            pathname = href.startsWith('/') ? href : '/' + href;
        }
        
        // Skip auth, API, profile, and form routes (these need full page handling)
        const excludedPaths = ['/login', '/register', '/logout', '/api', '/profile'];
        const excludedPatterns = ['/create', '/edit'];
        
        for (const excluded of excludedPaths) {
            if (pathname.startsWith(excluded)) {
                return false;
            }
        }
        
        // Check for form-related patterns (create/edit pages should do full reload for CKEditor)
        for (const pattern of excludedPatterns) {
            if (pathname.includes(pattern)) {
                return false;
            }
        }
        
        return true;
    }

    async navigateTo(path, pushState = true) {
        if (this.isLoading) return;
        
        this.isLoading = true;
        this.showLoading();
        
        try {
            const content = await this.fetchContent(path);
            
            if (pushState) {
                window.history.pushState({ path }, '', path);
            }
            
            await this.updateContent(content, path);
            this.currentPath = path;
            
            // Update page title from response
            this.updatePageMeta(content);
            
            // Scroll to top smoothly
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            // Re-initialize AOS animations
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
            
            // Close mobile menu after navigation
            this.closeMobileMenu();
            
            // Track page view in Google Analytics
            if (typeof gtag === 'function') {
                gtag('config', 'G-55CNWM6VWH', {
                    page_path: path
                });
            }
            
        } catch (error) {
            console.error('Navigation failed:', error);
            // Fallback to normal navigation
            window.location.href = path;
        } finally {
            this.isLoading = false;
            this.hideLoading();
        }
    }

    async fetchContent(path) {
        // Check cache first
        if (this.cache.has(path)) {
            return this.cache.get(path);
        }

        const response = await fetch(path, {
            headers: {
                'X-SPA-Request': 'true',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const html = await response.text();
        
        // Cache the response (limit cache size)
        if (this.cache.size > 20) {
            const firstKey = this.cache.keys().next().value;
            this.cache.delete(firstKey);
        }
        this.cache.set(path, html);

        return html;
    }

    async updateContent(html, path) {
        // Parse the HTML response
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Get the main content
        const newContent = doc.getElementById('spa-content');
        
        if (!newContent) {
            // If no SPA content found, use the main element
            const mainElement = doc.querySelector('main');
            if (mainElement) {
                this.contentContainer.innerHTML = mainElement.innerHTML;
                this.executeInlineScripts(this.contentContainer);
            } else {
                throw new Error('No content found in response');
            }
        } else {
            // Animate out
            this.contentContainer.style.opacity = '0';
            this.contentContainer.style.transform = 'translateY(20px)';
            
            await this.sleep(200);
            
            // Update content
            this.contentContainer.innerHTML = newContent.innerHTML;
            
            // Execute any inline scripts in the new content
            this.executeInlineScripts(this.contentContainer);
            
            // Animate in
            requestAnimationFrame(() => {
                this.contentContainer.style.opacity = '1';
                this.contentContainer.style.transform = 'translateY(0)';
            });
        }
        
        // Update active navigation state
        this.updateActiveNav(path);
    }

    // Execute inline scripts after SPA content load
    executeInlineScripts(container) {
        const scripts = container.querySelectorAll('script');
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            
            // Copy attributes
            Array.from(oldScript.attributes).forEach(attr => {
                newScript.setAttribute(attr.name, attr.value);
            });
            
            // Copy inline script content
            if (oldScript.textContent) {
                newScript.textContent = oldScript.textContent;
            }
            
            // Replace old script with new one to execute it
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });
    }

    updatePageMeta(html) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        
        // Update title
        const newTitle = doc.querySelector('title');
        if (newTitle) {
            document.title = newTitle.textContent;
        }
        
        // Update meta description
        const newDescription = doc.querySelector('meta[name="description"]');
        const currentDescription = document.querySelector('meta[name="description"]');
        if (newDescription && currentDescription) {
            currentDescription.setAttribute('content', newDescription.getAttribute('content'));
        }
    }

    updateActiveNav(path) {
        // Handle frontend navigation (.nav-link)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
            try {
                const url = new URL(link.href);
                if (url.pathname === path || (path !== '/' && path.startsWith(url.pathname) && url.pathname !== '/')) {
                    link.classList.add('active');
                }
            } catch (e) {}
        });
        
        // Handle admin sidebar navigation (.sidebar-link)
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.classList.remove('active');
            try {
                const url = new URL(link.href);
                // Check exact match or if current path starts with link path
                if (url.pathname === path || (path.startsWith(url.pathname) && url.pathname !== '/admin' && url.pathname !== '/admin/')) {
                    link.classList.add('active');
                }
                // Special case for dashboard
                if ((url.pathname === '/admin' || url.pathname === '/admin/dashboard') && 
                    (path === '/admin' || path === '/admin/' || path === '/admin/dashboard')) {
                    link.classList.add('active');
                }
            } catch (e) {}
        });
    }

    handlePopState(e) {
        if (e.state && e.state.path) {
            this.navigateTo(e.state.path, false);
        }
    }

    showLoading() {
        if (this.loadingOverlay) {
            this.loadingOverlay.classList.add('active');
        }
    }

    hideLoading() {
        if (this.loadingOverlay) {
            this.loadingOverlay.classList.remove('active');
        }
    }

    sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    // Clear cache (useful for forms that change content)
    clearCache() {
        this.cache.clear();
    }

    // Prefetch a page (for hover effects)
    prefetch(path) {
        if (!this.cache.has(path)) {
            this.fetchContent(path).catch(() => {});
        }
    }

    // Close mobile menu (works with Alpine.js)
    closeMobileMenu() {
        // Find the body element which has the Alpine.js mobileMenuOpen state
        const body = document.body;
        if (body && body._x_dataStack) {
            // Alpine.js v3 - access the data stack
            const alpineData = body._x_dataStack[0];
            if (alpineData && typeof alpineData.mobileMenuOpen !== 'undefined') {
                alpineData.mobileMenuOpen = false;
            }
        }
        
        // Alternative: dispatch a custom event for mobile menu close
        window.dispatchEvent(new CustomEvent('closeMobileMenu'));
    }
}

// Page Transition Effects
class PageTransition {
    constructor() {
        this.overlay = this.createOverlay();
        document.body.appendChild(this.overlay);
    }

    createOverlay() {
        const overlay = document.createElement('div');
        overlay.className = 'page-transition-overlay';
        overlay.innerHTML = `
            <div class="page-transition-inner">
                <div class="transition-bar"></div>
            </div>
        `;
        return overlay;
    }

    async enter() {
        this.overlay.classList.add('entering');
        await this.sleep(400);
    }

    async leave() {
        this.overlay.classList.remove('entering');
        this.overlay.classList.add('leaving');
        await this.sleep(400);
        this.overlay.classList.remove('leaving');
    }

    sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
}

// Initialize SPA when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize SPA on all pages except auth pages
    const excludedPaths = ['/login', '/register', '/logout'];
    const currentPath = window.location.pathname;
    
    const shouldInitialize = !excludedPaths.some(path => currentPath.startsWith(path));
    
    if (shouldInitialize) {
        window.spaRouter = new SPARouter();
        
        // Add prefetch on hover for better UX
        document.addEventListener('mouseover', (e) => {
            const link = e.target.closest('a');
            if (link && window.spaRouter.shouldHandle(link)) {
                try {
                    const url = new URL(link.href);
                    window.spaRouter.prefetch(url.pathname);
                } catch (err) {
                    window.spaRouter.prefetch(link.getAttribute('href'));
                }
            }
        });
        
        console.log('SPA Router initialized for:', currentPath.startsWith('/admin') ? 'Admin' : 'Frontend');
    }
});

// Export for ES modules
export { SPARouter, PageTransition };
