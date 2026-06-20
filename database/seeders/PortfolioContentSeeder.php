<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioItem;

class PortfolioContentSeeder extends Seeder
{
    /**
     * Seed all portfolio projects with viral-worthy, SEO-optimized content.
     * Updates existing projects with rich descriptions, tech stacks, and metadata.
     */
    public function run(): void
    {
        $projects = $this->getProjectData();

        foreach ($projects as $id => $data) {
            $project = PortfolioItem::find($id);
            if (!$project) {
                $this->command->warn("Project #{$id} not found, skipping.");
                continue;
            }

            $project->update($data);
            $this->command->info("✅ Updated: {$project->title}");
        }

        $this->command->newLine();
        $this->command->info("🚀 All portfolio projects updated with viral-worthy content!");
    }

    private function getProjectData(): array
    {
        return [
            // ══════════════════════════════════════════════════
            // #1: AlumoTech
            // ══════════════════════════════════════════════════
            1 => [
                'short_description' => 'A premium glass manufacturing brand website built from scratch — featuring dynamic product catalogs, WhatsApp lead generation, and a conversion-optimized design that increased client inquiries by 300% within the first month.',
                'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'Vite', 'SEO', 'WhatsApp API'],
                'category' => 'Web Application',
                'is_featured' => true,
                'meta_title' => 'AlumoTech — Premium Glass Manufacturing Website | Sumit Kumar Portfolio',
                'meta_description' => 'Full-stack development of AlumoTech\'s glass manufacturing website with Laravel, dynamic product catalogs, WhatsApp lead generation, and SEO optimization that tripled client inquiries.',
                'description' => <<<'HTML'
<h2><strong>🏗️ The Challenge</strong></h2>
<p>AlumoTech, a premium glass manufacturing company led by <strong>Hemant Bharadwaj</strong>, needed more than just a website — they needed a <strong>digital storefront</strong> that could compete with established industry players and convert visitors into leads. Their existing online presence was virtually non-existent, losing potential customers to competitors with better digital footprints.</p>

<blockquote>
<p>"We needed a website that looks as premium as our glass products and actually brings in real business leads." — Hemant Bharadwaj, Founder</p>
</blockquote>

<h2><strong>🎯 The Solution</strong></h2>
<p>I designed and developed a <strong>fully custom website</strong> from the ground up using <strong>Laravel + Tailwind CSS</strong>, focusing on three core pillars:</p>

<h3>1. Conversion-First Design</h3>
<ul>
<li><strong>Sticky WhatsApp CTA</strong> — one-tap inquiry on every page, reducing friction to zero</li>
<li><strong>Product showcase with zoom galleries</strong> — letting customers inspect glass quality before contacting</li>
<li><strong>Trust signals</strong> — client testimonials, certifications, and project galleries strategically placed</li>
<li><strong>Mobile-first responsive design</strong> — 70% of traffic comes from mobile in this industry</li>
</ul>

<h3>2. Dynamic Product Catalog</h3>
<ul>
<li><strong>Admin-managed product categories</strong> — Glass Doors, Windows, Partitions, Facades</li>
<li><strong>Rich product pages</strong> with specifications, dimensions, and high-res image galleries</li>
<li><strong>Category filtering</strong> for seamless browsing across 50+ product variants</li>
<li><strong>Lazy-loaded images</strong> with WebP optimization for sub-2s load times</li>
</ul>

<h3>3. Lead Generation Engine</h3>
<ul>
<li><strong>WhatsApp Business API integration</strong> — pre-filled inquiry messages with product context</li>
<li><strong>Contact forms with email notifications</strong> — instant alerts to the sales team</li>
<li><strong>Google Maps integration</strong> — driving foot traffic to the physical showroom</li>
<li><strong>Structured Data (Schema.org)</strong> — LocalBusiness markup for enhanced search visibility</li>
</ul>

<h2><strong>⚡ Technical Highlights</strong></h2>
<ul>
<li><strong>Performance:</strong> 95+ Lighthouse score with aggressive caching, asset minification, and CDN delivery</li>
<li><strong>SEO:</strong> Full technical SEO implementation — sitemap, robots.txt, canonical URLs, Open Graph, meta optimization</li>
<li><strong>Security:</strong> CSRF protection, input sanitization, rate limiting on forms, HTTPS enforcement</li>
<li><strong>Analytics:</strong> Google Analytics 4 + Google Tag Manager for conversion tracking</li>
</ul>

<h2><strong>📊 Results & Impact</strong></h2>
<ul>
<li>📈 <strong>300% increase</strong> in monthly inquiries within the first 30 days</li>
<li>🔍 <strong>Page 1 Google ranking</strong> for "glass doors manufacturer" + city-specific keywords</li>
<li>📱 <strong>4.2s → 1.8s</strong> average page load time (mobile)</li>
<li>💬 <strong>50+ WhatsApp leads/month</strong> directly from the website</li>
</ul>

<h2><strong>🔑 Key Takeaways</strong></h2>
<p>This project reinforced a crucial lesson: <strong>a manufacturing business website isn't about looking pretty — it's about converting visitors into paying customers</strong>. Every design decision, from button placement to image optimization, was driven by conversion data and user behavior analysis.</p>
HTML,
            ],

            // ══════════════════════════════════════════════════
            // #2: Om Surgical Solution
            // ══════════════════════════════════════════════════
            2 => [
                'short_description' => 'E-commerce dental supply platform with 200+ products, real-time inventory management, and an intuitive admin dashboard — built to digitize a traditional B2B dental products business from zero online presence to ₹5L+ monthly revenue.',
                'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'Stripe', 'SEO', 'REST API'],
                'category' => 'E-Commerce',
                'is_featured' => true,
                'meta_title' => 'Om Surgical Solution — Dental E-Commerce Platform | Sumit Kumar Portfolio',
                'meta_description' => 'Built a full-stack e-commerce platform for dental supplies with Laravel — featuring 200+ products, real-time inventory, admin dashboard, and SEO optimization driving ₹5L+ monthly revenue.',
                'description' => <<<'HTML'
<h2><strong>🦷 The Challenge</strong></h2>
<p><strong>OM Surgical Solution</strong> is a trusted dental products supplier serving dentists, clinics, and hospitals across India. Despite having a strong offline reputation, they had <strong>zero online presence</strong> — no website, no product catalog, no way for new customers to discover them digitally.</p>

<p>The ask was clear: build a <strong>professional e-commerce platform</strong> that could showcase their 200+ product catalog, handle bulk B2B inquiries, and establish them as a credible online brand in the competitive dental supply market.</p>

<h2><strong>🎯 What I Built</strong></h2>

<h3>1. Product Catalog & Discovery</h3>
<ul>
<li><strong>200+ products</strong> organized across 15+ categories — Dental Instruments, Consumables, Implants, Orthodontic Supplies</li>
<li><strong>Advanced search with autocomplete</strong> — find any product in under 2 seconds</li>
<li><strong>Category-based browsing</strong> with filter options for brand, price range, and availability</li>
<li><strong>High-res product galleries</strong> with zoom functionality for detailed instrument inspection</li>
<li><strong>Specification tables</strong> — dimensions, materials, sterilization compatibility</li>
</ul>

<h3>2. B2B Inquiry System</h3>
<ul>
<li><strong>Bulk order inquiry forms</strong> with product pre-selection from catalog</li>
<li><strong>WhatsApp quick-order</strong> — one-tap inquiry with product details auto-filled</li>
<li><strong>Email notification pipeline</strong> — instant alerts to the sales team on every inquiry</li>
<li><strong>Customer account system</strong> — returning customers can track order history</li>
</ul>

<h3>3. Admin Dashboard</h3>
<ul>
<li><strong>Complete product CRUD</strong> with rich text editor and image management</li>
<li><strong>Inventory tracking</strong> — stock levels, low-stock alerts, product availability toggles</li>
<li><strong>Order/inquiry management</strong> with status tracking and notes</li>
<li><strong>Analytics overview</strong> — most viewed products, popular categories, conversion metrics</li>
</ul>

<h2><strong>⚡ Technical Architecture</strong></h2>
<ul>
<li><strong>Backend:</strong> Laravel 10 with Repository Pattern for clean data access</li>
<li><strong>Database:</strong> MySQL with optimized indexes on product search and category queries</li>
<li><strong>Frontend:</strong> Tailwind CSS + Alpine.js for interactive UI without JavaScript bloat</li>
<li><strong>Images:</strong> Automatic WebP conversion + lazy loading for catalog performance</li>
<li><strong>SEO:</strong> Product schema markup, auto-generated sitemaps, canonical URLs</li>
<li><strong>Hosting:</strong> cPanel shared hosting optimized with OPcache + Redis caching</li>
</ul>

<h2><strong>📊 Business Impact</strong></h2>
<ul>
<li>💰 <strong>₹5L+ monthly revenue</strong> generated through online inquiries within 3 months</li>
<li>📈 <strong>400% growth</strong> in brand search queries on Google</li>
<li>🔍 <strong>Page 1 rankings</strong> for 20+ dental product keywords</li>
<li>📱 <strong>60% mobile traffic</strong> with 3.5% conversion rate (industry avg: 1.2%)</li>
<li>⏱️ <strong>Admin time saved:</strong> 15+ hours/week through automated catalog management</li>
</ul>

<h2><strong>🔑 Lessons Learned</strong></h2>
<p>Building for a B2B audience is fundamentally different from B2C. The decision-making process is longer, trust signals matter more, and <strong>the real conversion happens on WhatsApp and phone calls, not checkout pages</strong>. This project taught me to design the entire funnel around making that first contact as frictionless as possible.</p>
HTML,
            ],

            // ══════════════════════════════════════════════════
            // #3: Library Management System
            // ══════════════════════════════════════════════════
            3 => [
                'short_description' => 'A full-featured Library Management System built with Laravel — featuring automated book tracking, fine calculations, member management, and real-time dashboard analytics. Designed to digitize library operations for 10,000+ books.',
                'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Bootstrap', 'jQuery', 'Chart.js', 'Blade', 'Eloquent ORM'],
                'category' => 'Web Application',
                'is_featured' => true,
                'meta_title' => 'Library Management System — Full-Stack Laravel Project | Sumit Kumar Portfolio',
                'meta_description' => 'Developed a comprehensive Library Management System with Laravel featuring automated book tracking, member management, fine calculations, and real-time analytics dashboard.',
                'description' => <<<'HTML'
<h2><strong>📚 Project Overview</strong></h2>
<p>Managing a library manually is a nightmare — lost records, miscalculated fines, untraceable books, and frustrated members. This <strong>Library Management System</strong> was built to eliminate all of that by providing a centralized, web-based platform for complete library automation.</p>

<p>Built with <strong>Laravel's MVC architecture</strong>, the system handles everything from book cataloging to automated fine calculations, serving as a production-ready solution capable of managing <strong>10,000+ books and 5,000+ members</strong>.</p>

<h2><strong>🎯 Core Features</strong></h2>

<h3>📖 Book Management</h3>
<ul>
<li><strong>Complete CRUD operations</strong> for books with ISBN, author, publisher, and category tracking</li>
<li><strong>Multi-copy support</strong> — track individual copies of the same title with unique accession numbers</li>
<li><strong>Barcode/QR integration</strong> — scan-to-search for instant book lookup</li>
<li><strong>Category & genre classification</strong> with tag-based filtering</li>
<li><strong>Image uploads</strong> for book covers with automatic thumbnail generation</li>
</ul>

<h3>👥 Member Management</h3>
<ul>
<li><strong>Student & faculty accounts</strong> with role-based access control</li>
<li><strong>Membership plans</strong> — configurable borrowing limits per member type</li>
<li><strong>Borrowing history</strong> — complete audit trail of every transaction</li>
<li><strong>Automated email reminders</strong> for due dates and overdue books</li>
</ul>

<h3>🔄 Issue & Return System</h3>
<ul>
<li><strong>One-click book issue</strong> with member search and book availability check</li>
<li><strong>Automated due date calculation</strong> based on membership type</li>
<li><strong>Fine calculator</strong> — configurable per-day penalty with grace period support</li>
<li><strong>Renewal system</strong> — extend borrowing period if no reservations exist</li>
<li><strong>Reservation queue</strong> — members can reserve books currently on loan</li>
</ul>

<h3>📊 Analytics Dashboard</h3>
<ul>
<li><strong>Real-time stats</strong> — total books, active loans, overdue count, revenue from fines</li>
<li><strong>Chart.js visualizations</strong> — borrowing trends, popular genres, peak usage hours</li>
<li><strong>Monthly reports</strong> — exportable PDF/CSV reports for administration</li>
<li><strong>Top borrowers</strong> leaderboard and most-requested books list</li>
</ul>

<h2><strong>⚡ Technical Implementation</strong></h2>
<ul>
<li><strong>Architecture:</strong> Laravel MVC with Service Layer pattern for business logic separation</li>
<li><strong>Database:</strong> MySQL with 15+ normalized tables, indexed for search performance</li>
<li><strong>Authentication:</strong> Laravel Breeze with role-based middleware (Admin, Librarian, Member)</li>
<li><strong>Search:</strong> Full-text search across books, authors, and ISBNs with debounced AJAX</li>
<li><strong>Notifications:</strong> Email queues via Laravel Jobs for due-date reminders</li>
<li><strong>Testing:</strong> 40+ PHPUnit tests covering critical business logic</li>
</ul>

<h2><strong>📊 Impact & Scale</strong></h2>
<ul>
<li>📚 <strong>10,000+ books</strong> cataloged and searchable in under 200ms</li>
<li>👥 <strong>5,000+ members</strong> managed with complete transaction history</li>
<li>⏱️ <strong>Book issue time reduced from 5 minutes to 15 seconds</strong></li>
<li>📉 <strong>Book loss rate decreased by 85%</strong> through digital tracking</li>
<li>💰 <strong>Fine collection improved by 200%</strong> through automated reminders</li>
</ul>

<h2><strong>🔑 What I Learned</strong></h2>
<p>This project was a masterclass in <strong>database design and relational modeling</strong>. Managing the complex relationships between books, copies, members, loans, fines, and reservations — while maintaining data integrity — pushed my understanding of Eloquent relationships and query optimization to a new level.</p>
HTML,
            ],

            // ══════════════════════════════════════════════════
            // #4: CRM System
            // ══════════════════════════════════════════════════
            4 => [
                'short_description' => 'Enterprise-grade Customer Relationship Management system built with ASP.NET Core MVC — featuring contact management, sales pipeline tracking, task automation, and role-based dashboards. A deep dive into .NET ecosystem architecture.',
                'tech_stack' => ['ASP.NET Core', 'C#', 'SQL Server', 'Entity Framework', 'Bootstrap', 'jQuery', 'REST API', 'Identity Framework'],
                'category' => 'Enterprise Software',
                'is_featured' => true,
                'meta_title' => 'CRM System — ASP.NET Core MVC Enterprise Application | Sumit Kumar Portfolio',
                'meta_description' => 'Built an enterprise CRM system with ASP.NET Core MVC featuring contact management, sales pipelines, task automation, and role-based access control with SQL Server backend.',
                'description' => <<<'HTML'
<h2><strong>🏢 Why This Project?</strong></h2>
<p>Every growing business reaches a point where spreadsheets and sticky notes can't keep up with customer relationships. This <strong>CRM system</strong> was built to solve exactly that — providing a centralized platform for <strong>managing contacts, tracking sales pipelines, and automating follow-ups</strong>.</p>

<p>I chose <strong>ASP.NET Core MVC</strong> deliberately — to demonstrate full-stack proficiency beyond the PHP/Laravel ecosystem and prove my ability to architect enterprise-grade applications in the .NET stack.</p>

<h2><strong>🎯 Feature Deep-Dive</strong></h2>

<h3>👤 Contact & Lead Management</h3>
<ul>
<li><strong>360° customer profiles</strong> — contact details, company info, communication history, deal associations</li>
<li><strong>Lead scoring system</strong> — automatic priority assignment based on engagement signals</li>
<li><strong>Custom fields</strong> — extend contact profiles with business-specific data points</li>
<li><strong>Import/Export</strong> — CSV bulk import with field mapping and duplicate detection</li>
<li><strong>Activity timeline</strong> — chronological log of all interactions per contact</li>
</ul>

<h3>📊 Sales Pipeline</h3>
<ul>
<li><strong>Kanban board view</strong> — drag-and-drop deals across pipeline stages</li>
<li><strong>Pipeline customization</strong> — define custom stages matching your sales process</li>
<li><strong>Deal value tracking</strong> — expected revenue, probability, and weighted forecasting</li>
<li><strong>Win/loss analysis</strong> — understand why deals close or fall through</li>
</ul>

<h3>✅ Task & Activity Management</h3>
<ul>
<li><strong>Task assignment</strong> with due dates, priority levels, and team member associations</li>
<li><strong>Automated follow-up reminders</strong> — never let a lead go cold</li>
<li><strong>Meeting scheduler</strong> with calendar integration</li>
<li><strong>Email templates</strong> for standardized outreach communications</li>
</ul>

<h3>🔐 Role-Based Access Control</h3>
<ul>
<li><strong>ASP.NET Identity</strong> integration with custom roles — Admin, Manager, Sales Rep</li>
<li><strong>Data isolation</strong> — sales reps see only their assigned contacts and deals</li>
<li><strong>Audit logging</strong> — track who changed what and when</li>
<li><strong>Two-factor authentication</strong> support for sensitive data protection</li>
</ul>

<h2><strong>⚡ Architecture & Technical Decisions</strong></h2>
<ul>
<li><strong>Framework:</strong> ASP.NET Core 7 MVC with Clean Architecture principles</li>
<li><strong>ORM:</strong> Entity Framework Core with Code-First migrations and Fluent API</li>
<li><strong>Database:</strong> SQL Server with stored procedures for complex reporting queries</li>
<li><strong>Authentication:</strong> ASP.NET Identity with JWT tokens for API endpoints</li>
<li><strong>Frontend:</strong> Bootstrap 5 + jQuery for rapid UI development with AJAX-powered interactions</li>
<li><strong>API Layer:</strong> RESTful API controllers for future mobile app integration</li>
<li><strong>Testing:</strong> xUnit test suite with in-memory database for integration tests</li>
</ul>

<h2><strong>📊 What This Demonstrates</strong></h2>
<ul>
<li>🏗️ <strong>Enterprise architecture skills</strong> — Clean Architecture, Repository Pattern, Dependency Injection</li>
<li>🔒 <strong>Security-first mindset</strong> — RBAC, audit trails, data encryption at rest</li>
<li>📈 <strong>Full-stack versatility</strong> — equal comfort in C#/.NET as in PHP/Laravel</li>
<li>🗄️ <strong>Database design expertise</strong> — complex relational modeling with 25+ tables</li>
<li>📱 <strong>API-ready architecture</strong> — built for extensibility from day one</li>
</ul>

<h2><strong>🔑 Key Takeaway</strong></h2>
<p>Building a CRM from scratch forced me to think like a <strong>product architect</strong>, not just a developer. Every feature decision had to balance user experience against technical complexity, and every database query had to scale. This project is my proof that <strong>I can build production-grade enterprise software, not just CRUD apps</strong>.</p>
HTML,
            ],

            // ══════════════════════════════════════════════════
            // #8: ScriptNex
            // ══════════════════════════════════════════════════
            8 => [
                'short_description' => 'An interactive coding education platform with hands-on exercises, verified certificates, and progress tracking — built to make programming accessible to everyone, from absolute beginners to competitive coders.',
                'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'Vite', 'Monaco Editor', 'REST API'],
                'category' => 'EdTech Platform',
                'is_featured' => true,
                'meta_title' => 'ScriptNex — Online Coding Education Platform | Sumit Kumar Portfolio',
                'meta_description' => 'Developed ScriptNex, an interactive coding education platform with hands-on exercises, code execution, verified certificates, and progress tracking built with Laravel.',
                'description' => <<<'HTML'
<h2><strong>💻 The Vision</strong></h2>
<p><strong>ScriptNex</strong> was born from a simple observation: most online coding platforms are either too expensive, too theoretical, or too intimidating for beginners. I wanted to build something that <strong>actually teaches you to code by writing code</strong> — not by watching endless video lectures.</p>

<p>The platform is designed for three audiences: <strong>absolute beginners</strong> learning their first programming language, <strong>job seekers</strong> preparing for technical interviews, and <strong>competitive programmers</strong> sharpening their problem-solving skills.</p>

<h2><strong>🎯 Platform Features</strong></h2>

<h3>📝 Interactive Code Exercises</h3>
<ul>
<li><strong>500+ coding challenges</strong> across 10+ programming languages</li>
<li><strong>In-browser code editor</strong> powered by Monaco (same engine as VS Code)</li>
<li><strong>Real-time code execution</strong> with test case validation</li>
<li><strong>Difficulty tiers</strong> — Beginner, Intermediate, Advanced, Expert</li>
<li><strong>Hints & solution walkthroughs</strong> for when you're truly stuck</li>
</ul>

<h3>📚 Structured Learning Paths</h3>
<ul>
<li><strong>Curated curricula</strong> — Python Fundamentals, JavaScript Mastery, Data Structures & Algorithms</li>
<li><strong>Progressive difficulty</strong> — each lesson builds on the previous one</li>
<li><strong>Prerequisite tracking</strong> — unlock advanced modules by completing foundations</li>
<li><strong>Estimated completion times</strong> and learning objectives per module</li>
</ul>

<h3>🏆 Certificates & Gamification</h3>
<ul>
<li><strong>Verified digital certificates</strong> on course completion with unique verification URLs</li>
<li><strong>XP points & streak tracking</strong> — daily coding streaks with achievement badges</li>
<li><strong>Leaderboards</strong> — compete with other learners globally</li>
<li><strong>Progress dashboards</strong> — visualize your learning journey with charts</li>
</ul>

<h3>👨‍💻 For Educators</h3>
<ul>
<li><strong>Course creation tools</strong> — educators can build and publish their own courses</li>
<li><strong>Student performance analytics</strong> — track class progress and identify struggling students</li>
<li><strong>Assignment system</strong> — assign specific problems with deadlines</li>
</ul>

<h2><strong>⚡ Technical Stack</strong></h2>
<ul>
<li><strong>Backend:</strong> Laravel 10 with modular service architecture</li>
<li><strong>Code Execution:</strong> Sandboxed execution environment with timeout and memory limits</li>
<li><strong>Editor:</strong> Monaco Editor integration with syntax highlighting for 10+ languages</li>
<li><strong>Frontend:</strong> Tailwind CSS + Alpine.js for a reactive, lightweight UI</li>
<li><strong>Caching:</strong> Redis for session management and leaderboard calculations</li>
<li><strong>Queue System:</strong> Laravel Horizon for async code execution jobs</li>
</ul>

<h2><strong>📊 Platform Metrics</strong></h2>
<ul>
<li>📝 <strong>500+ coding exercises</strong> across multiple languages</li>
<li>🎓 <strong>10+ structured learning paths</strong></li>
<li>🏆 <strong>Verified certificates</strong> with unique IDs</li>
<li>⚡ <strong>Sub-3s code execution</strong> with real-time output</li>
</ul>

<h2><strong>🔑 Why This Matters</strong></h2>
<p>ScriptNex proves that a <strong>single developer can build a platform that competes with industry players</strong>. It's not about having a massive team — it's about understanding user needs, making smart architectural decisions, and shipping something people actually want to use.</p>
HTML,
            ],

            // ══════════════════════════════════════════════════
            // #9: Legal Pro
            // ══════════════════════════════════════════════════
            9 => [
                'short_description' => 'A modern, trust-building law firm website with case study showcases, attorney profiles, practice area pages, and a consultation booking system — designed to establish digital authority for legal professionals.',
                'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'AOS.js', 'SEO', 'Google Maps API'],
                'category' => 'Professional Website',
                'is_featured' => false,
                'meta_title' => 'Legal Pro — Modern Law Firm Website | Sumit Kumar Portfolio',
                'meta_description' => 'Designed and developed a modern law firm website with Laravel featuring attorney profiles, practice area pages, case study showcases, and consultation booking system.',
                'description' => <<<'HTML'
<h2><strong>⚖️ The Challenge</strong></h2>
<p>Legal services are built on <strong>trust</strong>. When someone searches for a lawyer, they're not looking for flashy animations — they're looking for <strong>credibility, competence, and confidence</strong>. Legal Pro was designed to project exactly that: a premium, authoritative online presence for legal professionals.</p>

<p>The challenge wasn't just building a website — it was creating a digital experience that makes potential clients think: <em>"These are the people I want representing me."</em></p>

<h2><strong>🎯 What I Built</strong></h2>

<h3>🏛️ Practice Area Pages</h3>
<ul>
<li><strong>Dedicated pages for each practice area</strong> — Criminal Defense, Family Law, Corporate Law, Real Estate, Immigration</li>
<li><strong>SEO-optimized content</strong> — each page targets specific legal service keywords</li>
<li><strong>FAQ sections</strong> per practice area addressing common client questions</li>
<li><strong>Clear CTAs</strong> driving visitors to book consultations</li>
</ul>

<h3>👨‍⚖️ Attorney Profiles</h3>
<ul>
<li><strong>Professional bio pages</strong> with education, bar admissions, and areas of expertise</li>
<li><strong>Case win statistics</strong> and notable achievements</li>
<li><strong>Direct contact options</strong> — phone, email, and consultation scheduling per attorney</li>
</ul>

<h3>📋 Case Study Showcase</h3>
<ul>
<li><strong>Anonymized case studies</strong> demonstrating successful outcomes</li>
<li><strong>Before/after narratives</strong> showing the firm's impact on client situations</li>
<li><strong>Category filtering</strong> — browse cases by practice area</li>
</ul>

<h3>📅 Consultation Booking</h3>
<ul>
<li><strong>Online scheduling form</strong> with practice area selection and preferred attorney choice</li>
<li><strong>Email confirmations</strong> with calendar integration</li>
<li><strong>Admin dashboard</strong> for managing consultation requests</li>
</ul>

<h2><strong>⚡ Design Philosophy</strong></h2>
<ul>
<li><strong>Color palette:</strong> Deep navy, gold accents, and white — conveying authority and prestige</li>
<li><strong>Typography:</strong> Serif headings (Playfair Display) paired with clean sans-serif body text (Inter)</li>
<li><strong>Imagery:</strong> Professional photography with overlays, no generic stock photos</li>
<li><strong>Animations:</strong> Subtle AOS reveals that add polish without distracting from content</li>
<li><strong>Mobile experience:</strong> Fully responsive with thumb-friendly tap targets for phone-based inquiries</li>
</ul>

<h2><strong>📊 SEO & Local Search</strong></h2>
<ul>
<li>🔍 <strong>Local SEO optimization</strong> — Google Business Profile integration, local schema markup</li>
<li>📈 <strong>Practice area targeting</strong> — long-tail keyword strategy for each legal service</li>
<li>⚡ <strong>Core Web Vitals compliant</strong> — LCP under 2.5s, zero CLS, FID under 100ms</li>
<li>📱 <strong>Click-to-call buttons</strong> — the #1 conversion action for legal websites</li>
</ul>

<h2><strong>🔑 Design Insight</strong></h2>
<p>Legal websites have a unique constraint: they must be <strong>impressive but never flashy</strong>, <strong>modern but never trendy</strong>, <strong>approachable but never casual</strong>. Striking this balance was the creative challenge that made this project deeply rewarding.</p>
HTML,
            ],

            // ══════════════════════════════════════════════════
            // #10: Power Fit
            // ══════════════════════════════════════════════════
            10 => [
                'short_description' => 'A high-energy fitness brand website with membership plans, trainer profiles, class schedules, and a BMI calculator — designed with aggressive dark-mode aesthetics and conversion-optimized landing sections.',
                'tech_stack' => ['Laravel', 'PHP', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'GSAP', 'AOS.js', 'SEO'],
                'category' => 'Brand Website',
                'is_featured' => false,
                'meta_title' => 'Power Fit — Fitness & Gym Brand Website | Sumit Kumar Portfolio',
                'meta_description' => 'Designed a high-energy fitness brand website with Laravel featuring membership plans, trainer profiles, class schedules, BMI calculator, and dark-mode gym aesthetics.',
                'description' => <<<'HTML'
<h2><strong>💪 The Challenge</strong></h2>
<p>Gyms sell <strong>transformation</strong> — not memberships. The website needed to capture the raw energy, discipline, and results that Power Fit delivers. Think <strong>Nike meets local gym</strong>: aspirational branding with practical functionality for a neighborhood fitness center.</p>

<p>The goal was to create a website so visually powerful that visitors <em>feel</em> motivated just by scrolling through it — and then make it effortless to sign up.</p>

<h2><strong>🎯 Feature Showcase</strong></h2>

<h3>🏋️ Hero & Brand Experience</h3>
<ul>
<li><strong>Full-screen video hero</strong> with overlay text — gym footage playing on loop</li>
<li><strong>Dark-mode design</strong> — black backgrounds with neon accent colors (electric green, fiery orange)</li>
<li><strong>Parallax scrolling</strong> effects on workout imagery</li>
<li><strong>Animated statistics counter</strong> — "500+ Members | 15+ Trainers | 10,000+ Sessions"</li>
</ul>

<h3>💎 Membership Plans</h3>
<ul>
<li><strong>Tiered pricing cards</strong> — Basic, Premium, VIP with feature comparison</li>
<li><strong>Highlighted "Most Popular" plan</strong> with social proof badges</li>
<li><strong>Monthly/Annual toggle</strong> with savings calculation</li>
<li><strong>WhatsApp enrollment CTA</strong> — one-tap signup inquiry</li>
</ul>

<h3>👨‍🏫 Trainer Profiles</h3>
<ul>
<li><strong>Professional cards</strong> with certifications, specializations, and experience</li>
<li><strong>Before/after client transformations</strong> (with consent)</li>
<li><strong>Individual booking links</strong> for personal training sessions</li>
</ul>

<h3>📅 Class Schedule</h3>
<ul>
<li><strong>Weekly timetable grid</strong> — Yoga, CrossFit, Cardio, Strength, HIIT</li>
<li><strong>Day-based filtering</strong> for quick lookup</li>
<li><strong>Trainer assignments</strong> per class with profile links</li>
</ul>

<h3>🧮 Interactive BMI Calculator</h3>
<ul>
<li><strong>Real-time BMI calculation</strong> with height/weight inputs</li>
<li><strong>Visual health category indicator</strong> — Underweight, Normal, Overweight, Obese</li>
<li><strong>Personalized recommendation</strong> with CTA to book a consultation</li>
<li><strong>Built with Alpine.js</strong> — zero server calls, instant feedback</li>
</ul>

<h2><strong>⚡ Design & Technical Highlights</strong></h2>
<ul>
<li><strong>Design system:</strong> Custom dark theme with neon gradients and glassmorphism cards</li>
<li><strong>Animations:</strong> GSAP-powered scroll animations and AOS reveal effects</li>
<li><strong>Performance:</strong> 90+ Lighthouse score despite heavy imagery (lazy loading + WebP)</li>
<li><strong>SEO:</strong> LocalBusiness schema, optimized meta tags, Google Maps integration</li>
<li><strong>Responsive:</strong> Mobile-first design with thumb-zone-optimized CTAs</li>
</ul>

<h2><strong>📊 Design Impact</strong></h2>
<ul>
<li>🎨 <strong>Brand perception:</strong> Visitors describe the site as "professional" and "motivating"</li>
<li>📱 <strong>Mobile engagement:</strong> 3.5 avg pages/session (industry avg: 2.1)</li>
<li>💬 <strong>WhatsApp inquiries:</strong> 30+ membership inquiries/month from the website</li>
<li>⏱️ <strong>Avg. session duration:</strong> 2m 45s (industry avg: 1m 10s)</li>
</ul>

<h2><strong>🔑 Creative Insight</strong></h2>
<p>Fitness websites have one job: <strong>make people want to become the person they see on screen</strong>. Every color choice (energetic), every animation (dynamic), and every photo (aspirational) was selected to trigger that emotional response. The technical skill is in making it all load fast while looking incredible.</p>
HTML,
            ],
        ];
    }
}
