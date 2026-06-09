@extends('layouts.app')

@section('meta_title', '403 Forbidden - Sumit Kumar')
@section('meta_description', 'Access forbidden.')

@section('content')
    <section class="min-h-[80vh] py-32 relative bg-white overflow-hidden flex items-center justify-center">
        <!-- Floating Background Elements -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden flex flex-col justify-center py-20 opacity-5 z-0">
            <div class="animate-float-slow whitespace-nowrap text-9xl font-bold uppercase tracking-tighter text-center">
                403 &bull; FORBIDDEN &bull; NO ACCESS &bull; 403 &bull;
            </div>
        </div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <div data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8 font-bold">Error 403</p>
                <h1 class="text-6xl md:text-9xl font-bold tracking-tighter uppercase leading-none mb-12">
                    Access <span class="text-outline-premium opacity-100">Denied</span>
                </h1>
                <p class="text-xl md:text-2xl font-light text-gray-600 mb-12 max-w-2xl mx-auto">
                    You don't have permission to access this resource.
                </p>
                
                <a href="{{ route('home') }}" class="inline-block bg-black text-white px-12 py-5 text-sm font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl neo-frame">
                    Back to Home
                </a>
            </div>
        </div>
    </section>
@endsection
