@extends('layouts.app')

@section('meta_title', $seoData->meta_title)
@section('meta_description', $seoData->meta_description)
@section('og_title', $seoData->og_title)
@section('og_description', $seoData->og_description)

@section('meta')
    <!-- CollectionPage Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "Sumit Kumar's Social Feed",
        "description": "Latest YouTube videos and Instagram posts from Sumit Kumar.",
        "url": "{{ url('/feed') }}"
    }
    </script>

    <!-- VideoObject Schema for YouTube -->
    @if(count($youtubeVideos) > 0)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($youtubeVideos as $index => $video)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "VideoObject",
                    "name": "{{ addslashes($video['title']) }}",
                    "description": "{{ addslashes($video['description']) }}",
                    "thumbnailUrl": "{{ $video['thumbnail'] }}",
                    "uploadDate": "{{ $video['published_at'] }}",
                    "embedUrl": "{{ $video['embed_url'] }}"
                }
            }{{ $loop->last ? '' : ',' }}
            @endforeach
        ]
    }
    </script>
    @endif

    <!-- SocialMediaPosting Schema for Social Posts -->
    @if(count($socialPosts) > 0)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($socialPosts as $index => $post)
            {
                "@type": "ListItem",
                "position": {{ $index + 1 }},
                "item": {
                    "@type": "SocialMediaPosting",
                    "headline": "{{ addslashes(Str::limit($post['caption'], 100)) }}",
                    "image": "{{ $post['media_url'] }}",
                    "url": "{{ $post['permalink'] }}",
                    "datePublished": "{{ $post['published_at'] }}",
                    "author": {
                        "@type": "Person",
                        "name": "Sumit Kumar"
                    }
                }
            }{{ $loop->last ? '' : ',' }}
            @endforeach
        ]
    }
    </script>
    @endif
@endsection

@section('content')
<!-- Floating Background Elements -->
<div class="fixed inset-0 pointer-events-none overflow-hidden flex flex-col justify-between py-20 opacity-5 z-0">
    <div class="whitespace-nowrap text-9xl font-bold uppercase tracking-tighter" style="animation: float 12s ease-in-out infinite;">
        SOCIAL FEED &bull; YOUTUBE &bull; INSTAGRAM &bull; SOCIAL FEED &bull; YOUTUBE &bull;
    </div>
    <div class="whitespace-nowrap text-9xl font-bold uppercase tracking-tighter" style="animation: float 14s ease-in-out infinite reverse;">
        VIDEOS &bull; POSTS &bull; CONTENT &bull; VIDEOS &bull; POSTS &bull; CONTENT
    </div>
</div>

<div class="min-h-screen pt-32 pb-24 relative z-10">
    <div class="max-w-[1400px] mx-auto px-6">
        <div class="mb-20" data-aos="fade-up">
            <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8 font-bold">Updates</p>
            <h1 class="text-5xl md:text-7xl font-bold tracking-[-0.1em] uppercase mb-8">
                <span class="text-outline-premium opacity-100">Social Feed</span>
            </h1>
            <p class="text-xl text-gray-500 max-w-2xl font-light">Catch up on my latest YouTube tutorials and Instagram moments.</p>
        </div>

        @if(count($youtubeVideos) > 0)
        <!-- YouTube Section -->
        <div class="mb-24">
            <div class="flex items-center justify-between mb-8" data-aos="fade-up">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 flex items-center gap-3">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M21.582,6.186c-0.23-0.86-0.908-1.538-1.768-1.768C18.254,4,12,4,12,4S5.746,4,4.186,4.418c-0.86,0.23-1.538,0.908-1.768,1.768C2,7.746,2,12,2,12s0,4.254,0.418,5.814c0.23,0.86,0.908,1.538,1.768,1.768C5.746,20,12,20,12,20s6.254,0,7.814-0.418c0.86-0.23,1.538-0.908,1.768-1.768C22,16.254,22,12,22,12S22,7.746,21.582,6.186z M10,15.464V8.536L16,12L10,15.464z"/></svg>
                    Latest Videos
                </h2>
                @php
                    $youtubeLink = isset($globalSocialLinks['social_media']) 
                        ? $globalSocialLinks['social_media']->firstWhere('platform_name', 'YouTube') 
                        : null;
                    $youtubeUrl = $youtubeLink ? $youtubeLink->url : 'https://www.youtube.com/@sumitkdev';
                @endphp
                <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold uppercase tracking-widest hover:text-red-600 transition-colors">Subscribe &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($youtubeVideos as $video)
                <div class="bg-white border-2 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-2 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transition-all duration-300 group flex flex-col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative aspect-video overflow-hidden">
                        <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors flex items-center justify-center">
                            <a href="{{ $video['url'] }}" target="_blank" rel="noopener" class="w-16 h-16 bg-red-600 border-2 border-black flex items-center justify-center text-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </a>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col border-t-2 border-black">
                        <h3 class="text-lg font-black mb-2 line-clamp-2"><a href="{{ $video['url'] }}" target="_blank" rel="noopener" class="hover:text-red-600 transition-colors">{{ $video['title'] }}</a></h3>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-3">{{ $video['description'] }}</p>
                        <div class="mt-auto text-xs text-gray-400 uppercase tracking-widest font-semibold">
                            {{ \Carbon\Carbon::parse($video['published_at'])->diffForHumans() }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if(count($socialPosts) > 0)
        <!-- Recent Posts Section -->
        <div>
            <div class="flex items-center justify-between mb-8" data-aos="fade-up">
                <div class="flex flex-wrap items-center gap-4 sm:gap-6">
                    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        <span class="hidden sm:inline">LinkedIn</span>
                    </h2>
                    <span class="text-gray-300 text-2xl sm:text-3xl font-light">/</span>
                    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        <span class="hidden sm:inline">X</span>
                    </h2>
                    <span class="text-gray-300 text-2xl sm:text-3xl font-light">/</span>
                    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.7-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        <span class="hidden sm:inline">Instagram</span>
                    </h2>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-8">
                @foreach($socialPosts as $post)
                <a href="{{ $post['permalink'] }}" target="_blank" rel="noopener" class="group block relative aspect-square overflow-hidden border-2 border-black bg-gray-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-2 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    @if($post['media_url'])
                    <img src="{{ $post['media_url'] }}" alt="Social post" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t {{ $post['media_url'] ? 'from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100' : 'from-black/80 via-black/60 to-black/40 opacity-100' }} transition-opacity duration-300 flex flex-col justify-end p-4 lg:p-6">
                        <p class="text-white text-xs lg:text-sm line-clamp-3 mb-2">{{ $post['caption'] }}</p>
                        <div class="flex justify-between items-center w-full mt-auto">
                            <span class="text-white/70 text-[10px] lg:text-xs font-bold uppercase tracking-widest">{{ \Carbon\Carbon::parse($post['published_at'])->diffForHumans() }}</span>
                            <span class="text-white/50 text-[10px] uppercase font-bold">{{ $post['platform'] ?? 'Update' }}</span>
                        </div>
                    </div>
                    @if($post['media_type'] === 'VIDEO')
                        <div class="absolute top-4 right-4 bg-black/50 backdrop-blur-sm rounded-full p-2 text-white">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        </div>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
