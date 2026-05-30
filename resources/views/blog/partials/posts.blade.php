@foreach($posts as $post)
    <article class="group relative flex flex-col h-full bg-white transition-all hover:-translate-y-2 duration-500 neo-frame hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-4" data-aos="fade-up">
        <a href="{{ route('blog.show', $post->slug) }}" class="flex flex-col h-full">
            <div class="relative w-full aspect-[4/3] overflow-hidden bg-gray-100 mb-6 image-reveal-wrapper">
                @if($post->getImageUrl())
                    <img src="{{ $post->getImageUrl() }}" alt="{{ $post->title }}" class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700 project-image-scale" loading="lazy">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                        No Image
                    </div>
                @endif
                <div class="absolute top-4 left-4 bg-white border-2 border-black px-3 py-1 text-[9px] uppercase tracking-widest font-bold">
                    {{ $post->category }}
                </div>
            </div>
            
            <div class="flex-1 flex flex-col px-2">
                <div class="flex items-center space-x-2 text-[10px] text-gray-400 font-bold tracking-widest uppercase mb-4">
                    <span>{{ optional($post->published_at)->format('M d, Y') ?? 'Draft' }}</span>
                    <span>&bull;</span>
                    <span>{{ $post->reading_time }}m read</span>
                </div>
                
                <h2 class="text-2xl font-bold tracking-tight mb-4 group-hover:italic transition-colors line-clamp-3">
                    {{ $post->title }}
                </h2>
                
                <p class="text-sm text-gray-500 leading-relaxed mb-6 line-clamp-3 flex-1">
                    {{ $post->excerpt }}
                </p>
                
                <div class="mt-auto flex items-center justify-between pb-2">
                    <span class="text-[10px] font-black uppercase tracking-widest border-b-2 border-black">Read Article</span>
                    <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </div>
            </div>
        </a>
    </article>
@endforeach
