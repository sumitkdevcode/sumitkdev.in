@extends('layouts.app')

@section('canonical_url', route('about'))

@section('meta')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfilePage",
        "mainEntity": {
            "@id": "{{ url('/') }}/#person"
        },
        "name": "About Sumit Kumar",
        "description": "Professional profile of Sumit Kumar — Full Stack Developer & Software Engineer",
        "url": "{{ route('about') }}",
        "breadcrumb": {
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url('/') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "About",
                    "item": "{{ route('about') }}"
                }
            ]
        }
    }
    </script>
@endsection

@section('content')
    <section class="pt-12 pb-12 relative bg-white overflow-hidden border-b border-black/5">
        <!-- Background Grid -->
        <div class="absolute inset-0 bg-grid-pattern opacity-[0.15] z-0 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="mb-12" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-8 font-bold">About Me</p>
                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase leading-none mb-12">Driven by<br><span class="text-outline-premium opacity-100">the result</span></h1>
            </div>

            <div class="grid lg:grid-cols-12 gap-20">
                <!-- Summary & Bio -->
                <div class="lg:col-span-7 space-y-16" data-aos="fade-right">
                    <p class="text-3xl md:text-5xl font-bold tracking-tighter leading-tight">
                        Crafting digital experiences with <span class="text-gray-400">clean code</span> and <span class="text-gray-400">strategic design</span>.
                    </p>
                    <div class="prose prose-2xl max-w-none text-black font-light leading-relaxed space-y-8">
                        <p>{{ $settings['summary'] }}</p>
                        
                        <div class="space-y-12 pt-12">
                            <h2 class="text-xs uppercase tracking-[0.4em] font-bold text-gray-400">Professional Experience</h2>
                            
                            <div class="space-y-12">
                                <div class="relative group pl-8 md:pl-20 py-8 border-t border-black/10 hover:bg-gray-50 transition-colors">
                                    <span class="number-decorator text-[80px] -left-4 top-0 group-hover:text-black/5 transition-colors z-0">01</span>
                                    <div class="relative z-10">
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-baseline gap-2 mb-2">
                                            <h3 class="text-2xl font-bold uppercase tracking-tighter">Full Stack Developer</h3>
                                            <span class="text-xs font-bold uppercase tracking-widest text-gray-400">2023 — Present</span>
                                        </div>
                                        <p class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-6">Apex Byte - IT Services Company</p>
                                        <ul class="text-sm space-y-3 list-disc pl-4 text-gray-600 font-normal">
                                            <li>Developed and maintained responsive client websites using C#, PHP, SQL, and Modern JS.</li>
                                            <li>Architected backend solutions using ASP.NET Core and Laravel for REST APIs.</li>
                                            <li>Integrated third-party APIs and payment gateways (PhonePe, Razorpay).</li>
                                            <li>Implemented secure authentication and RBAC in administrative dashboards.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="relative group pl-8 md:pl-20 py-8 border-t border-black/10 hover:bg-gray-50 transition-colors">
                                    <span class="number-decorator text-[80px] -left-4 top-0 group-hover:text-black/5 transition-colors z-0">02</span>
                                    <div class="relative z-10">
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-baseline gap-2 mb-2">
                                            <h3 class="text-2xl font-bold uppercase tracking-tighter">Web Developer Intern</h3>
                                            <span class="text-xs font-bold uppercase tracking-widest text-gray-400">2023 — 2025</span>
                                        </div>
                                        <p class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4">Gautam Buddha University (USoICT)</p>
                                        <p class="text-sm text-gray-600 font-normal">Redesigned and developed key sections of the university's USoICT website, enhancing UX and information accessibility.</p>
                                    </div>
                                </div>

                                <div class="relative group pl-8 md:pl-20 py-8 border-y border-black/10 hover:bg-gray-50 transition-colors">
                                    <span class="number-decorator text-[80px] -left-4 top-0 group-hover:text-black/5 transition-colors z-0">03</span>
                                    <div class="relative z-10">
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-baseline gap-2 mb-2">
                                            <h3 class="text-2xl font-bold uppercase tracking-tighter">Web Developer Intern</h3>
                                            <span class="text-xs font-bold uppercase tracking-widest text-gray-400">2023</span>
                                        </div>
                                        <p class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4">Ministry of Housing and Urban Affairs (TULIP)</p>
                                        <p class="text-sm text-gray-600 font-normal">Contributed to the redesign of the DAY-NULM 2.0 portal using React.js and modern frontend technologies.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skills & Education -->
                <aside class="lg:col-span-5 space-y-12" data-aos="fade-left">
                    <div class="bg-black text-white p-12 space-y-16 neo-frame">
                        <div>
                            <h4 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-500 mb-8">Technical Proficiency</h4>
                            <div class="space-y-8">
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-4">Core Tech</p>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach(['Laravel', 'ASP.NET Core', 'React.js', 'PHP', 'C#', 'SQL Server', 'MySQL'] as $tag)
                                            <span class="text-[10px] border border-white/20 hover:border-white transition-colors px-3 py-1 uppercase tracking-widest">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-4">Design Tools</p>
                                    <div class="flex flex-wrap gap-3">
                                        <span class="text-[10px] border border-white/20 hover:border-white transition-colors px-3 py-1 uppercase tracking-widest">Photoshop</span>
                                        <span class="text-[10px] border border-white/20 hover:border-white transition-colors px-3 py-1 uppercase tracking-widest">Illustrator</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-500 mb-8">Academic Foundation</h4>
                            <div class="space-y-8">
                                <div class="group border-l-2 border-transparent hover:border-white pl-4 transition-colors">
                                    <h5 class="text-sm font-bold uppercase tracking-widest mb-1">Master's in MCA</h5>
                                    <p class="text-[10px] text-gray-400">Gautam Buddha University, 2023-2025</p>
                                </div>
                                <div class="group border-l-2 border-transparent hover:border-white pl-4 transition-colors">
                                    <h5 class="text-sm font-bold uppercase tracking-widest mb-1">Bachelor's in BCA</h5>
                                    <p class="text-[10px] text-gray-400">Galgotias University, 2020-2023</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-500 mb-6">Contact</h4>
                            <a href="mailto:{{ $settings['email'] }}" class="block text-sm font-bold lowercase tracking-widest hover:text-gray-300 transition-colors">{{ $settings['email'] }}</a>
                            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 mt-2">{{ $settings['phone'] }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 neo-frame p-12 border-2 border-black/10">
                        <h4 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-6">Certifications</h4>
                        <ul class="space-y-4 text-xs font-bold uppercase tracking-widest">
                            <li class="flex justify-between items-center pb-4 border-b border-black/5">
                                <span>React Basic</span>
                                <span class="text-[10px] text-gray-400 italic">Hackerrank</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span>Web Development</span>
                                <span class="text-[10px] text-gray-400 italic">IIT Bombay</span>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <!-- Digital Presence -->
    <section class="py-32 bg-white border-t border-black/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4 font-bold">Active On</p>
                <h2 class="text-6xl font-bold tracking-tighter uppercase">Digital Presence</h2>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4" data-aos="fade-up" data-aos-delay="100">
                @php
                    $platforms = [
                        ['name' => 'GitHub', 'url' => 'https://github.com/sumitkdevcode', 'icon' => 'github/github-original.svg'],
                        ['name' => 'LinkedIn', 'url' => 'https://linkedin.com/in/sumitkdev', 'icon' => 'linkedin/linkedin-plain.svg'],
                        ['name' => 'Twitter', 'url' => 'https://twitter.com/sumitkdevs', 'icon' => 'twitter/twitter-original.svg'],
                        ['name' => 'Stack Overflow', 'url' => 'https://stackoverflow.com/users/sumitkdev', 'icon' => 'stackoverflow/stackoverflow-plain.svg'],
                        ['name' => 'Dev.to', 'url' => 'https://dev.to/sumitkdev', 'icon' => 'devto/devto-plain.svg'],
                        ['name' => 'HackerRank', 'url' => 'https://hackerrank.com/profile/sumitkdev', 'icon' => null],
                    ];
                @endphp

                @foreach($platforms as $index => $platform)
                    <a href="{{ $platform['url'] }}" target="_blank" rel="noopener"
                        class="group bg-white border border-black/10 p-6 flex flex-col items-center justify-center gap-3 hover:border-black hover:bg-black hover:text-white transition-all duration-300 hover:shadow-xl"
                        data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                        @if($platform['icon'])
                            <div class="w-10 h-10 flex items-center justify-center">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/{{ $platform['icon'] }}"
                                    alt="{{ $platform['name'] }}" loading="lazy"
                                    class="w-full h-full object-contain grayscale group-hover:grayscale-0 group-hover:brightness-0 group-hover:invert transition-all duration-300">
                            </div>
                        @else
                            <div class="w-10 h-10 flex items-center justify-center border border-black/10 rounded-full group-hover:border-white/30">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c1.285 0 9.75 4.886 10.392 6 .645 1.115.645 10.885 0 12S13.287 24 12 24s-9.75-4.886-10.392-6c-.646-1.115-.646-10.885 0-12S10.715 0 12 0zm2.295 6.799c-.141 0-.258.115-.258.258v3.875H9.963V7.057c0-.143-.117-.258-.258-.258h-1.2c-.141 0-.258.115-.258.258v9.886c0 .143.117.258.258.258h1.2c.141 0 .258-.115.258-.258v-3.875h4.074v3.875c0 .143.117.258.258.258h1.2c.141 0 .258-.115.258-.258V7.057c0-.143-.117-.258-.258-.258h-1.2z"/>
                                </svg>
                            </div>
                        @endif
                        <span class="text-[10px] font-bold uppercase tracking-widest text-center">{{ $platform['name'] }}</span>
                    </a>
                @endforeach
            </div>

            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{ route('links') }}" class="text-sm font-bold uppercase tracking-widest hover:opacity-50 transition-opacity">
                    View all profiles &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- Cross-Link CTAs -->
    <section class="py-32 border-t border-black/5 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <a href="{{ route('portfolio.index') }}" class="group block p-12 bg-black text-white hover:bg-gray-900 transition-all neo-frame" data-aos="fade-up">
                    <p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 mb-4 font-bold">Explore</p>
                    <h3 class="text-3xl font-bold uppercase tracking-tighter mb-4">See My Work</h3>
                    <span class="text-xs uppercase tracking-widest font-bold group-hover:ml-2 transition-all text-white">View Portfolio &rarr;</span>
                </a>
                <a href="{{ route('blog.index') }}" class="group block p-12 bg-white border-2 border-black/10 hover:border-black transition-all hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-[10px] uppercase tracking-[0.3em] text-gray-400 mb-4 font-bold">Read</p>
                    <h3 class="text-3xl font-bold uppercase tracking-tighter mb-4">Technical Blog</h3>
                    <span class="text-xs uppercase tracking-widest font-bold group-hover:ml-2 transition-all">Browse Articles &rarr;</span>
                </a>
                <a href="{{ route('links') }}" class="group block p-12 bg-white border-2 border-black/10 hover:border-black transition-all hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-[10px] uppercase tracking-[0.3em] text-gray-400 mb-4 font-bold">Connect</p>
                    <h3 class="text-3xl font-bold uppercase tracking-tighter mb-4">Find Me Everywhere</h3>
                    <span class="text-xs uppercase tracking-widest font-bold group-hover:ml-2 transition-all">All Profiles &rarr;</span>
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    @php
        $aboutFaqs = [
            [
                'question' => 'What is Sumit Kumar\'s professional experience?',
                'answer' => 'Sumit Kumar currently works as a Full Stack Developer at Apex Byte IT Services Company, where he develops and maintains responsive client websites using C#, PHP, SQL, and modern JavaScript. He has also interned at Gautam Buddha University (USoICT) redesigning their website, and at the Ministry of Housing and Urban Affairs through the TULIP program, contributing to the DAY-NULM 2.0 portal using React.js.',
            ],
            [
                'question' => 'What programming languages does Sumit Kumar know?',
                'answer' => 'Sumit Kumar is proficient in PHP, JavaScript, TypeScript, Python, C#, SQL, HTML5, and CSS3. He has extensive experience with frameworks like Laravel, React.js, Vue.js, ASP.NET Core, Django, and Node.js. He is also skilled with databases including MySQL, PostgreSQL, SQL Server, and MongoDB.',
            ],
            [
                'question' => 'Does Sumit Kumar have any certifications?',
                'answer' => 'Yes, Sumit Kumar holds a React Basic certification from HackerRank and a Web Development certification from IIT Bombay. He continuously upskills through online courses, tech conferences, and hands-on project work.',
            ],
            [
                'question' => 'What is Sumit Kumar\'s approach to software development?',
                'answer' => 'Sumit Kumar follows clean architecture principles, test-driven development (TDD), and agile methodologies. He believes in writing maintainable, scalable code with proper documentation. His approach emphasizes understanding business requirements first, then translating them into elegant technical solutions.',
            ],
            [
                'question' => 'Can Sumit Kumar work with teams remotely?',
                'answer' => 'Absolutely. Sumit Kumar has experience collaborating with remote teams across different time zones. He is proficient with collaboration tools like Git/GitHub, Slack, Jira, Trello, and various CI/CD platforms. He values clear communication and consistent code quality in distributed team environments.',
            ],
            [
                'question' => 'What sets Sumit Kumar apart from other developers?',
                'answer' => 'Sumit Kumar combines strong technical skills with excellent communication abilities. He can translate complex technical concepts into clear business strategies. His MCA education provides a solid theoretical foundation, while his hands-on industry experience ensures practical, production-ready solutions. He is passionate about staying current with emerging technologies and sharing knowledge through his 500+ article blog.',
            ],
        ];
    @endphp

    <x-faq-section 
        :faqs="$aboutFaqs" 
        title="About Sumit Kumar" 
        subtitle="Know More"
    />
@endsection