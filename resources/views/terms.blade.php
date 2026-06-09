@extends('layouts.app')

@section('canonical_url', route('terms'))
@section('meta_title', 'Terms of Service - Sumit Kumar')
@section('meta_description', 'Terms of Service for sumitkdev.in')

@section('content')
    <!-- Header -->
    <section class="py-32 relative bg-white overflow-hidden border-b border-black/5">
        <!-- Floating Background Elements -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden flex flex-col justify-between py-20 opacity-5 z-0">
            <div class="animate-float-slow whitespace-nowrap text-9xl font-bold uppercase tracking-tighter">
                TERMS OF SERVICE &bull; LEGAL &bull; TERMS &bull;
            </div>
            <div class="animate-float-slow-reverse whitespace-nowrap text-9xl font-bold uppercase tracking-tighter">
                AGREEMENT &bull; CONDITIONS &bull; AGREEMENT &bull; CONDITIONS &bull;
            </div>
        </div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <div data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8 font-bold">Legal</p>
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase leading-none mb-12">
                    Terms of <span class="text-outline-premium opacity-100">Service</span>
                </h1>
                <p class="text-xl font-light text-gray-600 mb-8">
                    Last updated: {{ date('F d, Y') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="prose prose-lg text-gray-600 font-light leading-relaxed max-w-none neo-frame bg-white p-10 md:p-16 border-2 border-black/10">
                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-0">1. Acceptance of Terms</h2>
                <p>By accessing or using our website, you agree to be bound by these Terms of Service. If you do not agree to all the terms and conditions of this agreement, then you may not access the website or use any services.</p>

                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-12">2. Use License</h2>
                <p>Permission is granted to temporarily download one copy of the materials (information or software) on this website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title.</p>

                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-12">3. Disclaimer</h2>
                <p>The materials on this website are provided on an 'as is' basis. We make no warranties, expressed or implied, and hereby disclaim and negate all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>

                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-12">4. Limitations</h2>
                <p>In no event shall we or our suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on this website.</p>

                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-12">5. Contact Information</h2>
                <p>Questions about the Terms of Service should be sent to us at <a href="mailto:{{ $settings['email'] }}" class="text-black font-bold underline hover:no-underline">{{ $settings['email'] }}</a>.</p>
            </div>
        </div>
    </section>
@endsection
