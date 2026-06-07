@extends('layouts.app')

@section('meta_title', 'Open Source - Sumit Kumar')
@section('meta_description', 'Information about the open-source nature of this project and link to the GitHub repository.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-black text-white pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-black to-gray-800"></div>
        <!-- Decorative grid -->
        <div class="absolute inset-0 opacity-20 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmYiLz48L3N2Zz4=')] [background-size:20px_20px]"></div>
    </div>
    
    <div class="relative max-w-[1200px] mx-auto px-6" data-aos="fade-up">
        <div class="inline-flex items-center space-x-2 bg-white/10 px-4 py-2 rounded-full mb-8 backdrop-blur-sm border border-white/20">
            <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
            <span class="text-xs font-bold uppercase tracking-widest text-white">100% Open Source</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold tracking-tighter mb-8 leading-[1.1]">
            Code<br/>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-400 to-white">Without Borders.</span>
        </h1>
        
        <p class="text-xl md:text-2xl text-gray-400 max-w-2xl font-light leading-relaxed mb-10">
            This entire portfolio and blog platform is open-source. Explore the architecture, learn from the codebase, and build something extraordinary.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="https://github.com/sumitkdevcode/sumitkdev.in" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-4 bg-white text-black hover:bg-gray-200 transition-colors text-sm font-bold uppercase tracking-widest rounded-none group">
                <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                </svg>
                View Repository
            </a>
            <a href="#details" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white/20 text-white hover:bg-white/10 transition-colors text-sm font-bold uppercase tracking-widest rounded-none">
                Learn More
            </a>
        </div>
    </div>
</section>

<!-- Content Section -->
<section id="details" class="bg-gray-50 py-20 lg:py-32">
    <div class="max-w-[1200px] mx-auto px-6">
        
        <!-- The Why -->
        <div class="mb-24 flex flex-col lg:flex-row gap-16 lg:items-center">
            <div class="lg:w-1/2" data-aos="fade-right">
                <h2 class="text-4xl md:text-5xl font-bold tracking-tighter mb-8">Why Open Source?</h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-6">
                    I believe that knowledge should be shared. By open-sourcing this platform, I want to give back to the developer community that helped me grow. 
                </p>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Whether you're a beginner looking for a real-world Laravel application to study, or an experienced developer seeking a solid starting point for your own portfolio—this codebase is yours to explore, modify, and improve.
                </p>
            </div>
            <div class="lg:w-1/2" data-aos="fade-left">
                <div class="bg-white p-10 lg:p-12 border border-gray-100 shadow-xl relative">
                    <div class="absolute -top-4 -left-4 w-20 h-20 bg-black -z-10"></div>
                    <blockquote class="text-2xl font-serif italic text-gray-800 leading-relaxed">
                        "The best way to learn to write great code is by reading great code and then building upon it."
                    </blockquote>
                    <div class="mt-8 flex items-center">
                        <div class="w-12 h-12 rounded-full overflow-hidden mr-4 bg-gradient-to-tr from-gray-900 to-gray-600 text-white flex items-center justify-center font-bold text-lg">
                            SK
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">Sumit Kumar</div>
                            <div class="text-sm text-gray-500">Creator & Maintainer</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tech Stack -->
        <div class="mb-24" data-aos="fade-up">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-4xl md:text-5xl font-bold tracking-tighter mb-6">Built with Modern Tech</h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    A carefully curated stack designed for performance, developer experience, and scalability.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Stack Card 1 -->
                <div class="bg-white p-10 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-red-50 text-red-600 flex items-center justify-center rounded-lg mb-8 group-hover:scale-110 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Laravel Backend</h3>
                    <p class="text-gray-600 leading-relaxed">Powered by Laravel for robust routing, eloquent ORM, caching, and secure authentication.</p>
                </div>

                <!-- Stack Card 2 -->
                <div class="bg-white p-10 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 flex items-center justify-center rounded-lg mb-8 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Tailwind CSS</h3>
                    <p class="text-gray-600 leading-relaxed">Utility-first styling for beautiful, responsive, and highly customizable frontend design across all devices.</p>
                </div>

                <!-- Stack Card 3 -->
                <div class="bg-white p-10 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-yellow-50 text-yellow-600 flex items-center justify-center rounded-lg mb-8 group-hover:scale-110 group-hover:bg-yellow-400 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Alpine.js</h3>
                    <p class="text-gray-600 leading-relaxed">Lightweight JavaScript reactivity for interactive components without the overhead of heavy frameworks.</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="bg-black text-white p-12 lg:p-24 text-center relative overflow-hidden" data-aos="fade-up">
            <div class="absolute inset-0 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjIiIGZpbGw9IiNmZmYiLz48L3N2Zz4=')] [background-size:20px_20px]"></div>
            <div class="relative z-10 max-w-3xl mx-auto">
                <h2 class="text-4xl lg:text-6xl font-bold tracking-tighter mb-8">Ready to dive in?</h2>
                <p class="text-xl text-gray-400 mb-12 leading-relaxed font-light">
                    Clone the repository, submit issues, or create pull requests. Your contributions are welcome and greatly appreciated!
                </p>
                <a href="https://github.com/sumitkdevcode/sumitkdev.in" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-10 py-5 bg-white text-black hover:bg-gray-200 transition-transform hover:scale-105 text-sm font-bold uppercase tracking-widest rounded-none">
                    Start Forking Now
                </a>
            </div>
        </div>

    </div>
</section>
@endsection
