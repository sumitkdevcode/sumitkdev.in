@extends('layouts.app')

@section('canonical_url', route('portfolio.index'))

@section('pagination_meta')
    @if(request()->has('page') && request()->get('page') > 1)
        <meta name="robots" content="noindex, follow">
    @endif
@endsection

@section('content')
    <section class="pb-32">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-20" data-aos="fade-up">
                <h1 class="text-7xl md:text-9xl font-bold tracking-tighter uppercase mb-8">Work</h1>
                <p class="text-xl text-gray-500 max-w-2xl font-light italic">A curated selection of digital products, brand
                    identities, and technical architecture.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-12 gap-y-24">
                @forelse($projects as $project)
                    <div class="group" data-aos="fade-up">
                        <a href="{{ route('portfolio.show', $project->slug) }}">
                            <div class="aspect-square bg-gray-100 overflow-hidden mb-8">
                                <img src="{{ asset('storage/' . $project->featured_image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover img-premium" loading="lazy">
                            </div>
                            <div class="space-y-2">
                                <p class="text-[10px] uppercase tracking-[0.3em] text-gray-400">{{ $project->category }}</p>
                                <h3 class="text-2xl font-bold group-hover:underline underline-offset-8">{{ $project->title }}
                                </h3>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-40 text-center">
                        <p class="text-3xl font-premium italic opacity-20 text-black">New projects are being documented.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-32">
                {{ $projects->links() }}
            </div>
        </div>
    </section>
@endsection