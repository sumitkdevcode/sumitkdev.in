/**
 * SPA (Single Page Application) Router
 * Enables smooth page transitions without full page reloads
 *
 * Fixed issues:
 * - Blog AJAX pagination conflict (separate SPA header from XHR)
 * - AOS animations not re-triggering after navigation
 * - Alpine.js components not re-initializing
 * - Inline scripts (infinite scroll, image viewers) not re-executing
 * - Contact form and pagination pages handled correctly
 */

class SPARouter {
    constructor() {
        this.contentContainer = document.getElementById('spa-content');
        this.loadingOverlay = document.getElementById('spa-loading');
        this.currentPath = window.location.pathname;
        this.isLoading = false;

        // No caching — prevents stale content issues
        this.init();
    }

    init() {
        // Intercept all link clicks
        document.addEventListener('click', (e) => this.handleClick(e));

        // Handle browser back/forward buttons
        window.addEventListener('popstate', (e) => this.handlePopState(e));

        // Mark initial state
        window.history.replaceState({ path: this.currentPath }, '', this.currentPath);
    }

    handleClick(e) {
        // Find the closest anchor tag
        const link = e.target.closest('a');

        if (!link) return;

        // Check if this link should be handled by SPA
        if (!this.shouldHandle(link)) return;

        e.preventDefault();

        // Get the pathname from the link's full URL
        let targetUrl;
        try {
            targetUrl = new URL(link.href);
        } catch (err) {
            return; // Invalid URL, let browser handle
        }

        // Build full path including query string (for pagination)
        const fullPath = targetUrl.pathname + targetUrl.search;

        // Don't reload if already on this exact page
        if (fullPath === this.currentPath + window.location.search) return;

        this.navigateTo(fullPath);
    }

    shouldHandle(link) {
        // Skip if modifier keys are pressed (open in new tab behavior)
        if (link.closest('form')) return false;

        // Skip if link opens in new tab
        if (link.target === '_blank') return false;

        const href = link.getAttribute('href');

        // Skip if no href
        if (!href) return false;

        // Skip anchors and javascript: links
        if (href.startsWith('#') || href.startsWith('javascript:')) return false;

        // Skip mailto and tel links
        if (href.startsWith('mailto:') || href.startsWith('tel:')) return false;

        // Skip file downloads
        if (href.match(/\.(pdf|zip|doc|docx|xls|xlsx)$/i)) return false;

        // Get the URL object from the link
        let url;
        try {
            url = new URL(link.href);

            // Check if it's the same origin (same domain)
            if (url.origin !== window.location.origin) {
                return false; // External link
            }
        } catch (e) {
            return false;
        }

        const pathname = url.pathname;

        // Skip auth, API, profile, and admin routes completely
        const excludedPrefixes = ['/login', '/register', '/logout', '/api', '/profile', '/admin'];
        for (const excluded of excludedPrefixes) {
            if (pathname.startsWith(excluded)) {
                return false;
            }
        }

        // Skip form-related patterns (create/edit pages)
        const excludedPatterns = ['/create', '/edit'];
        for (const pattern of excludedPatterns) {
            if (pathname.includes(pattern)) {
                return false;
            }
        }

        return true;
    }

