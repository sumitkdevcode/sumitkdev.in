@extends('layouts.app')

@section('meta_title', $post->meta_title ?? $post->title . ' — Sumit Kumar')
@section('meta_description', $post->meta_description ?? $post->excerpt)
@section('meta_keywords', is_array($post->tags) ? implode(', ', $post->tags) . ', Sumit Kumar' : 'Sumit Kumar')

@section('og_type', 'article')
@section('og_title', $post->meta_title ?? $post->title)
@section('og_description', $post->meta_description ?? $post->excerpt)
@section('og_image', $post->getImageUrl() ?? asset('images/og-default.webp'))

@section('twitter_title', $post->meta_title ?? $post->title)
@section('twitter_description', $post->meta_description ?? $post->excerpt)
@section('twitter_image', $post->getImageUrl() ?? asset('images/og-default.webp'))

@section('canonical_url', route('blog.show', $post->slug))

@section('meta')
    <!-- TechArticle Schema with Speakable (AEO) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TechArticle",
        "headline": "{{ $post->title }}",
        "description": "{{ $post->meta_description ?? $post->excerpt }}",
        "author": {
            "@type": "Person",
            "@id": "{{ url('/') }}/#person",
            "name": "Sumit Kumar",
            "url": "{{ url('/') }}"
        },
        "publisher": {
            "@type": "Person",
            "@id": "{{ url('/') }}/#person",
            "name": "Sumit Kumar",
            "url": "{{ url('/') }}"
        },
        "datePublished": "{{ optional($post->published_at)->toIso8601String() }}",
        "dateModified": "{{ $post->updated_at->toIso8601String() }}",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ url()->current() }}"
        },
        @if($post->featured_image)
        "image": "{{ $post->getImageUrl() }}",
        @endif
        "articleSection": "{{ $post->category }}",
        "keywords": "{{ is_array($post->tags) ? implode(', ', $post->tags) : '' }}, Sumit Kumar",
        "wordCount": {{ str_word_count(strip_tags($post->content)) }},
        "inLanguage": "en",
        "proficiencyLevel": "Beginner",
        "speakable": {
            "@type": "SpeakableSpecification",
            "cssSelector": ["article h1", ".prose h2", ".prose h3"]
        }
    }
    </script>

    <!-- BreadcrumbList Schema (3-level) -->
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
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Blog",
                "item": "{{ route('blog.index') }}"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $post->title }}",
                "item": "{{ route('blog.show', $post->slug) }}"
            }
        ]
    }
    </script>

    <meta property="article:author" content="Sumit Kumar">
    <meta property="article:published_time" content="{{ optional($post->published_at)->toIso8601String() }}">
    <meta property="article:modified_time" content="{{ $post->updated_at->toIso8601String() }}">
    <meta property="article:section" content="{{ $post->category }}">
    @if(is_array($post->tags))
        @foreach($post->tags as $tag)
            <meta property="article:tag" content="{{ $tag }}">
        @endforeach
    @endif
@endsection

