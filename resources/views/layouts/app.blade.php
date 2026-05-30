<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.webp') }}" sizes="48x48" type="image/webp">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.webp') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', strtok(url()->current(), '?'))">
    <link rel="alternate" hreflang="en" href="@yield('canonical_url', strtok(url()->current(), '?'))">
    <link rel="alternate" hreflang="x-default" href="@yield('canonical_url', strtok(url()->current(), '?'))">

    @yield('pagination_meta')

    <!-- Robots -->
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="author" content="Sumit Kumar">
    <meta name="language" content="en">
    <meta name="geo.region" content="IN-UP">
    <meta name="geo.placename" content="Greater Noida, Uttar Pradesh, India">

    <!-- Schema.org Person (Rich Results) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "@id": "{{ url('/') }}/#person",
        "name": "Sumit Kumar",
        "alternateName": ["sumitkdev", "Sumit Kumar Developer", "sumitkdev.in"],
        "url": "{{ url('/') }}",
        "image": "{{ asset('images/og-default.webp') }}",
        "jobTitle": "Full Stack Developer",
        "description": "Sumit Kumar (sumitkdev) is a results-oriented Full Stack Developer & Software Engineer with expertise in Laravel, React, Vue.js, Node.js, and modern web technologies. Available for freelance and full-time opportunities.",
        "email": "contact@sumitkdev.in",
        "telephone": "+91-8303744132",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Greater Noida",
            "addressRegion": "Uttar Pradesh",
            "addressCountry": "IN"
        },
        "alumniOf": [
            {
                "@type": "EducationalOrganization",
                "name": "Gautam Buddha University",
                "url": "https://www.gbu.ac.in"
            },
            {
                "@type": "EducationalOrganization",
                "name": "Galgotias University",
                "url": "https://www.galgotiasuniversity.edu.in"
            }
        ],
        "hasCredential": [
            {
                "@type": "EducationalOccupationalCredential",
                "credentialCategory": "degree",
                "name": "Master of Computer Applications (MCA)"
            },
            {
                "@type": "EducationalOccupationalCredential",
                "credentialCategory": "degree",
                "name": "Bachelor of Computer Applications (BCA)"
            }
        ],
        "knowsAbout": ["Laravel", "React", "Vue.js", "Node.js", "PHP", "JavaScript", "TypeScript", "Python", "MySQL", "PostgreSQL", "Docker", "AWS", "Full Stack Development", "Web Development", "Software Engineering", "ASP.NET Core", "C#", "REST API", "GraphQL"],
        "worksFor": {
            "@type": "Organization",
            "name": "Apex Byte IT Services"
        },
        "sameAs": [
              @php
                  $allLinks = collect();
                  if(isset($globalSocialLinks)) {
                      foreach($globalSocialLinks as $category => $links) {
                          $allLinks = $allLinks->merge($links);
                      }
                  }
              @endphp
              @foreach($allLinks as $link)
                  "{{ $link->url }}"{{ $loop->last ? '' : ',' }}
              @endforeach
          ]
    }
    </script>

    <!-- Schema.org WebSite (Sitelinks Search Box) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "@id": "{{ url('/') }}/#website",
        "name": "Sumit Kumar (sumitkdev) — Full Stack Developer",
        "alternateName": ["sumitkdev", "sumitkdev.in", "Sumit Kumar Developer", "Sumit Kumar Portfolio", "Sumit Kumar Blog"],
        "url": "{{ url('/') }}",
        "description": "Official website of Sumit Kumar (sumitkdev) — Full Stack Developer & Software Engineer. Explore portfolio, read 500+ coding tutorials, and get in touch.",
        "publisher": {
            "@id": "{{ url('/') }}/#person"
        },
        "author": {
            "@id": "{{ url('/') }}/#person"
        },
        "inLanguage": "en-IN",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ url('/blog') }}?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>

    <!-- Schema.org BreadcrumbList -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Home",
                "item": "{{ url('/') }}"
            }
            @if(request()->path() !== '/')
            ,{
                "@type": "ListItem",
                "position": 2,
                "name": "{{ ucfirst(explode('/', request()->path())[0]) }}",
                "item": "{{ url('/' . explode('/', request()->path())[0]) }}"
            }
            @endif
        ]
    }
    </script>

    <title>@yield('meta_title', $seoData->meta_title ?? 'Sumit Kumar — Full Stack Developer & Software Engineer')</title>
    <meta name="description"
        content="@yield('meta_description', $seoData->meta_description ?? 'Sumit Kumar is a Full Stack Developer & Software Engineer specializing in Laravel, React, Vue.js, and modern web technologies. Explore portfolio, read tutorials, and get in touch.')">
    <meta name="keywords" content="@yield('meta_keywords', $seoData->meta_keywords ?? 'Sumit Kumar, full stack developer, web developer, software engineer, Laravel developer, React developer, PHP developer, sumitkdev, Sumit Kumar portfolio')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('canonical_url', strtok(url()->current(), '?'))">
    <meta property="og:site_name" content="Sumit Kumar — Full Stack Developer">
    <meta property="og:title" content="@yield('og_title', $seoData->og_title ?? ($seoData->meta_title ?? 'Sumit Kumar — Full Stack Developer'))">
    <meta property="og:description" content="@yield('og_description', $seoData->og_description ?? ($seoData->meta_description ?? 'Official website of Sumit Kumar — Full Stack Developer specializing in Laravel, React, Vue.js.'))">
    <meta property="og:image" content="@yield('og_image', $seoData?->og_image ? asset($seoData->og_image) : asset('images/og-default.webp'))">
    <meta property="og:locale" content="en_IN">

    <!-- Twitter -->
    <meta property="twitter:card" content="@yield('twitter_card', $seoData->twitter_card ?? 'summary_large_image')">
    <meta property="twitter:url" content="@yield('canonical_url', strtok(url()->current(), '?'))">
    <meta property="twitter:title" content="@yield('twitter_title', $seoData->og_title ?? ($seoData->meta_title ?? 'Sumit Kumar — Full Stack Developer'))">
    <meta property="twitter:description" content="@yield('twitter_description', $seoData->og_description ?? ($seoData->meta_description ?? 'Official website of Sumit Kumar — Full Stack Developer.'))">
    <meta property="twitter:image" content="@yield('twitter_image', $seoData?->og_image ? asset($seoData->og_image) : asset('images/og-default.webp'))">
    <meta name="twitter:site" content="{{ $seoData->twitter_handle ?? '@sumitkdevs' }}">
    <meta name="twitter:creator" content="{{ $seoData->twitter_handle ?? '@sumitkdevs' }}">

    @yield('meta')


    <!-- Fonts (non-render-blocking) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
            rel="stylesheet">
    </noscript>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/spa.css', 'resources/js/app.js', 'resources/js/spa.js'])
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" media="print" onload="this.media='all'" />
    <noscript>
        <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
    </noscript>

    <!-- Alpine.js (pinned versions for better CDN caching) -->
    <script defer src="https://unpkg.com/@alpinejs/collapse@3.14.8/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <meta name="google-adsense-account" content="ca-pub-5730762848368403">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-55CNWM6VWH"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-55CNWM6VWH');
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: currentColor;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body class="antialiased selection:bg-black selection:text-white" x-data="{ mobileMenuOpen: false }"
    x-init="window.addEventListener('closeMobileMenu', () => mobileMenuOpen = false)">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-black/5">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo.webp') }}" alt="Sumit Kumar" class="h-10 w-auto" fetchpriority="high">
            </a>

            <div class="hidden md:flex items-center space-x-10 text-sm font-medium uppercase tracking-widest">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('portfolio.index') }}" class="nav-link">Work</a>
                <a href="{{ route('blog.index') }}" class="nav-link">Blog</a>
                <a href="{{ route('gallery') }}" class="nav-link">Gallery</a>
                <a href="{{ route('about') }}" class="nav-link">About</a>
                <a href="{{ route('contact') }}" class="nav-link">Connect</a>
                <a href="{{ route('links') }}" class="nav-link">Links</a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden p-2 hover:bg-gray-100 rounded-lg transition-colors">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="md:hidden bg-white border-t border-black/5">
            <div class="px-6 py-4 space-y-4">
                <a href="{{ route('home') }}"
                    class="block py-2 text-sm font-medium uppercase tracking-widest hover:text-gray-600 transition-colors">Home</a>
                <a href="{{ route('portfolio.index') }}"
                    class="block py-2 text-sm font-medium uppercase tracking-widest hover:text-gray-600 transition-colors">Work</a>
                <a href="{{ route('blog.index') }}"
                    class="block py-2 text-sm font-medium uppercase tracking-widest hover:text-gray-600 transition-colors">Journal</a>
                <a href="{{ route('gallery') }}"
                    class="block py-2 text-sm font-medium uppercase tracking-widest hover:text-gray-600 transition-colors">Gallery</a>
                <a href="{{ route('about') }}"
                    class="block py-2 text-sm font-medium uppercase tracking-widest hover:text-gray-600 transition-colors">About</a>
                <a href="{{ route('contact') }}"
                    class="block py-2 text-sm font-medium uppercase tracking-widest hover:text-gray-600 transition-colors">Connect</a>
                <a href="{{ route('links') }}"
                    class="block py-2 text-sm font-medium uppercase tracking-widest hover:text-gray-600 transition-colors">Links</a>
            </div>
        </div>
    </nav>

    <!-- SPA Loading Overlay -->
    <div id="spa-loading"></div>

    <main class="pt-20">
        <div id="spa-content">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-20 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-20">
                <div>
                    <h2 class="text-5xl font-premium italic mb-8">Let's create something remarkable.</h2>
                    <p class="text-gray-400 max-w-md mb-10">Available for freelance opportunities and full-time
                        positions as a Full Stack Developer.</p>
                    <a href="{{ route('contact') }}"
                        class="text-xl font-medium border-b border-white pb-2 hover:text-gray-300 transition-colors">Start
                        a project</a>

                    <!-- Social Media Icons -->
                    <div class="mt-12">
                        <h4 class="uppercase tracking-widest text-xs text-gray-500 mb-6">Connect With Me</h4>
                        <div class="flex gap-4">
                            @php
                                  $footerLinks = collect()
                                      ->merge($globalSocialLinks['social_media'] ?? [])
                                      ->merge($globalSocialLinks['developer_profiles'] ?? [])
                                      ->take(5);
                              @endphp
                              @foreach($footerLinks as $link)
                                  <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                                      class="w-12 h-12 border border-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-black transition-all">
                                      {!! str_replace('<svg ', '<svg class="w-5 h-5" ', $link->icon_svg) !!}
                                  </a>
                              @endforeach

                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-10">
                    <div>
                        <h4 class="uppercase tracking-widest text-xs text-gray-500 mb-6">Navigation</h4>
                        <ul class="space-y-4">
                            <li><a href="{{ route('portfolio.index') }}"
                                    class="hover:text-gray-400 transition-colors">Portfolio</a></li>
                            <li><a href="{{ route('blog.index') }}"
                                    class="hover:text-gray-400 transition-colors">Insights</a></li>
                            <li><a href="{{ route('about') }}" class="hover:text-gray-400 transition-colors">My
                                    Story</a></li>
                            <li><a href="{{ route('links') }}" class="hover:text-gray-400 transition-colors">All Links</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="uppercase tracking-widest text-xs text-gray-500 mb-6">Find Me Elsewhere</h4>
                        <ul class="space-y-4">
                            <li><a href="https://github.com/sumitkdevcode" target="_blank" rel="noopener" class="hover:text-gray-400 transition-colors">GitHub</a></li>
                            <li><a href="https://stackoverflow.com/users/sumitkdev" target="_blank" rel="noopener" class="hover:text-gray-400 transition-colors">Stack Overflow</a></li>
                            <li><a href="https://dev.to/sumitkdev" target="_blank" rel="noopener" class="hover:text-gray-400 transition-colors">Dev.to</a></li>
                            <li><a href="https://medium.com/@sumitkdev" target="_blank" rel="noopener" class="hover:text-gray-400 transition-colors">Medium</a></li>
                            <li><a href="{{ route('links') }}" class="text-xs uppercase tracking-widest font-bold mt-2 inline-block hover:text-gray-400 transition-colors">View all &rarr;</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="uppercase tracking-widest text-xs text-gray-500 mb-6">Contact</h4>
                        <ul class="space-y-4">
                            <li><a href="mailto:contact@sumitkdev.in"
                                    class="hover:text-gray-400 transition-colors">Email</a></li>
                            <li><a href="tel:+918303744132" class="hover:text-gray-400 transition-colors">Phone</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-gray-400 transition-colors">Contact
                                    Form</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div
                class="border-t border-white/10 mt-20 pt-10 flex flex-col md:flex-row justify-between text-xs text-gray-500 uppercase tracking-widest">
                <p>&copy; {{ date('Y') }} Sumit Kumar. All rights reserved.</p>
                <div class="mt-4 md:mt-0 space-x-6">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>

                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-out-cubic'
        });
    </script>

    <!-- AdSense (deferred to bottom) -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5730762848368403"
        crossorigin="anonymous"></script>
</body>

</html>