@extends('layouts.app')

@section('meta_title', 'Page Not Found — 404 | Sumit Kumar')
@section('meta_description', 'The page you are looking for does not exist or has been moved.')

@section('content')
    <section class="min-h-[70vh] flex items-center justify-center pt-20 pb-32">
        <div class="max-w-3xl mx-auto px-6 text-center" data-aos="fade-up">
            <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-6 font-bold">Error 404</p>
            <h1 class="text-7xl md:text-9xl font-bold tracking-tighter uppercase leading-none mb-10">Lost in <br/><span class="italic font-light">Space</span></h1>
            <p class="text-xl text-gray-500 font-light max-w-xl mx-auto mb-16 leading-relaxed">
                The page you're looking for seems to have vanished. It might have been moved, renamed, or perhaps it never existed at all.
            </p>
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-4 group text-sm font-bold uppercase tracking-widest">
                <span class="w-12 h-[1px] bg-black group-hover:w-20 transition-all"></span>
                <span>Return Home</span>
            </a>
        </div>
    </section>
@endsection
