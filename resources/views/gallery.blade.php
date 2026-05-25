@extends('layouts.app')

@section('title', 'Gallery — Sumit Kumar')

@section('content')
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-20" data-aos="fade-up">
                <h1 class="text-7xl md:text-9xl font-bold tracking-tighter uppercase mb-8">Gallery</h1>
                <p class="text-xl text-gray-500 max-w-2xl font-light italic">A visual library of behind-the-scenes moments,
                    experimental motion, and creative captures.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($media as $item)
                    <div class="group relative aspect-square bg-gray-100 overflow-hidden" data-aos="fade-up">
                        @if($item->file_type === 'video')
                            <video src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-full object-cover" muted loop
                                onmouseover="this.play()" onmouseout="this.pause()"></video>
                            <div class="absolute top-4 left-4">
                                <svg class="w-4 h-4 text-white drop-shadow-md" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z">
                                    </path>
                                </svg>
                            </div>
                        @else
                            <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500">
                        @endif

                        <div
                            class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-6 text-white">
                            <p class="text-[10px] uppercase font-bold tracking-[0.2em] mb-1">{{ $item->category }}</p>
                            <h4 class="text-sm font-bold truncate">{{ $item->title }}</h4>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-40 text-center opacity-20">
                        <p class="text-3xl italic">The visual library is currently empty.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-20">
                {{ $media->links() }}
            </div>
        </div>
    </section>
@endsection