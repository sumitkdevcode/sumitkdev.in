@extends('layouts.app')

@section('canonical_url', route('open-source'))

@section('meta_title', 'Open Source - Sumit Kumar')
@section('meta_description', 'Get the open-source portfolio and blog theme built with Laravel, Tailwind CSS, and Alpine.js.')

@section('content')
    <!-- Hero -->
    <section class="py-32 relative bg-white overflow-hidden border-b border-black/5">
        <!-- Floating Background Elements -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden flex flex-col justify-between py-20 opacity-5 z-0">
            <div class="animate-float-slow whitespace-nowrap text-9xl font-bold uppercase tracking-tighter">
                OPEN SOURCE &bull; FREE &bull; MIT LICENSE &bull; OPEN SOURCE &bull; FREE &bull;
            </div>
            <div class="animate-float-slow-reverse whitespace-nowrap text-9xl font-bold uppercase tracking-tighter">
                LARAVEL &bull; TAILWIND &bull; ALPINE &bull; LARAVEL &bull; TAILWIND &bull; ALPINE
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="mb-16" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8 font-bold">100% Free & Open Source</p>
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold tracking-tighter uppercase leading-none mb-12">
                    Code Without<br><span class="text-outline-premium opacity-100">Borders</span>
                </h1>
                <p class="text-2xl md:text-3xl font-light leading-tight text-gray-600 max-w-3xl mb-12">
                    This entire portfolio and blog platform is open-source. Explore the architecture, learn from the codebase, and build something extraordinary.
                </p>

                <div class="flex flex-col sm:flex-row gap-6">
                    <a href="https://github.com/sumitkdevcode/sumitkdev.in" target="_blank" rel="noopener noreferrer" 
                       class="group inline-flex items-center justify-center bg-black text-white px-10 py-5 text-sm font-bold uppercase tracking-[0.2em] transition-all hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,0.1)] neo-frame">
                        <svg class="w-5 h-5 mr-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                        </svg>
                        View Repository
                    </a>
                    <a href="#installation" 
                       class="group inline-flex items-center justify-center bg-white border-2 border-black/10 px-10 py-5 text-sm font-bold uppercase tracking-[0.2em] transition-all hover:border-black hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] neo-frame">
                        Installation Guide
                        <span class="ml-4 -rotate-45 group-hover:rotate-0 transition-transform">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Open Source -->
    <section class="py-24 bg-gray-50 border-b border-black/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-20">
                <div data-aos="fade-right">
                    <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-8">The Philosophy</h2>
                    <h3 class="text-4xl md:text-5xl font-bold uppercase tracking-tighter mb-8 leading-tight">Why Open Source?</h3>
                    <div class="prose prose-xl text-gray-600 font-light leading-relaxed">
                        <p>I believe that knowledge should be shared. By open-sourcing this platform, I want to give back to the developer community that helped me grow.</p>
                        <p>Whether you're a beginner looking for a real-world Laravel application to study, or an experienced developer seeking a solid starting point for your own portfolio—this codebase is yours to explore, modify, and improve.</p>
                    </div>
                </div>
                
                <div data-aos="fade-left" class="flex items-center">
                    <div class="bg-white p-12 border-2 border-black/10 relative neo-frame w-full">
                        <div class="absolute -top-4 -left-4 w-16 h-16 bg-black z-0"></div>
                        <blockquote class="relative z-10 text-2xl font-serif italic text-black leading-relaxed mb-8">
                            "The best way to learn to write great code is by reading great code and then building upon it."
                        </blockquote>
                        <div class="flex items-center border-t border-black/10 pt-8">
                            <div class="w-12 h-12 rounded-full border border-black/10 flex items-center justify-center font-bold text-xs uppercase tracking-widest bg-gray-50 mr-4">
                                SK
                            </div>
                            <div>
                                <div class="font-bold uppercase tracking-widest text-sm">Sumit Kumar</div>
                                <div class="text-[10px] uppercase tracking-[0.2em] text-gray-400 mt-1">Creator & Maintainer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-20" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-6 font-bold">Tech Stack</p>
                <h2 class="text-5xl font-bold tracking-tighter uppercase">Built with modern tech.</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Laravel -->
                <div class="group bg-white border border-black/10 p-10 hover:border-black transition-all duration-300 hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] neo-frame" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 bg-gray-50 border border-black/10 flex items-center justify-center mb-8 neo-frame-small group-hover:bg-black group-hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase tracking-widest mb-4">Laravel Backend</h3>
                    <p class="text-gray-500 font-light leading-relaxed">Powered by Laravel for robust routing, eloquent ORM, caching, and secure authentication.</p>
                </div>

                <!-- Tailwind -->
                <div class="group bg-white border border-black/10 p-10 hover:border-black transition-all duration-300 hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] neo-frame" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gray-50 border border-black/10 flex items-center justify-center mb-8 neo-frame-small group-hover:bg-black group-hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase tracking-widest mb-4">Tailwind CSS</h3>
                    <p class="text-gray-500 font-light leading-relaxed">Utility-first styling for beautiful, responsive, and highly customizable frontend design across all devices.</p>
                </div>

                <!-- Alpine -->
                <div class="group bg-white border border-black/10 p-10 hover:border-black transition-all duration-300 hover:-translate-y-1 hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] neo-frame" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gray-50 border border-black/10 flex items-center justify-center mb-8 neo-frame-small group-hover:bg-black group-hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold uppercase tracking-widest mb-4">Alpine.js</h3>
                    <p class="text-gray-500 font-light leading-relaxed">Lightweight JavaScript reactivity for interactive components without the overhead of heavy frameworks.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Installation -->
    <section id="installation" class="py-32 bg-gray-50 border-y border-black/5">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-20" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 font-bold mb-6">Quick Start</p>
                <h2 class="text-5xl font-bold tracking-tighter uppercase leading-none mb-6">Up and running<br><span class="text-outline-premium opacity-100">in minutes</span></h2>
                <p class="text-xl text-gray-500 font-light leading-relaxed">The installation process is straightforward for any developer familiar with Laravel.</p>
            </div>

            <div class="space-y-12">
                <!-- Step 1 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="0">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-24 flex-shrink-0">
                            <span class="text-[80px] font-bold text-gray-200 leading-none group-hover:text-black transition-colors">01</span>
                        </div>
                        <div class="flex-grow pt-4">
                            <h3 class="text-2xl font-bold uppercase tracking-tighter mb-4">Clone the repository</h3>
                            <div class="bg-black text-white p-6 neo-frame font-mono text-sm overflow-x-auto">
                                <span class="text-gray-500 mr-4">$</span>git clone https://github.com/sumitkdevcode/sumitkdev.in.git
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-24 flex-shrink-0">
                            <span class="text-[80px] font-bold text-gray-200 leading-none group-hover:text-black transition-colors">02</span>
                        </div>
                        <div class="flex-grow pt-4">
                            <h3 class="text-2xl font-bold uppercase tracking-tighter mb-4">Install Dependencies</h3>
                            <div class="bg-black text-white p-6 neo-frame font-mono text-sm overflow-x-auto whitespace-pre">
