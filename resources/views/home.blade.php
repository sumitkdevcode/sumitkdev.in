@extends('layouts.app')

@section('canonical_url', route('home'))

@section('content')
    <section class="relative px-6 pt-4 pb-20 md:pb-32 overflow-hidden">
        <!-- Animated Background Grid -->
        <div class="bg-grid-pattern"></div>

        <div class="max-w-7xl mx-auto w-full grid md:grid-cols-2 gap-12 items-center relative z-10 mt-4 md:mt-8">
            <!-- Left Content: Typography & CTAs -->
            <div class="relative">
                <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold tracking-tighter leading-none mb-8 relative">
                    <span class="reveal-text-container block">
                        <span class="reveal-text">{{ explode(' ', $settings['site_name'])[0] }}</span>
                    </span>
                    <br>
                    <span class="reveal-text-container block">
                        <span class="reveal-text delay-200 text-outline-premium opacity-100">
                            {{ explode(' ', $settings['site_name'])[1] ?? '' }}
                        </span>
                    </span>
                </h1>
                
                <div class="reveal-text-container block mb-12">
                    <p class="reveal-text delay-400 text-xl md:text-2xl text-gray-600 max-w-lg font-light leading-relaxed">
                        {{ $settings['summary'] }}
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-8 reveal-text-container">
                    <div class="reveal-text delay-600 flex items-center space-x-8">
                        <a href="{{ route('portfolio.index') }}"
                            class="btn-premium group flex items-center space-x-4 text-sm font-bold uppercase tracking-widest bg-black text-white px-8 py-4">
                            <span class="relative z-10">Explore Work</span>
                            <svg class="w-5 h-5 relative z-10 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('about') }}"
                            class="text-sm font-bold uppercase tracking-widest hover:text-gray-500 transition-colors nav-link inline-block">
                            My Story
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Content: Image & floating element -->
            <div class="relative mt-12 md:mt-0 lg:ml-auto">
                <div class="image-reveal-wrapper neo-frame bg-gray-100 max-w-md mx-auto aspect-[4/5] animate-float">
                    @php
                        $heroImage = \App\Models\Setting::get('home_hero_image')
                            ? asset('storage/' . \App\Models\Setting::get('home_hero_image'))
                            : asset('storage/media/j0qk6wFOPGrGJEBdwp6IieB8rVokn357csmu91Sq.webp');
                    @endphp
                    <img src="{{ $heroImage }}"
                        alt="Sumit Kumar" class="w-full h-full object-cover img-premium" fetchpriority="high">
                </div>
                
                <!-- Floating Badge -->
                <div class="absolute -bottom-10 -left-10 md:-left-20 bg-white border-2 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] z-20 animate-fade-in" style="animation-delay: 1s;">
                    <div class="flex items-center gap-4">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                        <p class="text-xs uppercase tracking-[0.3em] font-bold">Available for work</p>
                    </div>
                    <p class="text-2xl font-bold tracking-tighter mt-2">Full Stack Developer</p>
                </div>
            </div>
        </div>

        <!-- Scrolling Ticker -->
        <div class="ticker-wrap hidden md:block bg-white/80 backdrop-blur-sm z-10">
            <div class="ticker">
                <div class="ticker-item">Laravel Development</div>
                <div class="ticker-item">•</div>
                <div class="ticker-item">React & Vue.js</div>
                <div class="ticker-item">•</div>
                <div class="ticker-item">UI/UX Engineering</div>
                <div class="ticker-item">•</div>
                <div class="ticker-item">API Architecture</div>
                <div class="ticker-item">•</div>
                <div class="ticker-item">Database Optimization</div>
                <div class="ticker-item">•</div>
                <!-- Duplicate for seamless scroll -->
                <div class="ticker-item">Laravel Development</div>
                <div class="ticker-item">•</div>
                <div class="ticker-item">React & Vue.js</div>
                <div class="ticker-item">•</div>
                <div class="ticker-item">UI/UX Engineering</div>
                <div class="ticker-item">•</div>
                <div class="ticker-item">API Architecture</div>
                <div class="ticker-item">•</div>
                <div class="ticker-item">Database Optimization</div>
                <div class="ticker-item">•</div>
            </div>
        </div>
    </section>

    <!-- Stats / Skills Section -->
    <section class="py-32 border-y border-black/5 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div data-aos="fade-up" class="neo-frame bg-white p-8 group">
                <h3 class="text-5xl font-bold mb-2 group-hover:scale-110 transition-transform">02+</h3>
                <p class="text-xs uppercase tracking-widest text-gray-500">Years Experience</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="100" class="neo-frame bg-white p-8 group">
                <h3 class="text-5xl font-bold mb-2 group-hover:scale-110 transition-transform">10+</h3>
                <p class="text-xs uppercase tracking-widest text-gray-500">Projects Done</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200" class="neo-frame bg-white p-8 group">
                <h3 class="text-5xl font-bold mb-2 group-hover:scale-110 transition-transform">15+</h3>
                <p class="text-xs uppercase tracking-widest text-gray-500">Clients</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="300" class="neo-frame bg-white p-8 group">
                <h3 class="text-5xl font-bold mb-2 group-hover:scale-110 transition-transform">100%</h3>
                <p class="text-xs uppercase tracking-widest text-gray-500">Satisfaction</p>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-6">
                <div data-aos="fade-right">
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4">Selected Work</p>
                    <h2 class="text-6xl font-bold tracking-tighter">Portfolio Highlights</h2>
                </div>
                <a href="{{ route('portfolio.index') }}" data-aos="fade-left"
                    class="group flex items-center space-x-4 text-sm font-bold uppercase tracking-widest btn-premium bg-black text-white px-6 py-3">
                    <span class="relative z-10">View All</span>
                    <svg class="w-4 h-4 relative z-10 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid md:grid-cols-2 gap-x-20 gap-y-32">
                @forelse($featuredProjects as $index => $project)
                    <div class="group {{ $index % 2 != 0 ? 'md:mt-32' : '' }}" data-aos="fade-up">
                        <a href="{{ route('portfolio.show', $project->slug) }}" class="block relative">
                            <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-8 neo-frame image-reveal-wrapper">
                                <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover img-premium project-image-scale" loading="lazy">
                            </div>
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-3xl font-bold mb-2 group-hover:italic transition-all">{{ $project->title }}</h3>
                                    <p class="text-gray-500 text-sm uppercase tracking-widest">{{ $project->category }}</p>
                                </div>
                                <span class="w-12 h-12 flex items-center justify-center border-2 border-black rounded-full group-hover:bg-black group-hover:text-white transition-all -rotate-45 group-hover:rotate-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                @empty
                    <!-- Placeholder for development -->
                    <div class="group" data-aos="fade-up">
                        <div class="aspect-[16/10] bg-gray-100 mb-8 p-12 flex flex-col justify-end neo-frame">
                            <p class="text-xs uppercase tracking-widest mb-2 opacity-50 italic">Project Category</p>
                            <h3 class="text-4xl font-bold tracking-tighter">Project Title Coming Soon</h3>
                        </div>
                    </div>
                    <div class="group md:mt-32" data-aos="fade-up" data-aos-delay="200">
                        <div class="aspect-[16/10] bg-black text-white mb-8 p-12 flex flex-col justify-end neo-frame">
                            <p class="text-xs uppercase tracking-widest mb-2 opacity-50 italic">Project Category</p>
                            <h3 class="text-4xl font-bold tracking-tighter">Example Portfolio Item</h3>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Personal Strengths -->
    <section class="py-32 border-t border-black/5 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-16 text-center">Core Values</p>
            <div class="grid md:grid-cols-3 gap-20">
                <div data-aos="fade-up" class="relative group">
                    <span class="number-decorator group-hover:text-black/5 transition-colors">01</span>
                    <h4 class="text-2xl font-bold uppercase mb-4 tracking-tighter">Strategic Communication</h4>
                    <p class="text-gray-500 font-light leading-relaxed">Articulating complex technical concepts into clear,
                        actionable business strategies.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100" class="relative group">
                    <span class="number-decorator group-hover:text-black/5 transition-colors">02</span>
                    <h4 class="text-2xl font-bold uppercase mb-4 tracking-tighter">Creative Problem Solving</h4>
                    <p class="text-gray-500 font-light leading-relaxed">Designing elegant solutions for intricate
                        engineering challenges with a "less but better" approach.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200" class="relative group">
                    <span class="number-decorator group-hover:text-black/5 transition-colors">03</span>
                    <h4 class="text-2xl font-bold uppercase mb-4 tracking-tighter">Leadership & Adaptability</h4>
                    <p class="text-gray-500 font-light leading-relaxed">Eager to lead and learn within high-performance
                        teams, adapting swiftly to emerging technologies.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills & Abilities Section -->
    <section class="py-32 bg-white overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="mb-16 text-center">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4">Technical Expertise</p>
                <h2 class="text-6xl font-bold tracking-tighter">Skills &amp; Abilities</h2>
            </div>

            <div class="p-8 md:p-16 relative neo-frame bg-white" data-aos="zoom-in">
                <!-- Inner grid pattern specifically for skills box -->
                <div class="absolute inset-0 bg-grid-pattern opacity-50 z-0 pointer-events-none"></div>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8 relative z-10">
                    @php
                        $skills = [
                            ['name' => 'ReactJS', 'icon' => 'react/react-original.svg'],
                            ['name' => '.NET', 'icon' => 'dotnetcore/dotnetcore-plain.svg'],
                            ['name' => 'ASP.NET', 'icon' => 'dot-net/dot-net-plain.svg'],
                            ['name' => 'Laravel', 'icon' => 'laravel/laravel-original.svg'],
                            ['name' => 'Django', 'icon' => 'django/django-plain.svg'],
                            ['name' => 'Bootstrap', 'icon' => 'bootstrap/bootstrap-plain.svg'],
                            ['name' => 'HTML5', 'icon' => 'html5/html5-plain.svg'],
                            ['name' => 'CSS', 'icon' => 'css3/css3-plain.svg'],
                            ['name' => 'JavaScript', 'icon' => 'javascript/javascript-plain.svg'],
                            ['name' => 'C#', 'icon' => 'csharp/csharp-plain.svg'],
                            ['name' => 'PHP', 'icon' => 'php/php-plain.svg'],
                            ['name' => 'Python', 'icon' => 'python/python-plain.svg'],
                            ['name' => 'MSSQL', 'icon' => 'microsoftsqlserver/microsoftsqlserver-plain.svg'],
                            ['name' => 'Git VCS', 'icon' => 'git/git-plain.svg'],
                            ['name' => 'GitHub', 'icon' => 'github/github-original.svg'],
                            ['name' => 'WordPress', 'icon' => 'wordpress/wordpress-plain.svg'],
                        ];
                    @endphp

                    @foreach($skills as $index => $skill)
                        <div data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}"
                            class="bg-white p-6 flex flex-col items-center justify-center gap-4 hover:-translate-y-2 transition-transform duration-300 border-2 border-black/10 hover:border-black hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] group skill-card cursor-pointer">
                            <div class="w-12 h-12 flex items-center justify-center">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/{{ $skill['icon'] }}"
                                    alt="{{ $skill['name'] }}" loading="lazy"
                                    class="w-full h-full object-contain skill-icon grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <span
                                class="text-xs font-bold uppercase tracking-widest text-gray-500 group-hover:text-black transition-colors text-center">{{ $skill['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>





    <!-- Gallery Section -->
    <section class="py-32 bg-black text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-6" data-aos="fade-up">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-500 mb-4">Visual Stories</p>
                    <h2 class="text-6xl md:text-7xl font-bold tracking-tighter">Gallery</h2>
                </div>
                <a href="{{ route('gallery') }}"
                    class="text-sm font-bold uppercase tracking-widest hover:opacity-50 transition-opacity border-b border-white pb-1">
                    Explore Gallery
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-1">
                @forelse($galleryImages as $index => $image)
                    <div class="aspect-square bg-white/10 overflow-hidden group relative" data-aos="fade-up"
                        data-aos-delay="{{ ($index % 4) * 100 }}">
                        <a href="{{ route('gallery') }}" class="block w-full h-full relative">
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->title ?? 'Gallery Image' }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                            <!-- Overlay -->
                            <div class="gallery-overlay absolute inset-0 flex items-center justify-center">
                                <span class="bg-white text-black rounded-full p-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                @empty
                    @for($i = 0; $i < 8; $i++)
                        <div class="aspect-square bg-white/10 overflow-hidden group relative" data-aos="fade-up"
                            data-aos-delay="{{ ($i % 4) * 100 }}">
                            <a href="{{ route('gallery') }}" class="block w-full h-full relative">
                                <div
                                    class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 group-hover:scale-110 transition-transform duration-700 flex items-center justify-center">
                                    <p class="text-xs uppercase tracking-widest text-gray-600">Image {{ $i + 1 }}</p>
                                </div>
                                <div class="gallery-overlay absolute inset-0 flex items-center justify-center">
                                    <span class="bg-white text-black rounded-full p-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </section>

    <!-- Blog Journal -->
    <section class="py-32 bg-white border-y border-black/5 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-20" data-aos="fade-right">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4">Latest Updates</p>
                <h2 class="text-6xl font-bold tracking-tighter">Recent Thoughts</h2>
            </div>

            <div class="space-y-0 border-t-2 border-black">
                @forelse($recentBlogs as $blog)
                    <a href="{{ route('blog.show', $blog->slug) }}"
                        class="group block py-12 border-b border-black/10 hover:bg-gray-50 transition-colors px-4 relative overflow-hidden">
                        
                        <!-- Hover decorative element -->
                        <div class="absolute inset-0 bg-black/5 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500 z-0"></div>
                        
                        <div class="grid md:grid-cols-12 items-center gap-8 relative z-10">
                            <div class="md:col-span-2 text-gray-500 uppercase tracking-widest text-xs font-bold">
                                {{ optional($blog->published_at)->format('M d, Y') ?? 'Draft' }}
                            </div>
                            <div class="md:col-span-8">
                                <h3 class="text-3xl md:text-4xl font-bold group-hover:italic transition-all">
                                    {{ $blog->title }}
                                </h3>
                            </div>
                            <div class="md:col-span-2 text-right">
                                <span class="inline-flex items-center justify-center w-14 h-14 border-2 border-black/20 rounded-full group-hover:border-black group-hover:bg-black group-hover:text-white transition-all overflow-hidden">
                                    <svg class="w-6 h-6 blog-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="py-20 text-center opacity-30 border-b border-black/10">
                        <p class="text-2xl font-bold">Journal entries are being prepared...</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16 text-center" data-aos="fade-up">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center space-x-2 text-sm font-bold uppercase tracking-widest hover:opacity-50 transition-opacity">
                    <span>View All Articles</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    @php
        $homeFaqs = [
            [
                'question' => 'Who is Sumit Kumar?',
                'answer' => 'Sumit Kumar is a Full Stack Developer and Software Engineer based in Greater Noida, India. With a Master\'s degree in Computer Applications (MCA) from Gautam Buddha University, Sumit specializes in building modern web applications using Laravel, React, Vue.js, Node.js, and other cutting-edge technologies. He has professional experience at Apex Byte IT Services and has interned at the Ministry of Housing and Urban Affairs.',
            ],
            [
                'question' => 'What technologies does Sumit Kumar work with?',
                'answer' => 'Sumit Kumar is proficient in a wide range of technologies including Laravel, React.js, Vue.js, Node.js, PHP, JavaScript, TypeScript, Python, C#, ASP.NET Core, MySQL, PostgreSQL, MongoDB, Docker, AWS, Git, and more. He specializes in full-stack web development with a focus on clean architecture and scalable solutions.',
            ],
            [
                'question' => 'Is Sumit Kumar available for freelance projects?',
                'answer' => 'Yes, Sumit Kumar is available for freelance web development projects, consulting, and full-time opportunities. Whether you need a custom web application, e-commerce platform, API development, or technical consultation, you can reach out through the contact page or email at contact@sumitkdev.in.',
            ],
            [
                'question' => 'What kind of projects does Sumit Kumar build?',
                'answer' => 'Sumit Kumar builds a variety of web applications including e-commerce platforms, content management systems (CMS), SaaS products, portfolio websites, REST and GraphQL APIs, admin dashboards, real-time applications, and enterprise-grade software solutions. He follows best practices in software architecture, testing, and deployment.',
            ],
            [
                'question' => 'Where is Sumit Kumar located?',
                'answer' => 'Sumit Kumar is based in Greater Noida, Uttar Pradesh, India. He is available for remote work globally and is open to relocating for the right opportunity. He has experience working with clients and teams across different time zones.',
            ],
            [
                'question' => 'What is Sumit Kumar\'s educational background?',
                'answer' => 'Sumit Kumar holds a Master of Computer Applications (MCA) degree from Gautam Buddha University, Greater Noida (2023-2025) and a Bachelor of Computer Applications (BCA) degree from Galgotias University, Greater Noida (2020-2023). He also holds certifications in React from HackerRank and Web Development from IIT Bombay.',
            ],
            [
                'question' => 'How can I hire Sumit Kumar for my project?',
                'answer' => 'You can hire Sumit Kumar by visiting the Contact page on this website and filling out the inquiry form, or by sending an email to contact@sumitkdev.in. Please include details about your project requirements, timeline, and budget. Sumit typically responds within 24 hours with a consultation plan.',
            ],
            [
                'question' => 'Does Sumit Kumar write technical blogs?',
                'answer' => 'Yes! Sumit Kumar actively maintains a blog covering topics like Laravel, React, JavaScript, DevOps, database optimization, security best practices, software architecture, and more. With 500+ articles, the blog serves as a comprehensive resource for developers of all skill levels. Visit the Blog section to explore tutorials and insights.',
            ],
        ];
    @endphp

    <!-- Find Me Across the Web CTA -->
    <section class="py-32 bg-black text-white relative overflow-hidden">
        <!-- Background Ticker -->
        <div class="absolute inset-0 opacity-[0.03] flex items-center pointer-events-none whitespace-nowrap z-0">
            <div class="animate-float" style="animation-duration: 20s; font-size: 30vw; font-weight: 900; line-height: 1;">
                CONNECT CONNECT CONNECT CONNECT
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <div data-aos="zoom-in" class="flex flex-col items-center justify-center">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8">Beyond This Website</p>
                <h2 class="text-6xl md:text-8xl font-bold tracking-tighter mb-12">Find me across<br><span class="text-outline-premium opacity-100">the web</span></h2>
                
                <a href="{{ route('links') }}"
                    class="group inline-flex items-center space-x-6 border-2 border-white px-12 py-6 hover:bg-white hover:text-black transition-all rounded-full">
                    <span class="text-lg font-bold uppercase tracking-widest">All Profiles</span>
                    <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <x-faq-section 
        :faqs="$homeFaqs" 
        title="Frequently Asked Questions" 
        subtitle="Got Questions?"
    />
@endsection