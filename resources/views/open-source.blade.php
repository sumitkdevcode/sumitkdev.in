@extends('layouts.app')

@section('meta_title', 'Open Source - Sumit Kumar')
@section('meta_description', 'Information about the open-source nature of this project and link to the GitHub repository.')

@section('content')
<div class="bg-white min-h-[70vh]">
    <div class="max-w-[1000px] mx-auto px-6 py-20 lg:py-32">
        <!-- Header -->
        <div class="max-w-3xl mb-16" data-aos="fade-up">
            <p class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-4">Open Source</p>
            <h1 class="text-5xl lg:text-7xl font-bold tracking-tighter mb-6">About This Project</h1>
            <p class="text-xl text-gray-600 leading-relaxed">
                This website is fully open-source. You can explore the codebase, learn from it, or use it as a starting point for your own projects.
            </p>
        </div>

        <!-- Content -->
        <div class="prose prose-lg max-w-none" data-aos="fade-up" data-aos-delay="100">
            <h2>Why Open Source?</h2>
            <p>
                I believe in giving back to the community that helped me learn and grow as a developer. By open-sourcing my personal portfolio and blog, I hope to provide a real-world example of a production-ready Laravel application.
            </p>

            <h2>Tech Stack</h2>
            <ul>
                <li><strong>Backend:</strong> Laravel, PHP, MySQL</li>
                <li><strong>Frontend:</strong> Blade, Tailwind CSS, Alpine.js</li>
                <li><strong>Other:</strong> Vite, Caching, SEO Optimizations</li>
            </ul>

            <h2>GitHub Repository</h2>
            <p>
                You can find the entire source code for this project on GitHub. Feel free to star the repository, fork it, or submit pull requests if you find any bugs or have suggestions for improvements.
            </p>
            
            <div class="mt-8">
                <a href="https://github.com/sumitkumar5683/sumitkdev.in" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-8 py-4 border-2 border-black bg-black text-white hover:bg-white hover:text-black transition-all text-sm font-bold uppercase tracking-widest no-underline">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                    View on GitHub
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
