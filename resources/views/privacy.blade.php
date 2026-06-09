@extends('layouts.app')

@section('canonical_url', route('privacy'))
@section('meta_title', 'Privacy Policy - Sumit Kumar')
@section('meta_description', 'Privacy Policy for sumitkdev.in')

@section('content')
    <!-- Header -->
    <section class="py-32 relative bg-white overflow-hidden border-b border-black/5">
        <!-- Floating Background Elements -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden flex flex-col justify-between py-20 opacity-5 z-0">
            <div class="animate-float-slow whitespace-nowrap text-9xl font-bold uppercase tracking-tighter">
                PRIVACY POLICY &bull; DATA PROTECTION &bull; PRIVACY &bull;
            </div>
            <div class="animate-float-slow-reverse whitespace-nowrap text-9xl font-bold uppercase tracking-tighter">
                SECURITY &bull; TRANSPARENCY &bull; SECURITY &bull; TRANSPARENCY &bull;
            </div>
        </div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <div data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8 font-bold">Legal</p>
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase leading-none mb-12">
                    Privacy <span class="text-outline-premium opacity-100">Policy</span>
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
                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-0">1. Information Collection</h2>
                <p>We collect information you provide directly to us. For example, we collect information when you create an account, fill out a form, request customer support, or otherwise communicate with us.</p>
                <p>The types of information we may collect include your name, email address, postal address, phone number, and any other information you choose to provide.</p>

                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-12">2. Use of Information</h2>
                <p>We use the information we collect to provide, maintain, and improve our services, such as to administer your account and to provide you with the services you request.</p>
                
                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-12">3. Cookies</h2>
                <p>We use cookies and similar tracking technologies to track the activity on our Service and hold certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.</p>

                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-12">4. Third-Party Services</h2>
                <p>We may employ third-party companies and individuals due to the following reasons: to facilitate our Service; to provide the Service on our behalf; to perform Service-related services; or to assist us in analyzing how our Service is used.</p>

                <h2 class="text-2xl font-bold uppercase tracking-widest text-black mb-6 mt-12">5. Contact Us</h2>
                <p>If you have any questions about this Privacy Policy, please contact us at: <a href="mailto:{{ $settings['email'] }}" class="text-black font-bold underline hover:no-underline">{{ $settings['email'] }}</a></p>
            </div>
        </div>
    </section>
@endsection
