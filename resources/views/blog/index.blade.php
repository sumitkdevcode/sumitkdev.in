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
    <section class="pb-32">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-32" data-aos="fade-up">
                <h1 class="text-7xl md:text-9xl font-bold tracking-tighter uppercase mb-8">Blog</h1>
                <p class="text-xl text-gray-500 max-w-2xl font-light italic">Insights on software architecture, design
                    systems, and the future of creative technology.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16" id="posts-container">
                @if($posts->isEmpty())
                    <div class="py-40 text-center opacity-20">
                        <p class="text-3xl italic">The journal is currently empty.</p>
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
                            fetch(`/blog?page=${page}`, {
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