    async navigateTo(fullPath, pushState = true) {
        if (this.isLoading) return;

        this.isLoading = true;
        this.showLoading();

        try {
            const html = await this.fetchPage(fullPath);

            // Parse the full page HTML
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            // Get the #spa-content from the response
            const newContent = doc.getElementById('spa-content');

            if (!newContent) {
                // Fallback: If no #spa-content found, do a full page reload
                throw new Error('No #spa-content found in response');
            }

            if (pushState) {
                window.history.pushState({ path: fullPath }, '', fullPath);
            }

            // Animate out current content
            this.contentContainer.style.opacity = '0';
            this.contentContainer.style.transform = 'translateY(20px)';

            await this.sleep(200);

            // Swap content
            this.contentContainer.innerHTML = newContent.innerHTML;

            // Execute inline scripts in new content
            this.executeInlineScripts(this.contentContainer);

            // Animate in new content
            requestAnimationFrame(() => {
                this.contentContainer.style.opacity = '1';
                this.contentContainer.style.transform = 'translateY(0)';
            });

            // Update page metadata
            this.updatePageMeta(doc);

            // Update active navigation state
            const pathOnly = fullPath.split('?')[0];
            this.updateActiveNav(pathOnly);
            this.currentPath = pathOnly;

            // Scroll to top smoothly
            window.scrollTo({ top: 0, behavior: 'smooth' });

            // Re-initialize third-party libraries
            this.reinitializeLibraries();

            // Close mobile menu after navigation
            this.closeMobileMenu();

            // Track page view in Google Analytics
            if (typeof gtag === 'function') {
                gtag('config', 'G-55CNWM6VWH', {
                    page_path: fullPath
                });
            }

        } catch (error) {
            console.error('SPA navigation failed:', error);
            // Fallback to normal navigation
            window.location.href = fullPath;
        } finally {
            this.isLoading = false;
            this.hideLoading();
        }
    }

    async fetchPage(path) {
        const response = await fetch(path, {
            headers: {
                // Use only X-SPA-Request, NOT X-Requested-With
                // This prevents the blog controller from treating SPA requests
                // as AJAX pagination requests
                'X-SPA-Request': 'true'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        return await response.text();
    }

    /**
     * Execute inline scripts after content swap.
     * This is needed because innerHTML doesn't execute <script> tags.
     */
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

    /**
     * Re-initialize AOS and Alpine.js after SPA navigation
     */
    reinitializeLibraries() {
        // Re-initialize AOS animations
        if (typeof AOS !== 'undefined') {
            // Remove all existing AOS attributes/classes first
            document.querySelectorAll('.aos-init, .aos-animate').forEach(el => {
                el.classList.remove('aos-init', 'aos-animate');
            });

            // Re-initialize AOS completely
            AOS.init({
                duration: 1000,
                once: true,
                easing: 'ease-out-cubic'
            });
        }

        // Re-initialize Alpine.js components in the new content
        if (typeof Alpine !== 'undefined') {
            // Alpine v3: Initialize tree on the new content container
            Alpine.initTree(this.contentContainer);
        }
    }

    updatePageMeta(doc) {
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

        // Update canonical URL
        const newCanonical = doc.querySelector('link[rel="canonical"]');
        const currentCanonical = document.querySelector('link[rel="canonical"]');
        if (newCanonical && currentCanonical) {
            currentCanonical.setAttribute('href', newCanonical.getAttribute('href'));
        }

        // Update OG tags
        const ogTags = ['og:title', 'og:description', 'og:image', 'og:url', 'og:type'];
        ogTags.forEach(tag => {
            const newTag = doc.querySelector(`meta[property="${tag}"]`);
            const currentTag = document.querySelector(`meta[property="${tag}"]`);
            if (newTag && currentTag) {
                currentTag.setAttribute('content', newTag.getAttribute('content'));
            }
        });
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
                if (url.pathname === path || (path.startsWith(url.pathname) && url.pathname !== '/admin' && url.pathname !== '/admin/')) {
                    link.classList.add('active');
                }
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

    // Close mobile menu (works with Alpine.js)
    closeMobileMenu() {
        window.dispatchEvent(new CustomEvent('closeMobileMenu'));
    }
}

// Initialize SPA when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Only initialize on frontend pages (not auth or admin)
    const excludedPaths = ['/login', '/register', '/logout', '/admin'];
    const currentPath = window.location.pathname;

    const shouldInitialize = !excludedPaths.some(path => currentPath.startsWith(path));

    if (shouldInitialize) {
        window.spaRouter = new SPARouter();
    }
});

// Export for ES modules
export { SPARouter };