<span class="text-gray-500 mr-4">$</span>cd sumitkdev.in
<span class="text-gray-500 mr-4">$</span>composer install
<span class="text-gray-500 mr-4">$</span>npm install && npm run build
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative group" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-24 flex-shrink-0">
                            <span class="text-[80px] font-bold text-gray-200 leading-none group-hover:text-black transition-colors">03</span>
                        </div>
                        <div class="flex-grow pt-4">
                            <h3 class="text-2xl font-bold uppercase tracking-tighter mb-4">Configure Environment</h3>
                            <div class="bg-black text-white p-6 neo-frame font-mono text-sm overflow-x-auto whitespace-pre">
<span class="text-gray-500 mr-4">$</span>cp .env.example .env
<span class="text-gray-500 mr-4">$</span>php artisan key:generate
<span class="text-gray-500 mr-4">$</span>php artisan migrate --seed
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-32 bg-black text-white relative overflow-hidden">
        <!-- Floating Elements in CTA -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden flex flex-col justify-center py-20 opacity-5">
            <div class="animate-float-slow whitespace-nowrap text-9xl font-bold uppercase tracking-tighter">
                FORK IT &bull; BUILD IT &bull; SHARE IT &bull; FORK IT &bull;
            </div>
        </div>
        
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10" data-aos="zoom-in">
            <h2 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase leading-none mb-8">Ready to dive in?</h2>
            <p class="text-xl text-gray-400 mb-12 font-light leading-relaxed">
                Clone the repository, submit issues, or create pull requests. Your contributions are welcome and greatly appreciated!
            </p>
            <a href="https://github.com/sumitkdevcode/sumitkdev.in" target="_blank" rel="noopener noreferrer" 
               class="inline-block bg-white text-black px-12 py-5 text-sm font-bold uppercase tracking-[0.3em] hover:bg-gray-200 transition-all shadow-xl neo-frame">
                Start Forking Now
            </a>
        </div>
    </section>
@endsection
