@extends('layouts.app')

@section('canonical_url', route('gallery'))

@section('content')
    <section class="pt-12 pb-12 relative bg-white border-b border-black/5 overflow-x-hidden">


        <!-- Background Grid -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.15] pointer-events-none" style="z-index: 1;"></div>

        <div class="max-w-7xl mx-auto px-6 relative" style="z-index: 10;">
            <div class="mb-12" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8 font-bold">Moments</p>
                <h1 class="text-5xl md:text-7xl font-bold tracking-[-0.1em] uppercase mb-8">
                    <span class="text-outline-premium opacity-100">Gallery</span>
                </h1>
                <p class="text-xl text-gray-500 max-w-2xl font-light">A visual library of behind-the-scenes moments, experimental motion, and creative captures.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1">
                @forelse($media as $item)
                    <div class="group relative aspect-square bg-gray-100 overflow-hidden" data-aos="fade-up">
                        @if($item->file_type === 'video')
                            <video src="{{ asset('storage/' . $item->file_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" muted loop
                                onmouseover="this.play()" onmouseout="this.pause()" preload="none"></video>
                        @else
                            <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                        @endif

                        <!-- Dark Overlay -->
                        <div class="gallery-overlay absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-400 pointer-events-none">
                        </div>
                        
                        <!-- Center Icon (Play or View) -->
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <span class="bg-white text-black rounded-full p-4 transform translate-y-4 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-400 delay-150">
                                @if($item->file_type === 'video')
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                @endif
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-40 text-center opacity-20">
                        <p class="text-3xl font-bold">The visual library is currently empty.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-20">
                {{ $media->links() }}
            </div>
        </div>
    </section>
@endsection