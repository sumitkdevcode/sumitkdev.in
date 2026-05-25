@extends('layouts.app')

@section('title', $post->title . ' — Sumit Kumar')

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
                        <p class="text-xs font-bold uppercase tracking-widest">{{ $post->author->name }}</p>
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
                        class="w-full h-full  transition-opacity duration-300">
                </div>

                <!-- Sub Images Row -->
                @if($post->sub_images && count($post->sub_images) > 0)
                    <div class="flex overflow-x-auto gap-4 pb-6 no-scrollbar">
                        {{-- Original Image --}}
                        <div class="flex-none w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 overflow-hidden group border-2 border-transparent hover:border-black transition-all cursor-pointer"
                            onclick="updateMainImage('{{ asset('storage/' . $post->featured_image) }}')">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt=""
                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
                        </div>

                        {{-- Sub Images --}}
                        @foreach($post->sub_images as $image)
                            <div class="flex-none w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 overflow-hidden group border-2 border-transparent hover:border-black transition-all cursor-pointer"
                                onclick="updateMainImage('{{ asset('storage/' . $image) }}')">
                                <img src="{{ asset('storage/' . $image) }}" alt=""
                                    class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
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