@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="min-h-[90vh] flex items-center px-6">
        <div class="max-w-7xl mx-auto w-full grid md:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-up">
                <h1 class="text-7xl md:text-9xl font-bold tracking-tighter leading-none mb-8">
                    {{ explode(' ', $settings['site_name'])[0] }}<br><span
                        class="text-premium italic font-normal">{{ explode(' ', $settings['site_name'])[1] ?? '' }}</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 max-w-lg mb-12 font-light leading-relaxed">
                    {{ $settings['summary'] }}
                </p>
                <div class="flex items-center space-x-8">
                    <a href="{{ route('portfolio.index') }}"
                        class="group flex items-center space-x-4 text-sm font-bold uppercase tracking-widest">
                        <span>View Work</span>
                        <span class="w-12 h-[1px] bg-black group-hover:w-20 transition-all"></span>
                    </a>
                </div>
            </div>
            <div class="relative" data-aos="fade-up" data-aos-delay="200">
                <div class="aspect-[4/5] bg-gray-100 overflow-hidden">
                    <img src="https://sumitkdev.in/storage/media/j0qk6wFOPGrGJEBdwp6IieB8rVokn357csmu91Sq.jpg"
                        alt="Sumit Kumar" class="w-full h-full object-cover img-premium">
                </div>
                <div class="absolute -bottom-10 -left-10 bg-black text-white p-12 hidden lg:block">
                    <p class="text-xs uppercase tracking-[0.3em] mb-4">Current Focus</p>
                    <p class="text-2xl font-premium leading-tight">Full Stack Developer</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats / Skills Section -->
    <section class="py-32 border-y border-black/5">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
            <div data-aos="fade-up">
                <h3 class="text-5xl font-bold mb-2">02+</h3>
                <p class="text-xs uppercase tracking-widest text-gray-500">Years Experience</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-5xl font-bold mb-2">10+</h3>
                <p class="text-xs uppercase tracking-widest text-gray-500">Projects Done</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-5xl font-bold mb-2">15+</h3>
                <p class="text-xs uppercase tracking-widest text-gray-500">Clients</p>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                <h3 class="text-5xl font-bold mb-2">100%</h3>
                <p class="text-xs uppercase tracking-widest text-gray-500">Satisfaction</p>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-20">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4">Selected Work</p>
                    <h2 class="text-5xl font-premium">Portfolio Highlights</h2>
                </div>
                <a href="{{ route('portfolio.index') }}"
                    class="text-sm font-bold uppercase tracking-widest hover:opacity-50 transition-opacity">View All</a>
            </div>

            <div class="grid md:grid-cols-2 gap-20">
                @forelse($featuredProjects as $project)
                    <div class="group" data-aos="fade-up">
                        <a href="{{ route('portfolio.show', $project->slug) }}">
                            <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-8">
                                <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full img-premium">
                            </div>
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-2xl font-bold mb-2">{{ $project->title }}</h3>
                                    <p class="text-gray-500 text-sm italic">{{ $project->category }}</p>
                                </div>
                                <span
                                    class="text-xs uppercase tracking-widest border border-black px-4 py-2 group-hover:bg-black group-hover:text-white transition-all">Details</span>
                            </div>
                        </a>
                    </div>
                @empty
                    <!-- Placeholder for development -->
                    <div class="group" data-aos="fade-up">
                        <div class="aspect-[16/10] bg-gray-100 mb-8 p-12 flex flex-col justify-end">
                            <p class="text-xs uppercase tracking-widest mb-2 opacity-50 italic">Project Category</p>
                            <h3 class="text-4xl font-premium">Project Title Coming Soon</h3>
                        </div>
                    </div>
                    <div class="group" data-aos="fade-up" data-aos-delay="200">
                        <div class="aspect-[16/10] bg-black text-white mb-8 p-12 flex flex-col justify-end">
                            <p class="text-xs uppercase tracking-widest mb-2 opacity-50 italic">Project Category</p>
                            <h3 class="text-4xl font-premium">Example Portfolio Item</h3>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Personal Strengths -->
    <section class="py-32 border-t border-black/5">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-12">Core Values</p>
            <div class="grid md:grid-cols-3 gap-16">
                <div data-aos="fade-up">
                    <h4 class="text-xl font-bold uppercase mb-4 tracking-tighter">Strategic Communication</h4>
                    <p class="text-gray-500 font-light leading-relaxed">Articulating complex technical concepts into clear,
                        actionable business strategies.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-xl font-bold uppercase mb-4 tracking-tighter">Creative Problem Solving</h4>
                    <p class="text-gray-500 font-light leading-relaxed">Designing elegant solutions for intricate
                        engineering challenges with a "less but better" approach.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-xl font-bold uppercase mb-4 tracking-tighter">Leadership & Adaptability</h4>
                    <p class="text-gray-500 font-light leading-relaxed">Eager to lead and learn within high-performance
                        teams, adapting swiftly to emerging technologies.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills & Abilities Section -->
    <section class="py-32 bg-white overflow-hidden skills-section-wrapper">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4">Technical Expertise</p>
                <h2 class="text-5xl font-premium">Skills &amp; Abilities</h2>
            </div>

            <div class="bg-gray-50  p-8 md:p-16 relative skills-container border border-black/5" data-aos="zoom-in">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 relative z-10">
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
                        <div data-aos="fade-up" data-aos-delay="{{ $index * 50 }}"
                            class="bg-white  p-6 flex flex-col items-center justify-center gap-4 hover:scale-105 transition-all duration-300 border border-black/10 hover:border-black hover:shadow-xl group skill-card">
                            <div class="w-12 h-12 flex items-center justify-center">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/{{ $skill['icon'] }}"
                                    alt="{{ $skill['name'] }}"
                                    class="w-full h-full object-contain skill-icon grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <span
                                class="text-xs font-bold uppercase tracking-widest text-gray-500 group-hover:text-black transition-colors text-center">{{ $skill['name'] }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Decorative background elements with black/white theme -->
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-black/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-60 h-60 bg-black/5 rounded-full blur-3xl"></div>
            </div>
        </div>
    </section>





    <!-- Gallery Section -->
    <section class="py-32 bg-black text-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-16" data-aos="fade-up">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-500 mb-4">Visual Stories</p>
                    <h2 class="text-5xl md:text-6xl font-bold">Gallery</h2>
                </div>
                <a href="{{ route('gallery') }}"
                    class="text-sm font-bold uppercase tracking-widest hover:opacity-50 transition-opacity">
                    Explore Gallery →
                </a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($galleryImages as $index => $image)
                    <div class="aspect-square bg-white/10 overflow-hidden group" data-aos="fade-up"
                        data-aos-delay="{{ $index * 50 }}">
                        <a href="{{ route('gallery') }}">
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="{{ $image->title ?? 'Gallery Image' }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </a>
                    </div>
                @empty
                    @for($i = 0; $i < 8; $i++)
                        <div class="aspect-square bg-white/10 overflow-hidden group" data-aos="fade-up"
                            data-aos-delay="{{ $i * 50 }}">
                            <a href="{{ route('gallery') }}">
                                <div
                                    class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 group-hover:scale-110 transition-transform duration-500 flex items-center justify-center">
                                    <p class="text-xs uppercase tracking-widest text-gray-600">Image {{ $i + 1 }}</p>
                                </div>
                            </a>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </section>

    <!-- Blog Journal -->
    <section class="py-32 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4">Latest Updates</p>
            <h2 class="text-5xl font-premium italic mb-20">Recent Thoughts</h2>

            <div class="space-y-0">
                @forelse($recentBlogs as $blog)
                    <a href="{{ route('blog.show', $blog->slug) }}"
                        class="group block py-12 border-t border-black/10 hover:bg-white transition-colors px-4">
                        <div class="grid md:grid-cols-12 items-center gap-8">
                            <div class="md:col-span-2 text-gray-500 uppercase tracking-widest text-xs">
                                {{ optional($blog->published_at)->format('M d, Y') ?? 'Draft' }}
                            </div>
                            <div class="md:col-span-7">
                                <h3 class="text-3xl md:text-5xl font-medium group-hover:italic transition-all">
                                    {{ $blog->title }}
                                </h3>
                            </div>
                            <div class="md:col-span-3 text-right">
                                <span
                                    class="inline-block p-4 border border-black/20 rounded-full group-hover:border-black transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="py-20 text-center opacity-30">
                        <p class="text-2xl italic">Journal entries are being prepared...</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection