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
@endsection