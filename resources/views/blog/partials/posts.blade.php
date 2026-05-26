@foreach($posts as $post)
    <article class="group relative py-20 border-t border-black/5 hover:bg-gray-50 transition-colors px-4" data-aos="fade-up">
        <a href="{{ route('blog.show', $post->slug) }}" class="grid lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-2 text-xs uppercase tracking-[0.3em] text-gray-400 pt-2">
                {{ optional($post->published_at)->format('M d, Y') ?? 'Draft' }}
            </div>
            <div class="lg:col-span-10">
                <p class="text-[10px] uppercase tracking-widest font-bold mb-4 opacity-50">{{ $post->category }}
                </p>
                <h2
                    class="text-4xl md:text-6xl font-bold uppercase tracking-tight mb-8 leading-tight group-hover:italic transition-all">
                    {{ $post->title }}</h2>
                <p class="text-lg text-gray-600 max-w-3xl font-light leading-relaxed">{{ $post->excerpt }}</p>

                <div class="mt-12 flex items-center space-x-4">
                    <span class="text-xs font-bold uppercase tracking-widest">Read Article</span>
                    <span class="w-8 h-[1px] bg-black group-hover:w-16 transition-all"></span>
                </div>
            </div>
        </a>
    </article>
@endforeach