@section('content')

    <article class="pb-32">
        @if($post->featured_image)
        <!-- Post Hero Wrapper -->
        <section class="max-w-7xl mx-auto px-6 mb-16 pt-8">
            <div class="relative w-full aspect-[4/5] sm:aspect-video md:aspect-[3/1] rounded-2xl overflow-hidden shadow-2xl bg-gray-900 group">
                <img src="{{ $post->getImageUrl() }}" alt="{{ $post->title }}" id="mainImage"
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" fetchpriority="high">
                <!-- Gradient only at the very bottom so the main image is completely clear -->
                <div class="absolute inset-x-0 bottom-0 h-2/3 md:h-1/2 bg-gradient-to-t from-black/90 via-black/40 to-transparent pointer-events-none"></div>
                
                <div class="absolute bottom-0 left-0 w-full p-6 sm:p-8 md:p-12 lg:p-16">
                    <p class="text-[10px] md:text-xs uppercase tracking-[0.2em] font-bold text-gray-300 mb-2 md:mb-4">
                        {{ $post->category }}
                    </p>
                    <h1 class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-bold tracking-tight mb-4 md:mb-6 leading-tight max-w-4xl text-white">
                        {{ $post->title }}
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-y-2 gap-x-4 text-xs md:text-sm text-gray-300">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold text-white border border-white/30">
                                S
                            </div>
                            <span class="font-medium text-white">{{ optional($post->author)->name ?? 'Sumit Kumar' }}</span>
                        </div>
                        <span class="hidden md:inline">&bull;</span>
                        <span>{{ optional($post->published_at)->format('M d, Y') ?? 'Draft' }}</span>
                        <span class="hidden md:inline">&bull;</span>
                        <span>{{ $post->reading_time }} min read</span>
                        <span class="hidden md:inline">&bull;</span>
                        <span>{{ $post->views ?? 0 }} views</span>
                    </div>
                </div>
            </div>

            <!-- Sub Images Row -->
            @if($post->sub_images && count($post->sub_images) > 0)
                <div class="flex overflow-x-auto gap-4 py-6 no-scrollbar">
                    {{-- Original Image --}}
                    <div class="flex-none w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 overflow-hidden group border-2 border-transparent hover:border-black transition-all cursor-pointer rounded-lg"
                        onclick="updateMainImage('{{ $post->getImageUrl() }}')">
                        <img src="{{ $post->getImageUrl() }}" alt=""
                            class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" loading="lazy">
                    </div>

                    {{-- Sub Images --}}
                    @foreach($post->sub_images as $image)
                        <div class="flex-none w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 overflow-hidden group border-2 border-transparent hover:border-black transition-all cursor-pointer rounded-lg"
                            onclick="updateMainImage('{{ asset('storage/' . $image) }}')">
                            <img src="{{ asset('storage/' . $image) }}" alt=""
                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" loading="lazy">
                        </div>
                    @endforeach
                </div>
                
                <style>
                    .no-scrollbar::-webkit-scrollbar { display: none; }
                    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
                </style>
                <script>
                    function updateMainImage(src) {
                        const mainImage = document.getElementById('mainImage');
                        mainImage.classList.add('opacity-0');
                        setTimeout(() => {
                            mainImage.src = src;
                            mainImage.classList.remove('opacity-0');
                        }, 300);
                    }
                </script>
            @endif
        </section>
        @else
        <!-- Post Header without Image -->
        <header class="max-w-4xl mx-auto px-6 mb-24 mt-16 text-center">
            <div>
                <p class="text-[10px] uppercase tracking-[0.5em] text-gray-400 font-bold mb-8">{{ $post->category }} &bull;
                    {{ $post->reading_time }} Min Read
                </p>
                <h1 class="text-4xl md:text-5xl font-bold tracking-tighter uppercase leading-none mb-12">{{ $post->title }}
                </h1>
                <div class="flex items-center justify-center space-x-4">
                    <div
                        class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center text-xs font-bold">
                        S</div>
                    <div class="text-left">
                        <p class="text-xs font-bold uppercase tracking-widest">{{ optional($post->author)->name ?? 'Sumit Kumar' }}</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-tighter">
                            {{ optional($post->published_at)->format('F d, Y') ?? 'Draft' }} &bull; {{ $post->views ?? 0 }} views
                        </p>
                    </div>
                </div>
            </div>
        </header>
        @endif

        <section class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-12 gap-12">

                <!-- Left Sidebar: Blog Suggestions -->
                <aside class="lg:col-span-3 order-2 lg:order-1">
                    <div class="lg:sticky lg:top-24">
                        <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-6 pb-4 border-b border-black/10">Suggested Articles</h3>
                        <div class="space-y-4">
                            @forelse($suggestedPosts as $suggested)
                                <a href="{{ route('blog.show', $suggested->slug) }}"
                                    class="group flex items-start gap-4 hover:bg-gray-50 p-2 -ml-2 rounded-lg transition-all duration-200">
                                    <div class="w-24 h-16 flex-shrink-0 bg-gray-200 rounded overflow-hidden mt-1">
                                        @if($suggested->featured_image)
                                            <img src="{{ $suggested->getImageUrl() }}" alt="{{ $suggested->title }}" class="w-full h-full object-cover transition-all duration-300 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full bg-black/5"></div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold leading-snug group-hover:text-black text-gray-700 transition-colors line-clamp-2 mb-1">
                                            {{ $suggested->title }}
                                        </h4>
                                        <p class="text-[10px] text-gray-400">
                                            {{ $suggested->reading_time }} min read
                                        </p>
                                    </div>
                                </a>
                            @empty
                                <p class="text-xs text-gray-400 italic">More articles coming soon...</p>
                            @endforelse
                        </div>

                        <a href="{{ route('blog.index') }}"
                            class="inline-block mt-6 text-[10px] uppercase font-bold tracking-widest hover:text-gray-500 transition-colors border-b border-black pb-1">
                            Browse All &rarr;
                        </a>
                    </div>
                </aside>

                <!-- Right: Main Content -->
                <div class="lg:col-span-9 order-1 lg:order-2 min-w-0">
                    <div class="max-w-3xl min-w-0 overflow-hidden sm:overflow-visible">
                        <div class="prose prose-base md:prose-lg lg:prose-xl max-w-none text-black font-light leading-relaxed mb-20 prose-pre:bg-gray-900 prose-pre:text-gray-100">
                            {!! $post->content !!}
                        </div>

                        <!-- Social Share or Tags -->
                        <div class="pt-20 border-t border-black/5 flex flex-col md:flex-row justify-between items-center gap-8">
                            <div class="flex flex-wrap gap-2">
                                @foreach($post->tags ?? [] as $tag)
                                    <span class="text-[10px] uppercase font-bold tracking-widest text-gray-400">#{{ $tag }}</span>
                                @endforeach
                            </div>
                            <div class="flex items-center space-x-4">
                                <p class="text-[10px] uppercase font-bold tracking-widest text-gray-400 mr-2">Share</p>

                                {{-- Twitter / X --}}
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}&via=sumitkdevs"
                                    target="_blank" rel="noopener noreferrer" title="Share on Twitter"
                                    class="w-10 h-10 border border-black/10 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </a>

                                {{-- LinkedIn --}}
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                    target="_blank" rel="noopener noreferrer" title="Share on LinkedIn"
                                    class="w-10 h-10 border border-black/10 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>

                                {{-- Facebook --}}
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                    target="_blank" rel="noopener noreferrer" title="Share on Facebook"
                                    class="w-10 h-10 border border-black/10 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>

                                {{-- WhatsApp --}}
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' — ' . url()->current()) }}"
                                    target="_blank" rel="noopener noreferrer" title="Share on WhatsApp"
                                    class="w-10 h-10 border border-black/10 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                </a>

                                {{-- Email --}}
                                <a href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode('Check out this article: ' . url()->current()) }}"
                                    title="Share via Email"
                                    class="w-10 h-10 border border-black/10 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </a>

                                {{-- Copy Link --}}
                                <button onclick="copyPostLink()" title="Copy link"
                                    class="w-10 h-10 border border-black/10 rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-all relative" id="copyLinkBtn">
                                    <svg class="w-4 h-4" id="copyIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    <svg class="w-4 h-4 hidden" id="copiedIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <script>
                function copyPostLink() {
                    navigator.clipboard.writeText(window.location.href).then(() => {
                        const copyIcon = document.getElementById('copyIcon');
                        const copiedIcon = document.getElementById('copiedIcon');
                        const btn = document.getElementById('copyLinkBtn');
                        copyIcon.classList.add('hidden');
                        copiedIcon.classList.remove('hidden');
                        btn.classList.add('bg-black', 'text-white');
                        setTimeout(() => {
                            copyIcon.classList.remove('hidden');
                            copiedIcon.classList.add('hidden');
                            btn.classList.remove('bg-black', 'text-white');
                        }, 2000);
                    });
                }
            </script>
        </section>
    </article>

    <!-- Author Bio Card -->
    <section class="py-20 border-t border-black/5">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-gray-50 border border-black/5 p-8 md:p-12 flex flex-col md:flex-row gap-8 items-start" data-aos="fade-up">
                <div class="w-16 h-16 rounded-full bg-black text-white flex items-center justify-center text-2xl font-bold flex-shrink-0">
                    S
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold uppercase tracking-wider mb-2">Written by Sumit Kumar</h3>
                    <p class="text-sm text-gray-500 font-light leading-relaxed mb-6">
                        Full Stack Developer specializing in Laravel, React, and modern web technologies. I write about software engineering, web development, and the tools I use daily.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('about') }}" class="text-[10px] uppercase font-bold tracking-widest border-b border-black pb-1 hover:text-gray-500 transition-colors">My Story</a>
                        <a href="{{ route('portfolio.index') }}" class="text-[10px] uppercase font-bold tracking-widest border-b border-black pb-1 hover:text-gray-500 transition-colors">Portfolio</a>
                        <a href="{{ route('links') }}" class="text-[10px] uppercase font-bold tracking-widest border-b border-black pb-1 hover:text-gray-500 transition-colors">All Profiles</a>
                        <a href="{{ route('contact') }}" class="text-[10px] uppercase font-bold tracking-widest border-b border-black pb-1 hover:text-gray-500 transition-colors">Hire Me</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-32 border-t border-black/5">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('blog.index') }}"
                class="group flex items-center space-x-4 text-sm font-bold uppercase tracking-widest">
                <span class="w-12 h-[1px] bg-black group-hover:w-20 transition-all"></span>
                <span>Back to Journal</span>
            </a>
        </div>
    </section>
@endsection