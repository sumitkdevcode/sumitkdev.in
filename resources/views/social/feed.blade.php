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

    <!-- SocialMediaPosting Schema for Instagram -->
    @if(count($instagramPosts) > 0)
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "itemListElement": [
            @foreach($instagramPosts as $index => $post)
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
                <a href="https://www.youtube.com/channel/{{ config('services.youtube.channel_id') }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold uppercase tracking-widest hover:text-red-600 transition-colors">Subscribe &rarr;</a>
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

        @if(count($instagramPosts) > 0)
        <!-- Instagram Section -->
        <div>
            <div class="flex items-center justify-between mb-8" data-aos="fade-up">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 flex items-center gap-3">
                    <svg class="w-8 h-8 text-pink-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12,2.162c3.204,0,3.584,0.012,4.849,0.07c1.366,0.062,2.633,0.344,3.608,1.319c0.975,0.975,1.257,2.242,1.319,3.608c0.058,1.265,0.07,1.645,0.07,4.849c0,3.204-0.012,3.584-0.07,4.849c-0.062,1.366-0.344,2.633-1.319,3.608c-0.975,0.975-2.242,1.257-3.608,1.319c-1.265,0.058-1.645,0.07-4.849,0.07c-3.204,0-3.584-0.012-4.849-0.07c-1.366-0.062-2.633-0.344-3.608-1.319c-0.975-0.975-1.257-2.242-1.319-3.608c-0.058-1.265-0.07-1.645-0.07-4.849c0-3.204,0.012-3.584,0.07-4.849c0.062-1.366,0.344-2.633,1.319-3.608c0.975-0.975,2.242-1.257,3.608-1.319C8.416,2.174,8.796,2.162,12,2.162 M12,0C8.741,0,8.332,0.014,7.052,0.072C2.695,0.272,0.272,2.69-0.072,7.052C-0.014,8.332,0,8.741,0,12c0,3.259-0.014,3.668,0.072,4.948c0.344,4.362,2.767,6.78,7.124,6.98C8.332,23.986,8.741,24,12,24c3.259,0,3.668-0.014,4.948-0.072c4.358-0.2,6.78-2.618,6.98-6.98C23.986,15.668,24,15.259,24,12c0-3.259-0.014-3.668-0.072-4.948c-0.2-4.358-2.618-6.78-6.98-6.98C15.668,0.014,15.259,0,12,0z"/><path d="M12,5.838c-3.403,0-6.162,2.759-6.162,6.162c0,3.403,2.759,6.162,6.162,6.162c3.403,0,6.162-2.759,6.162-6.162C18.162,8.597,15.403,5.838,12,5.838z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S14.209,16,12,16z"/><circle cx="18.406" cy="5.594" r="1.44"/></svg>
                    Recent Posts
                </h2>
                <a href="https://instagram.com/sumitkdev" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold uppercase tracking-widest hover:text-pink-600 transition-colors">Follow &rarr;</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-8">
                @foreach($instagramPosts as $post)
                <a href="{{ $post['permalink'] }}" target="_blank" rel="noopener" class="group block relative aspect-square overflow-hidden border-2 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-2 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <img src="{{ $post['media_url'] }}" alt="Instagram post" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 lg:p-6">
                        <p class="text-white text-xs lg:text-sm line-clamp-3 mb-2">{{ $post['caption'] }}</p>
                        <span class="text-white/70 text-[10px] lg:text-xs font-bold uppercase tracking-widest">{{ \Carbon\Carbon::parse($post['published_at'])->diffForHumans() }}</span>
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
