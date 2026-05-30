@extends('layouts.app')

@section('meta_title', 'Links — Sumit Kumar | Find Me Across the Web')
@section('meta_description', 'All official links and profiles of Sumit Kumar (sumitkdev) — GitHub, LinkedIn, Twitter, Stack Overflow, Dev.to, Medium, LeetCode, and more.')
@section('meta_keywords', 'Sumit Kumar links, sumitkdev profiles, developer social profiles, Sumit Kumar GitHub, Sumit Kumar LinkedIn')

@section('content')
    <!-- Hero -->
    <section class="py-32">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-24" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.5em] text-gray-400 font-bold mb-6">Digital Presence</p>
                <h1 class="text-6xl md:text-8xl font-bold tracking-tighter uppercase leading-none mb-8">
                    Find Me<br><span class="text-premium italic font-normal">Everywhere</span>
                </h1>
                <p class="text-xl text-gray-500 font-light max-w-2xl mx-auto leading-relaxed">
                    All my official profiles, platforms, and communities where I share code, write articles, and connect with developers.
                </p>
            </div>

            <!-- Social Media -->
            <div class="mb-20" data-aos="fade-up">
                <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-8">Social Media</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    <!-- LinkedIn -->
                    <a href="https://linkedin.com/in/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">LinkedIn</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- Twitter / X -->
                    <a href="https://twitter.com/sumitkdevs" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Twitter / X</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdevs</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- Instagram -->
                    <a href="https://instagram.com/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Instagram</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- YouTube -->
                    <a href="https://youtube.com/@sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">YouTube</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Developer Profiles -->
            <div class="mb-20" data-aos="fade-up" data-aos-delay="100">
                <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-8">Developer Profiles</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    <!-- GitHub -->
                    <a href="https://github.com/sumitkdevcode" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">GitHub</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdevcode</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- Stack Overflow -->
                    <a href="https://stackoverflow.com/users/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M15.725 0l-1.72 1.277 6.39 8.588 1.716-1.277L15.725 0zm-3.94 3.418l-1.369 1.644 8.225 6.85 1.369-1.644-8.225-6.85zm-3.15 4.465l-.905 1.94 9.702 4.517.904-1.94-9.701-4.517zm-1.85 4.86l-.44 2.093 10.473 2.201.44-2.092-10.473-2.203zM1.89 15.47V24h19.19v-8.53h-2.133v6.397H4.021v-6.396H1.89zm4.265 2.133v2.13h10.66v-2.13H6.154z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Stack Overflow</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- Dev.to -->
                    <a href="https://dev.to/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.42 10.05c-.18-.16-.46-.23-.84-.23H6v4.36h.58c.37 0 .65-.08.83-.23.18-.15.27-.45.27-.9v-2.09c0-.45-.09-.76-.27-.91zm15.14-7.2v18.3a2.85 2.85 0 01-2.85 2.85H4.29a2.85 2.85 0 01-2.85-2.85V2.85A2.85 2.85 0 014.29 0H19.7a2.85 2.85 0 012.86 2.85zm-9.69 8.83c0-1.62-.77-2.44-2.31-2.44H8.38v4.87h2.18c1.54 0 2.31-.82 2.31-2.43zm3.42 0c0-.95-.2-1.73-.59-2.33-.39-.6-.94-.9-1.65-.9-.71 0-1.26.3-1.65.9-.39.6-.59 1.38-.59 2.33 0 .95.2 1.73.59 2.33.39.6.94.9 1.65.9.71 0 1.26-.3 1.65-.9.39-.6.59-1.38.59-2.33zm4.11-.11v-.59h-1.18v.59c0 .36-.12.54-.36.54-.24 0-.36-.18-.36-.54v-2.46c0-.36.12-.54.36-.54.24 0 .36.18.36.54v.59h1.18v-.59c0-.77-.21-1.38-.63-1.82-.42-.44-.97-.66-1.66-.66s-1.24.22-1.66.66c-.42.44-.63 1.05-.63 1.82v2.46c0 .77.21 1.38.63 1.82.42.44.97.66 1.66.66s1.24-.22 1.66-.66c.42-.44.63-1.05.63-1.82z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Dev.to</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- Medium -->
                    <a href="https://medium.com/@sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.54 12a6.8 6.8 0 01-6.77 6.82A6.8 6.8 0 010 12a6.8 6.8 0 016.77-6.82A6.8 6.8 0 0113.54 12zM20.96 12c0 3.54-1.51 6.42-3.38 6.42-1.87 0-3.39-2.88-3.39-6.42s1.52-6.42 3.39-6.42 3.38 2.88 3.38 6.42M24 12c0 3.17-.53 5.75-1.19 5.75-.66 0-1.19-2.58-1.19-5.75s.53-5.75 1.19-5.75C23.47 6.25 24 8.83 24 12z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Medium</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- Hashnode -->
                    <a href="https://hashnode.com/@sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.351 8.019l-6.37-6.37a5.63 5.63 0 00-7.962 0l-6.37 6.37a5.63 5.63 0 000 7.962l6.37 6.37a5.63 5.63 0 007.962 0l6.37-6.37a5.63 5.63 0 000-7.962zM12 15.953a3.953 3.953 0 110-7.906 3.953 3.953 0 010 7.906z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Hashnode</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- CodePen -->
                    <a href="https://codepen.io/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.144 13.067v-2.134L16.55 12zm1.276 1.194a.628.628 0 01-.006.083l-.005.028-.011.053-.01.031a.443.443 0 01-.017.047l-.014.03a.78.78 0 01-.021.043l-.019.03a.57.57 0 01-.08.1l-.026.025a.602.602 0 01-.036.03l-.029.022-.01.008-6.782 4.522a.637.637 0 01-.708 0L4.864 14.79l-.01-.008a.599.599 0 01-.065-.052l-.026-.025a.56.56 0 01-.08-.1l-.019-.03a.44.44 0 01-.021-.043l-.014-.03a.572.572 0 01-.017-.047l-.01-.031a.644.644 0 01-.011-.053l-.005-.028a.628.628 0 01-.006-.083V9.739c0-.028.002-.055.006-.083l.005-.027.011-.054.01-.03a.574.574 0 01.017-.048l.014-.03a.56.56 0 01.021-.043l.019-.03a.56.56 0 01.08-.1l.026-.026a.78.78 0 01.036-.03l.029-.02.01-.009 6.782-4.521a.638.638 0 01.708 0l6.782 4.521.01.008.029.022.036.03.026.025a.56.56 0 01.08.1l.019.03a.56.56 0 01.021.043l.014.03c.006.016.012.032.017.048l.01.03.011.054.005.027c.004.028.006.055.006.083zm-2.64-3.328L12 13.688 7.22 10.933l-1.36-.907L12 5.86l6.14 4.166zm-6.78 8.094v-4.574L5.86 12.02l-1.28.854v2.472zM13.42 19.027l4.14-2.76v-2.472l-1.28-.854-4.14 2.76v3.326l1.28-.854zM5.86 12l1.28.854L12 10.312l4.86 3.244 1.28-.854L12 8.538z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">CodePen</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Competitive Coding -->
            <div class="mb-20" data-aos="fade-up" data-aos-delay="200">
                <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-8">Competitive Coding</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    <!-- LeetCode -->
                    <a href="https://leetcode.com/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.483 0a1.374 1.374 0 0 0-.961.438L7.116 6.226l-3.854 4.126a5.266 5.266 0 0 0-1.209 2.104 5.35 5.35 0 0 0-.125.513 5.527 5.527 0 0 0 .062 2.362 5.83 5.83 0 0 0 .349 1.017 5.938 5.938 0 0 0 1.271 1.818l4.277 4.193.039.038c2.248 2.165 5.852 2.133 8.063-.074l2.396-2.392c.54-.54.54-1.414.003-1.955a1.378 1.378 0 0 0-1.951-.003l-2.396 2.392a3.021 3.021 0 0 1-4.205.038l-.02-.019-4.276-4.193c-.652-.64-.972-1.469-.948-2.263a2.68 2.68 0 0 1 .066-.523 2.545 2.545 0 0 1 .619-1.164L9.13 8.114c1.058-1.134 3.204-1.27 4.43-.278l3.501 2.831c.593.48 1.461.387 1.94-.207a1.384 1.384 0 0 0-.207-1.943l-3.5-2.831c-.8-.647-1.766-1.045-2.774-1.202l2.015-2.158A1.384 1.384 0 0 0 13.483 0zm-2.866 12.815a1.38 1.38 0 0 0-1.38 1.382 1.38 1.38 0 0 0 1.38 1.382H20.79a1.38 1.38 0 0 0 1.38-1.382 1.38 1.38 0 0 0-1.38-1.382z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">LeetCode</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- HackerRank -->
                    <a href="https://hackerrank.com/profile/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c1.285 0 9.75 4.886 10.392 6 .645 1.115.645 10.885 0 12S13.287 24 12 24s-9.75-4.886-10.392-6c-.646-1.115-.646-10.885 0-12S10.715 0 12 0zm2.295 6.799c-.141 0-.258.115-.258.258v3.875H9.963V7.057c0-.143-.117-.258-.258-.258h-1.2c-.141 0-.258.115-.258.258v9.886c0 .143.117.258.258.258h1.2c.141 0 .258-.115.258-.258v-3.875h4.074v3.875c0 .143.117.258.258.258h1.2c.141 0 .258-.115.258-.258V7.057c0-.143-.117-.258-.258-.258h-1.2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">HackerRank</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Freelance -->
            <div class="mb-20" data-aos="fade-up" data-aos-delay="300">
                <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-8">Freelance Platforms</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Fiverr -->
                    <a href="https://fiverr.com/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.004 15.588a.995.995 0 1 0 .002-1.99.995.995 0 0 0-.002 1.99zm-.996-3.705h-.85c-.546 0-.84.41-.84 1.092v2.466h-1.61v-3.558h-.684c-.547 0-.84.41-.84 1.092v2.466h-1.61V11.03h1.61v.74c.264-.574.626-.74 1.163-.74h1.972v.74c.264-.574.625-.74 1.162-.74h.527v1.862zm-7.836.075h-1.212v2.153c0 .39.234.585.585.585h.627v1.36h-.992c-1.156 0-1.83-.39-1.83-1.611v-2.487h-.8V11.03h.8V9.772h1.61v1.258h1.212v1.628zm-5.347 0h-1.212v2.153c0 .39.234.585.585.585h.627v1.36H7.83c-1.157 0-1.83-.39-1.83-1.611v-2.487h-.8V11.03h.8V9.772h1.61v1.258h1.212v1.628zM5.94 14.108c0 1.092-.468 1.95-2.143 1.95H1.31v-1.36h2.487c.507 0 .533-.39.533-.625 0-.234-.026-.585-.533-.585H2.426c-1.03 0-1.752-.624-1.752-1.904 0-1.092.468-1.95 2.143-1.95h2.487v1.36H2.817c-.507 0-.533.391-.533.626 0 .234.026.585.533.585H3.95c1.03 0 1.99.624 1.99 1.903z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Fiverr</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- Upwork -->
                    <a href="https://upwork.com/freelancers/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.561 13.158c-1.102 0-2.135-.467-3.074-1.227l.228-1.076.008-.042c.207-1.143.849-3.06 2.839-3.06 1.492 0 2.703 1.212 2.703 2.703-.001 1.489-1.212 2.702-2.704 2.702zm0-8.14c-2.539 0-4.51 1.649-5.31 4.366-1.22-1.834-2.148-4.036-2.687-5.892H7.828v7.112c-.002 1.406-1.141 2.546-2.547 2.548-1.405-.002-2.543-1.143-2.545-2.548V3.492H0v7.112c0 2.914 2.37 5.303 5.281 5.303 2.913 0 5.283-2.389 5.283-5.303v-1.19c.529 1.107 1.182 2.229 1.974 3.221l-1.673 7.873h2.797l1.213-5.71c1.063.679 2.285 1.109 3.686 1.109 3 0 5.439-2.452 5.439-5.45 0-3-2.439-5.439-5.439-5.439z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Upwork</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <!-- Freelancer -->
                    <a href="https://freelancer.com/u/sumitkdev" target="_blank" rel="noopener me"
                        class="group flex items-center gap-5 p-6 border border-black/10 hover:border-black hover:bg-black hover:text-white transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-current/20 rounded-full group-hover:border-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.096 4.656l2.16-2.784h-4.704L6.336 8.544H3.6v3.12H6.336L3.6 19.344h4.032l2.736-7.68h3.408l.96-3.12h-4.368l1.2-1.632c.379-.48.778-.816 1.315-1.16a3.36 3.36 0 011.813-.384c.528 0 1.06.084 1.596.252l1.2-3.024c-.696-.24-1.416-.36-2.16-.36-1.272 0-2.46.384-3.48 1.128-.216.168-.432.348-.636.552l.012-.024c.192-.192.384-.384.492-.456z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Freelancer</p>
                            <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">@sumitkdev</p>
                        </div>
                        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Website & Blog -->
            <div data-aos="fade-up" data-aos-delay="400">
                <h2 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-8">Website & Blog</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    <a href="{{ route('blog.index') }}"
                        class="group flex items-center gap-5 p-6 bg-black text-white hover:bg-gray-900 transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-white/20 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Blog & Tutorials</p>
                            <p class="text-xs text-gray-400">sumitkdev.in/blog</p>
                        </div>
                        <svg class="w-5 h-5 opacity-50 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <a href="{{ route('portfolio.index') }}"
                        class="group flex items-center gap-5 p-6 bg-black text-white hover:bg-gray-900 transition-all duration-300">
                        <div class="w-12 h-12 flex items-center justify-center border border-white/20 rounded-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-bold uppercase tracking-widest">Portfolio</p>
                            <p class="text-xs text-gray-400">sumitkdev.in/portfolio</p>
                        </div>
                        <svg class="w-5 h-5 opacity-50 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

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
