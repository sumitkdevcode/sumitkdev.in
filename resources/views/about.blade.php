@extends('layouts.app')

@section('title', 'Sumit Kumar — About')

@section('content')
    <section class="py-32">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-32" data-aos="fade-up">
                <h1 class="text-7xl md:text-9xl font-bold tracking-tighter uppercase leading-none mb-12">Driven by<br><span class="text-premium italic font-normal">the result</span></h1>
            </div>

            <div class="grid lg:grid-cols-12 gap-20">
                <!-- Summary & Bio -->
                <div class="lg:col-span-7 space-y-16" data-aos="fade-right">
                    <p class="text-3xl md:text-5xl font-premium leading-tight italic">
                        "I am a results-oriented Full Stack Developer crafting premium digital experiences through minimal design and robust code."
                    </p>
                    <div class="prose prose-2xl max-w-none text-black font-light leading-relaxed space-y-8">
                        <p>{{ $settings['summary'] }}</p>
                        
                        <div class="space-y-12 pt-12">
                            <h2 class="text-xs uppercase tracking-[0.4em] font-bold text-gray-400">Professional Experience</h2>
                            
                            <div class="space-y-12">
                                <div class="border-l-4 border-black pl-8 space-y-4">
                                    <div class="flex justify-between items-baseline">
                                        <h3 class="text-2xl font-bold uppercase">Full Stack Developer</h3>
                                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">2023 — Present</span>
                                    </div>
                                    <p class="text-sm font-bold uppercase tracking-widest text-gray-500">Apex Byte - IT Services Company</p>
                                    <ul class="text-sm space-y-4 list-disc pl-4 text-gray-600">
                                        <li>Developed and maintained responsive client websites using C#, PHP, SQL, and Modern JS.</li>
                                        <li>Architected backend solutions using ASP.NET Core and Laravel for REST APIs.</li>
                                        <li>Integrated third-party APIs and payment gateways (PhonePe, Razorpay).</li>
                                        <li>Implemented secure authentication and RBAC in administrative dashboards.</li>
                                    </ul>
                                </div>

                                <div class="border-l-4 border-black pl-8 space-y-4">
                                    <div class="flex justify-between items-baseline">
                                        <h3 class="text-2xl font-bold uppercase">Web Developer Intern</h3>
                                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">2023 — 2025</span>
                                    </div>
                                    <p class="text-sm font-bold uppercase tracking-widest text-gray-500">Gautam Buddha University (USoICT)</p>
                                    <p class="text-sm text-gray-600">Redesigned and developed key sections of the university's USoICT website, enhancing UX and information accessibility.</p>
                                </div>

                                <div class="border-l-4 border-black pl-8 space-y-4">
                                    <div class="flex justify-between items-baseline">
                                        <h3 class="text-2xl font-bold uppercase">Web Developer Intern</h3>
                                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">2023</span>
                                    </div>
                                    <p class="text-sm font-bold uppercase tracking-widest text-gray-500">Ministry of Housing and Urban Affairs (TULIP)</p>
                                    <p class="text-sm text-gray-600">Contributed to the redesign of the DAY-NULM 2.0 portal using React.js and modern frontend technologies.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skills & Education -->
                <aside class="lg:col-span-5 space-y-12" data-aos="fade-left">
                    <div class="bg-black text-white p-12 space-y-16 shadow-2xl">
                        <div>
                            <h4 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-500 mb-8">Technical Proficiency</h4>
                            <div class="space-y-8">
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-4">Core Tech</p>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach(['Laravel', 'ASP.NET Core', 'React.js', 'PHP', 'C#', 'SQL Server', 'MySQL'] as $tag)
                                            <span class="text-[10px] border border-white/20 px-3 py-1 uppercase tracking-widest">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-500 mb-4">Design Tools</p>
                                    <div class="flex flex-wrap gap-3">
                                        <span class="text-[10px] border border-white/20 px-3 py-1 uppercase tracking-widest">Photoshop</span>
                                        <span class="text-[10px] border border-white/20 px-3 py-1 uppercase tracking-widest">Illustrator</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-500 mb-8">Academic Foundation</h4>
                            <div class="space-y-8">
                                <div>
                                    <h5 class="text-sm font-bold italic uppercase">Master's in MCA</h5>
                                    <p class="text-[10px] text-gray-400 mt-1">Gautam Buddha University, 2023-2025</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-bold italic uppercase">Bachelor's in BCA</h5>
                                    <p class="text-[10px] text-gray-400 mt-1">Galgotias University, 2020-2023</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-500 mb-6">Contact</h4>
                            <p class="text-sm font-bold lowercase tracking-widest">{{ $settings['email'] }}</p>
                            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-500 mt-2">{{ $settings['phone'] }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 border border-black/5 p-12">
                        <h4 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-6">Certifications</h4>
                        <ul class="space-y-4 text-xs font-bold uppercase tracking-widest">
                            <li class="flex justify-between items-center">
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
    <section class="py-32 bg-gray-50 border-t border-black/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16" data-aos="fade-up">
                <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4">Active On</p>
                <h2 class="text-5xl font-premium">Digital Presence</h2>
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
    <section class="py-32 border-t border-black/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8">
                <a href="{{ route('portfolio.index') }}" class="group block p-12 bg-black text-white hover:bg-gray-900 transition-all" data-aos="fade-up">
                    <p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 mb-4">Explore</p>
                    <h3 class="text-2xl font-premium italic mb-4">See My Work</h3>
                    <span class="text-xs uppercase tracking-widest font-bold group-hover:ml-2 transition-all">View Portfolio &rarr;</span>
                </a>
                <a href="{{ route('blog.index') }}" class="group block p-12 border border-black/10 hover:border-black transition-all" data-aos="fade-up" data-aos-delay="100">
                    <p class="text-[10px] uppercase tracking-[0.3em] text-gray-400 mb-4">Read</p>
                    <h3 class="text-2xl font-premium italic mb-4">Technical Blog</h3>
                    <span class="text-xs uppercase tracking-widest font-bold group-hover:ml-2 transition-all">Browse Articles &rarr;</span>
                </a>
                <a href="{{ route('links') }}" class="group block p-12 border border-black/10 hover:border-black transition-all" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-[10px] uppercase tracking-[0.3em] text-gray-400 mb-4">Connect</p>
                    <h3 class="text-2xl font-premium italic mb-4">Find Me Everywhere</h3>
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