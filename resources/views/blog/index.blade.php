@extends('layouts.app')

@section('canonical_url', route('blog.index'))

@section('pagination_meta')
    @if(request()->has('page') && request()->get('page') > 1)
        <meta name="robots" content="noindex, follow">
    @endif
    @if($posts->currentPage() > 1)
        <link rel="prev" href="{{ $posts->previousPageUrl() }}">
    @endif
    @if($posts->hasMorePages())
        <link rel="next" href="{{ $posts->nextPageUrl() }}">
    @endif
@endsection

@section('meta')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "Blog — Sumit Kumar",
        "description": "Technical blog by Sumit Kumar covering Laravel, React, JavaScript, DevOps, AI, and software architecture.",
        "url": "{{ route('blog.index') }}",
        "mainEntity": {
            "@type": "Blog",
            "name": "Sumit Kumar's Technical Blog",
            "description": "500+ tutorials and articles on modern web development",
            "url": "{{ route('blog.index') }}",
            "author": {
                "@id": "{{ url('/') }}/#person"
            },
            "inLanguage": "en"
        },
        "breadcrumb": {
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
                }
            ]
        }
    }
    </script>
@endsection

@section('content')
    <section class="pb-12 pt-12 relative bg-white overflow-hidden border-b border-black/5">
        <!-- Background Grid -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.15] z-0 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-8" data-aos="fade-up">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8 font-bold">Journal</p>
                    <h1 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase mb-8">Blog</h1>
                    <p class="text-xl text-gray-500 max-w-2xl font-light italic">Insights on software architecture, design systems, and the future of creative technology.</p>
                </div>
                
                <div class="w-full md:w-96">
                    <form action="{{ route('blog.index') }}" method="GET" class="relative group" id="search-form">
                        @if(!empty($category))
                            <input type="hidden" name="category" value="{{ $category }}">
                        @endif
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search articles..." 
                            class="w-full bg-transparent border-b-2 border-gray-200 focus:border-black py-3 pl-0 pr-10 text-lg outline-none transition-colors placeholder:text-gray-300">
                        <button type="submit" class="absolute right-0 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-black transition-colors hover:text-black">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Category Filters -->
            @if(isset($categories) && $categories->count() > 0)
                <div class="mb-12 flex flex-wrap gap-2" data-aos="fade-up">
                    <a href="{{ route('blog.index', ['search' => request('search')]) }}" 
                       class="px-4 py-2 text-[10px] font-bold uppercase tracking-widest border-2 transition-all {{ empty($category) ? 'bg-black text-white border-black' : 'bg-transparent text-gray-500 border-gray-200 hover:border-black hover:text-black' }}">
                        All
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('blog.index', ['category' => $cat, 'search' => request('search')]) }}" 
                           class="px-4 py-2 text-[10px] font-bold uppercase tracking-widest border-2 transition-all {{ $category === $cat ? 'bg-black text-white border-black' : 'bg-transparent text-gray-500 border-gray-200 hover:border-black hover:text-black' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16" id="posts-container">
                @if($posts->isEmpty())
                    <div class="py-40 text-center opacity-20 col-span-full">
                        @if(!empty($search))
                            <p class="text-3xl italic">No articles found matching "{{ $search }}".</p>
                        @else
                            <p class="text-3xl italic">The journal is currently empty.</p>
                        @endif
                    </div>
                @else
                    @include('blog.partials.posts')
                @endif
            </div>

            @if($posts->hasMorePages())
                <div id="load-more-trigger" class="mt-32 py-10 flex justify-center items-center">
                    <div class="animate-pulse flex flex-col items-center">
                        <span class="w-12 h-[1px] bg-black mb-4"></span>
                        <span class="text-xs uppercase tracking-widest font-bold text-gray-500">Loading more</span>
                    </div>
                </div>

                <script>
                    (function() {
                        let page = 1;
                        let loading = false;
                        let hasMore = true;
                        const container = document.getElementById('posts-container');
                        const trigger = document.getElementById('load-more-trigger');

                        if (!container || !trigger) return;

                        const observer = new IntersectionObserver((entries) => {
                            if (entries[0].isIntersecting && !loading && hasMore) {
                                loadMore();
                            }
                        }, { rootMargin: '200px' });

                        observer.observe(trigger);

                        function loadMore() {
                            loading = true;
                            page++;
                            const urlParams = new URLSearchParams(window.location.search);
                            const searchQuery = urlParams.get('search') || '';
                            const catQuery = urlParams.get('category') || '';
                            fetch(`/blog?page=${page}&search=${encodeURIComponent(searchQuery)}&category=${encodeURIComponent(catQuery)}`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                                .then(response => response.text())
                                .then(html => {
                                    if (html.trim() === '') {
                                        hasMore = false;
                                        trigger.style.display = 'none';
                                    } else {
                                        container.insertAdjacentHTML('beforeend', html);
                                        // Re-initialize AOS on newly added elements
                                        if (typeof AOS !== 'undefined') {
                                            AOS.refresh();
                                        }
                                    }
                                    loading = false;
                                })
                                .catch(() => {
                                    loading = false;
                                });
                        }
                    })();
                </script>
            @endif
        </div>
    </section>
@endsection