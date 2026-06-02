@extends('layouts.app')

@section('meta_title', $project->meta_title ?? ($project->title . ' — Portfolio | Sumit Kumar'))
@section('meta_description', $project->meta_description ?? Str::limit(strip_tags($project->description), 160))
@section('meta_keywords', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) . ', Sumit Kumar' : 'Sumit Kumar portfolio')

@section('og_type', 'article')
@section('og_title', $project->meta_title ?? ($project->title . ' — Portfolio | Sumit Kumar'))
@section('og_description', $project->meta_description ?? Str::limit(strip_tags($project->description), 160))
@section('og_image', $project->featured_image ? asset('storage/' . $project->featured_image) : asset('images/og-default.webp'))

@section('twitter_title', $project->meta_title ?? ($project->title . ' — Portfolio | Sumit Kumar'))
@section('twitter_description', $project->meta_description ?? Str::limit(strip_tags($project->description), 160))
@section('twitter_image', $project->featured_image ? asset('storage/' . $project->featured_image) : asset('images/og-default.webp'))
@section('content')
    <article class="pb-32">
        <!-- Header -->
        <header class="max-w-7xl mx-auto px-6 mb-16 pt-8">
            <div class="grid lg:grid-cols-12 gap-12 items-end">
                <div class="lg:col-span-8" data-aos="fade-right">
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-6 font-bold">{{ $project->category }}</p>
                    <h1 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase leading-none">
                        <span class="text-outline-premium opacity-100">{{ $project->title }}</span>
                    </h1>
                </div>
                <div class="lg:col-span-4 lg:text-right" data-aos="fade-left">
                    <div class="space-y-6">
                        @if($project->live_link)
                            <a href="{{ $project->live_link }}" target="_blank"
                                class="inline-block bg-black text-white px-8 py-4 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all neo-frame hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">Launch
                                Project</a>
                        @endif
                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank"
                                class="block text-xs font-bold uppercase tracking-widest hover:underline decoration-1 underline-offset-4 hover:text-gray-500">Source
                                Code</a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Image -->
        <section class="mb-24 px-6 max-w-7xl mx-auto" data-aos="zoom-out">
            <!-- Main Viewer -->
            <div class="aspect-[16/9] bg-gray-100 overflow-hidden mb-8 neo-frame">
                <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}" id="mainImage"
                    class="w-full h-full object-cover transition-opacity duration-300" fetchpriority="high">
            </div>

            <!-- Sub Images Row -->
            @if($project->sub_images && count($project->sub_images) > 0)
                <div class="flex overflow-x-auto gap-4 pb-6 no-scrollbar">
                    {{-- Original Image --}}
                    <div class="flex-none w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 overflow-hidden group border-2 border-black/10 hover:border-black transition-all cursor-pointer neo-frame"
                        onclick="updateMainImage('{{ asset('storage/' . $project->featured_image) }}')">
                        <img src="{{ asset('storage/' . $project->featured_image) }}" alt=""
                            class="w-full h-full object-cover transition-all duration-700" loading="lazy">
                    </div>

                    {{-- Sub Images --}}
                    @foreach($project->sub_images as $image)
                        <div class="flex-none w-24 h-24 sm:w-32 sm:h-32 bg-gray-50 overflow-hidden group border-2 border-black/10 hover:border-black transition-all cursor-pointer neo-frame"
                            onclick="updateMainImage('{{ asset('storage/' . $image) }}')">
                            <img src="{{ asset('storage/' . $image) }}" alt=""
                                class="w-full h-full object-cover transition-all duration-700" loading="lazy">
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
                                <li class="px-3 py-1 border border-black/20 text-[10px] uppercase font-bold hover:bg-black hover:text-white transition-colors cursor-default neo-frame">{{ $tech }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-4">Role</h4>
                        <p class="text-sm font-bold uppercase">Lead Developer & Designer</p>
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

    <section class="py-32 border-t border-black/5 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 flex justify-center items-center">
            <a href="{{ route('portfolio.index') }}"
                class="group flex items-center space-x-4 text-sm font-bold uppercase tracking-widest bg-white border-2 border-black/10 px-8 py-4 hover:border-black transition-all hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <svg class="w-4 h-4 rotate-180 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
                <span>Back to Work</span>
            </a>
        </div>
    </section>
@endsection