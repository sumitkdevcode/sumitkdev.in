@extends('layouts.app')

@section('title', 'Journal — Sumit Kumar')

@section('content')
    <section class="pb-32">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-32" data-aos="fade-up">
                <h1 class="text-7xl md:text-9xl font-bold tracking-tighter uppercase mb-8">Blog</h1>
                <p class="text-xl text-gray-500 max-w-2xl font-light italic">Insights on software architecture, design
                    systems, and the future of creative technology.</p>
            </div>

            <div class="space-y-0">
                @forelse($posts as $post)
                    <article class="group relative py-20 border-t border-black/5 hover:bg-gray-50 transition-colors px-4"
                        data-aos="fade-up">
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
                @empty
                    <div class="py-40 text-center opacity-20">
                        <p class="text-3xl italic">The journal is currently empty.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-32">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection