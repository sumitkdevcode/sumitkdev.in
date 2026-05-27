@extends('layouts.app')

@section('meta_title', $post->meta_title ?? $post->title . ' — Sumit Kumar')
@section('meta_description', $post->meta_description ?? $post->excerpt)
@section('meta_keywords', is_array($post->tags) ? implode(', ', $post->tags) . ', Sumit Kumar' : 'Sumit Kumar')

@section('og_type', 'article')
@section('og_title', $post->meta_title ?? $post->title)
@section('og_description', $post->meta_description ?? $post->excerpt)
@section('og_image', $post->featured_image ? asset('storage/' . $post->featured_image) : asset('images/og-default.webp'))

@section('twitter_title', $post->meta_title ?? $post->title)
@section('twitter_description', $post->meta_description ?? $post->excerpt)
@section('twitter_image', $post->featured_image ? asset('storage/' . $post->featured_image) : asset('images/og-default.webp'))

@section('meta')
    <!-- Blog Post Article Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": "{{ $post->title }}",
        "description": "{{ $post->meta_description ?? $post->excerpt }}",
        "author": {
            "@type": "Person",
            "name": "Sumit Kumar",
            "url": "{{ url('/') }}"
        },
        "publisher": {
            "@type": "Person",
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
        "image": "{{ asset('storage/' . $post->featured_image) }}",
        @endif
        "articleSection": "{{ $post->category }}",
        "keywords": "{{ is_array($post->tags) ? implode(', ', $post->tags) : '' }}, Sumit Kumar",
        "wordCount": {{ str_word_count(strip_tags($post->content)) }},
        "inLanguage": "en"
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
        <!-- Post Header -->
        <header class="max-w-4xl mx-auto px-6 mb-24 text-center">
            <div data-aos="fade-up">
                <p class="text-[10px] uppercase tracking-[0.5em] text-gray-400 font-bold mb-8">{{ $post->category }} &bull;
                    {{ $post->reading_time }} Min Read
                </p>
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase leading-none mb-12">{{ $post->title }}
                </h1>
                <div class="flex items-center justify-center space-x-4">
                    <div
                        class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center text-xs font-bold">
                        S</div>
                    <div class="text-left">
                        <p class="text-xs font-bold uppercase tracking-widest">{{ optional($post->author)->name ?? 'Sumit Kumar' }}</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-tighter">
                            {{ optional($post->published_at)->format('F d, Y') ?? 'Draft' }}
                        </p>
                    </div>
                </div>
            </div>
        </header>

        @if($post->featured_image)
            <section class="max-w-7xl mx-auto px-6 mb-24" data-aos="zoom-out">
                <!-- Main Viewer -->
                <div class="aspect-video bg-gray-100 overflow-hidden shadow-2xl mb-8">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" id="mainImage"
                        class="w-full h-full  transition-opacity duration-300" fetchpriority="high">
                </div>

                <!-- Sub Images Row -->
                @if($post->sub_images && count($post->sub_images) > 0)
                    <div class="flex overflow-x-auto gap-4 pb-6 no-scrollbar">
                        {{-- Original Image --}}
                        <div class="flex-none w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 overflow-hidden group border-2 border-transparent hover:border-black transition-all cursor-pointer"
                            onclick="updateMainImage('{{ asset('storage/' . $post->featured_image) }}')">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt=""
                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" loading="lazy">
                        </div>

                        {{-- Sub Images --}}
                        @foreach($post->sub_images as $image)
                            <div class="flex-none w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 overflow-hidden group border-2 border-transparent hover:border-black transition-all cursor-pointer"
                                onclick="updateMainImage('{{ asset('storage/' . $image) }}')">
                                <img src="{{ asset('storage/' . $image) }}" alt=""
                                    class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" loading="lazy">
                            </div>
                        @endforeach
                    </div>
                @endif

                <style>
                    .no-scrollbar::-webkit-scrollbar {
                        display: none;
                    }

                    .no-scrollbar {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }
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
            </section>
        @endif

        <section class="max-w-3xl mx-auto px-6">
            <div class="prose prose-2xl max-w-none text-black font-light leading-relaxed mb-20">
                {!! $post->content !!}
            </div>



            <!-- Social Share or Tags -->
            <div class="pt-20 border-t border-black/5 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex flex-wrap gap-2">
                    @foreach($post->tags ?? [] as $tag)
                        <span class="text-[10px] uppercase font-bold tracking-widest text-gray-400">#{{ $tag }}</span>
                    @endforeach
                </div>
                <div class="flex items-center space-x-6">
                    <p class="text-[10px] uppercase font-bold tracking-widest text-gray-400">Share</p>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="hover:text-gray-400 transition-colors">Twitter</a>
                        <a href="#" class="hover:text-gray-400 transition-colors">LinkedIn</a>
                    </div>
                </div>
            </div>
        </section>
    </article>

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