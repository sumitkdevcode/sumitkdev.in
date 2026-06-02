@extends('layouts.app')

@section('canonical_url', route('portfolio.index'))

@section('pagination_meta')
    @if(request()->has('page') && request()->get('page') > 1)
        <meta name="robots" content="noindex, follow">
    @endif
@endsection

@section('content')
    <section class="pb-12 pt-12 relative bg-white border-b border-black/5 overflow-x-hidden">
        <!-- Floating Background Elements -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden flex flex-col justify-between py-20 opacity-5 z-0">
            <div class="whitespace-nowrap text-9xl font-bold uppercase tracking-tighter" style="animation: float 12s ease-in-out infinite;">
                SELECTED WORK &bull; PROJECTS &bull; CASE STUDIES &bull; SELECTED WORK &bull; PROJECTS &bull;
            </div>
            <div class="whitespace-nowrap text-9xl font-bold uppercase tracking-tighter" style="animation: float 14s ease-in-out infinite reverse;">
                DESIGN &bull; DEVELOPMENT &bull; ARCHITECTURE &bull; DESIGN &bull; DEVELOPMENT &bull; ARCHITECTURE
            </div>
        </div>        <!-- Background Grid -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.15] pointer-events-none" style="z-index: 1;"></div>

        <div class="max-w-7xl mx-auto px-6 relative" style="z-index: 10;">
            <div class="mb-12" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8 font-bold">Selected Work</p>
                <h1 class="text-5xl md:text-7xl font-bold tracking-[-0.1em] uppercase mb-8">
                    <span class="text-outline-premium opacity-100">Work</span>
                </h1>
                <p class="text-xl text-gray-500 max-w-2xl font-light">A curated selection of digital products, brand identities, and technical architecture.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-x-20 gap-y-32">
                @forelse($projects as $index => $project)
                    <div class="group {{ $index % 2 != 0 ? 'md:mt-32' : '' }}" data-aos="fade-up">
                        <a href="{{ route('portfolio.show', $project->slug) }}" class="block relative">
                            <div class="aspect-[16/10] bg-gray-100 overflow-hidden mb-8 neo-frame image-reveal-wrapper">
                                <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
                            </div>
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-3xl font-bold mb-2 transition-all">{{ $project->title }}</h3>
                                    <p class="text-gray-500 text-sm uppercase tracking-widest">{{ $project->category }}</p>
                                </div>
                                <span class="w-12 h-12 flex-shrink-0 flex items-center justify-center border-2 border-black rounded-full group-hover:bg-black group-hover:text-white transition-all -rotate-45 group-hover:rotate-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-40 text-center">
                        <p class="text-3xl font-bold tracking-tighter opacity-20 text-black">New projects are being documented.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-32">
                {{ $projects->links() }}
            </div>
        </div>
    </section>
@endsection