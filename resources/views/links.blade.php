@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="py-32">
        <!-- Floating Background Elements -->
        <div class="fixed inset-0 pointer-events-none overflow-hidden flex flex-col justify-between py-20 opacity-5">
            <div class="animate-float-slow whitespace-nowrap text-9xl font-bold uppercase tracking-tighter">
                LINK IN BIO &bull; CONNECT &bull; DIGITAL PRESENCE &bull; LINK IN BIO &bull; CONNECT &bull;
            </div>
            <div class="animate-float-slow-reverse whitespace-nowrap text-9xl font-bold uppercase tracking-tighter">
                PORTFOLIO &bull; SOCIAL &bull; RESOURCES &bull; PORTFOLIO &bull; SOCIAL &bull; RESOURCES
            </div>
        </div>
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-24" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.5em] text-gray-400 font-bold mb-6">Digital Presence</p>
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase leading-none mb-8">
                    Find Me<br><span class="text-outline-premium opacity-100">Everywhere</span>
                </h1>
                <p class="text-xl text-gray-500 font-light max-w-2xl mx-auto leading-relaxed">
                    All my official profiles, platforms, and communities where I share code, write articles, and connect with developers.
                </p>
            </div>

            @php
                $sections = [
                    'social_media' => ['title' => 'Social Media', 'delay' => '0'],
                    'developer_profiles' => ['title' => 'Developer Profiles', 'delay' => '100'],
                    'competitive_coding' => ['title' => 'Competitive Coding', 'delay' => '200'],
                    'freelance_platforms' => ['title' => 'Freelance Platforms', 'delay' => '300'],
                    'website_blog' => ['title' => 'Website & Blog', 'delay' => '400'],
                ];
            @endphp

            @foreach ($sections as $catKey => $section)
                @if(isset($globalSocialLinks[$catKey]) && $globalSocialLinks[$catKey]->count() > 0)
                    <div class="mb-12" data-aos="fade-up" data-aos-delay="{{ $section['delay'] }}">
                        <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-8">{{ $section['title'] }}</h2>
                        <div class="space-y-4">
                            @foreach($globalSocialLinks[$catKey] as $index => $link)
                                <a href="{{ $link->url }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="group block bg-white border-2 border-black/10 hover:border-black p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] neo-frame"
                                   data-aos="fade-up" 
                                   data-aos-delay="{{ $index * 100 }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <span class="w-12 h-12 bg-gray-50 flex items-center justify-center border border-black/5 group-hover:bg-black group-hover:text-white transition-colors neo-frame-small">
                                                {!! str_replace('<svg ', '<svg class="w-5 h-5" ', $link->icon_svg) !!}
                                            </span>
                                            <span class="text-sm font-bold uppercase tracking-widest">{{ $link->platform_name }}</span>
                                        </div>
                                        <!-- Arrow -->
                                        <span class="w-10 h-10 border-2 border-black flex items-center justify-center -rotate-45 group-hover:rotate-0 group-hover:bg-black group-hover:text-white transition-all neo-frame-small">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- CTA -->
            <div class="mt-24 pt-20 border-t border-black/5 text-center" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-6">Want to collaborate?</p>
                <a href="{{ route('contact') }}" class="inline-block bg-black text-white px-12 py-5 text-sm font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl">
                    Get in Touch
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    @php
        $linksFaqs = [
            [
                'question' => 'Are all these profiles owned by Sumit Kumar?',
                'answer' => 'Yes, all profiles listed on this page are official accounts owned and maintained by Sumit Kumar (sumitkdev). Any profile not listed here may not be affiliated with sumitkdev.in.',
            ],
            [
                'question' => 'Which is the best way to connect with Sumit Kumar?',
                'answer' => 'For professional inquiries, LinkedIn or email (contact@sumitkdev.in) is recommended. For quick questions, Twitter/X is great. For project-related discussions, use the Contact form on this website.',
            ],
            [
                'question' => 'Does Sumit Kumar accept freelance work through these platforms?',
                'answer' => 'Yes, Sumit Kumar accepts freelance projects through Fiverr, Upwork, and Freelancer. You can also reach out directly through the website contact form for custom project discussions.',
            ],
        ];
    @endphp

    <x-faq-section
        :faqs="$linksFaqs"
        title="About These Links"
        subtitle="Quick Info"
    />
@endsection
