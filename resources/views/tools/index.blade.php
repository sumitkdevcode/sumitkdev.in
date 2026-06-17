@extends('layouts.app')

@section('meta_title', $seoData->meta_title ?? 'Developer Tools | Sumit Kumar')
@section('meta_description', $seoData->meta_description ?? 'Free developer tools.')
@section('og_title', $seoData->og_title ?? 'Developer Tools')
@section('og_description', $seoData->og_description ?? 'Free developer tools.')

@section('meta')
    <!-- CollectionPage Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "Free Developer Tools",
        "description": "A collection of free, fast, and secure developer utilities including JSON Formatter, Base64 Encoder, and UUID Generator.",
        "url": "{{ url('/tools') }}",
        "publisher": {
            "@type": "Person",
            "name": "Sumit Kumar"
        }
    }
    </script>
@endsection

@section('content')
<!-- Watermark Background -->
<div class="fixed top-1/2 left-0 w-full -translate-y-1/2 -z-10 overflow-hidden pointer-events-none opacity-[0.03]">
    <div class="whitespace-nowrap text-[12vw] font-black tracking-tighter text-black select-none flex" style="animation: marquee 40s linear infinite;">
        <span>DEVELOPER TOOLS &bull; UTILITIES &bull; FORMATTERS &bull; ENCODERS &bull; DEVELOPER TOOLS &bull;&nbsp;</span>
        <span>DEVELOPER TOOLS &bull; UTILITIES &bull; FORMATTERS &bull; ENCODERS &bull; DEVELOPER TOOLS &bull;&nbsp;</span>
    </div>
</div>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
</style>

<div class="min-h-screen py-16 sm:py-24 relative z-10">
    <div class="max-w-[1400px] mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl font-black tracking-tighter mb-4 text-black">Developer Tools</h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto">Free, lightning-fast utilities built for developers. No ads, no tracking, just tools.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- JSON Formatter -->
            <a href="{{ route('tools.json-formatter') }}" class="block bg-white border-2 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 hover:-translate-y-2 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transition-all duration-300 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-20 h-20 bg-gray-100 border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center mb-8 group-hover:bg-black transition-colors duration-300">
                    <svg class="w-10 h-10 text-black group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-black mb-3 tracking-tight">JSON Formatter</h2>
                <p class="text-gray-600 leading-relaxed mb-8">Format, beautify, and validate JSON data instantly in your browser.</p>
                <span class="text-sm font-bold text-black border-b-2 border-black pb-1 uppercase tracking-widest group-hover:pl-2 transition-all">Use Tool &rarr;</span>
            </a>

            <!-- Base64 Encoder -->
            <a href="{{ route('tools.base64') }}" class="block bg-white border-2 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 hover:-translate-y-2 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-20 h-20 bg-gray-100 border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center mb-8 group-hover:bg-black transition-colors duration-300">
                    <svg class="w-10 h-10 text-black group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-black mb-3 tracking-tight">Base64 Encoder</h2>
                <p class="text-gray-600 leading-relaxed mb-8">Fast and secure tool to encode strings to Base64 or decode them back.</p>
                <span class="text-sm font-bold text-black border-b-2 border-black pb-1 uppercase tracking-widest group-hover:pl-2 transition-all">Use Tool &rarr;</span>
            </a>

            <!-- UUID Generator -->
            <a href="{{ route('tools.uuid-generator') }}" class="block bg-white border-2 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 hover:-translate-y-2 hover:shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transition-all duration-300 group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-20 h-20 bg-gray-100 border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center mb-8 group-hover:bg-black transition-colors duration-300">
                    <svg class="w-10 h-10 text-black group-hover:text-white transition-colors duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-black mb-3 tracking-tight">UUID Generator</h2>
                <p class="text-gray-600 leading-relaxed mb-8">Instantly generate cryptographically secure random v4 UUIDs / GUIDs.</p>
                <span class="text-sm font-bold text-black border-b-2 border-black pb-1 uppercase tracking-widest group-hover:pl-2 transition-all">Use Tool &rarr;</span>
            </a>
        </div>
    </div>
</div>
@endsection
