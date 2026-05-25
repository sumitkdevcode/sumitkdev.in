@extends('layouts.app')

@section('title', $project->title . ' — Sumit Kumar')

@section('content')
    <article class="pb-32">
        <!-- Header -->
        <header class="max-w-7xl mx-auto px-6 mb-24">
            <div class="grid lg:grid-cols-12 gap-12 items-end">
                <div class="lg:col-span-8" data-aos="fade-right">
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-6">{{ $project->category }}</p>
                    <h1 class="text-6xl md:text-8xl font-bold tracking-tighter uppercase leading-none">{{ $project->title }}
                    </h1>
                </div>
                <div class="lg:col-span-4 lg:text-right" data-aos="fade-left">
                    <div class="space-y-6">
                        @if($project->live_link)
                            <a href="{{ $project->live_link }}" target="_blank"
                                class="inline-block bg-black text-white px-8 py-4 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">Launch
                                Project</a>
                        @endif
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank"
                                class="block text-xs font-bold uppercase tracking-widest hover:underline decoration-1 underline-offset-4">Source
                                Code</a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Image -->
        <section class="mb-24 px-6 max-w-7xl mx-auto" data-aos="zoom-out">
            <!-- Main Viewer -->
            <div class="aspect-video bg-gray-100 overflow-hidden shadow-2xl mb-8">
                <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}" id="mainImage"
                    class="w-full h-full  transition-opacity duration-300">
            </div>

            <!-- Sub Images Row -->
            @if($project->sub_images && count($project->sub_images) > 0)
                <div class="flex overflow-x-auto gap-4 pb-6 no-scrollbar">
                    {{-- Original Image --}}
                    <div class="flex-none w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 overflow-hidden group border-2 border-transparent hover:border-black transition-all cursor-pointer"
                        onclick="updateMainImage('{{ asset('storage/' . $project->featured_image) }}')">
                        <img src="{{ asset('storage/' . $project->featured_image) }}" alt=""
                            class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700">
                    </div>

                    {{-- Sub Images --}}
                    @foreach($project->sub_images as $image)
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

        <!-- Details -->
        <section class="max-w-7xl mx-auto px-6 grid lg:grid-cols-12 gap-20">
            <aside class="lg:col-span-4" data-aos="fade-up">
                <div class="sticky top-32 space-y-12">
                    <div>
                        <h4 class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-4">Core Technology</h4>
                        <ul class="flex flex-wrap gap-2">
                            @foreach($project->tech_stack ?? [] as $tech)
                                <li class="px-3 py-1 border border-black/10 text-[10px] uppercase font-bold">{{ $tech }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-4">Role</h4>
                        <p class="text-sm font-bold uppercase italic">Lead Developer & Designer</p>
                    </div>
                </div>
            </aside>

            <div class="lg:col-span-8 space-y-16" data-aos="fade-up" data-aos-delay="200">
                <div class="prose prose-2xl max-w-none text-black font-light leading-relaxed">
                    {!! $project->description !!}
                </div>

            </div>
        </section>
    </article>

    <section class="py-32 border-t border-black/5">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('portfolio.index') }}"
                class="group flex items-center space-x-4 text-sm font-bold uppercase tracking-widest">
                <span class="w-12 h-[1px] bg-black group-hover:w-20 transition-all"></span>
                <span>Back to Work</span>
            </a>
        </div>
    </section>
@endsection