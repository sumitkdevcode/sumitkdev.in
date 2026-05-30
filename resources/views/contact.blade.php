@extends('layouts.app')

@section('canonical_url', route('contact'))

@section('meta')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ContactPage",
        "name": "Contact Sumit Kumar",
        "description": "Contact page for Sumit Kumar — Full Stack Developer & Software Engineer",
        "url": "{{ route('contact') }}",
        "mainEntity": {
            "@id": "{{ url('/') }}/#person"
        },
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
                    "name": "Contact",
                    "item": "{{ route('contact') }}"
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
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-20">
                <div data-aos="fade-right">
                    <p class="text-xs uppercase tracking-[0.4em] text-gray-400 mb-4 font-bold">Get In Touch</p>
                    <h1 class="text-5xl md:text-7xl font-bold tracking-tighter uppercase mb-8 leading-none">
                        <span class="text-outline-premium opacity-100">Connect</span>
                    </h1>

                    <div class="space-y-8">
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-2">Inquiries</p>
                            <a href="mailto:contact@sumitkdev.in"
                                class="text-xl md:text-3xl font-bold tracking-tighter hover:text-gray-500 transition-colors break-all">contact@sumitkdev.in</a>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-2">Location</p>
                            <p class="text-2xl font-light">Noida,<br>India</p>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase tracking-widest text-gray-400 mb-6">Social Architecture</p>
                            <ul class="flex space-x-6">
                                  @php
                                      $contactLinks = collect()
                                          ->merge($globalSocialLinks['social_media'] ?? [])
                                          ->merge($globalSocialLinks['developer_profiles'] ?? [])
                                          ->take(4);
                                  @endphp
                                  @foreach($contactLinks as $link)
                                      <li>
                                          <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                                              class="w-12 h-12 border-2 border-black/10 flex items-center justify-center hover:bg-black hover:text-white hover:border-black transition-all group neo-frame-small">
                                              {!! str_replace('<svg ', '<svg class="w-5 h-5" ', $link->icon_svg) !!}
                                          </a>
                                      </li>
                                  @endforeach
                              </ul>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left" data-aos-delay="200">
                    @if(session('success'))
                        <div class="bg-black text-white p-12 mb-12 animate-fade-in">
                            <h3 class="text-2xl font-bold tracking-tighter mb-4">Gratitude.</h3>
                            <p class="text-sm font-light uppercase tracking-widest">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2 group">
                            <label class="text-[10px] uppercase font-bold tracking-widest text-black transition-colors">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full bg-transparent border-2 border-black focus:border-black px-6 py-3 text-lg font-bold outline-none transition-all neo-frame-small @error('name') border-red-500 @enderror"
                                required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 group">
                            <label class="text-[10px] uppercase font-bold tracking-widest text-black transition-colors">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full bg-transparent border-2 border-black focus:border-black px-6 py-3 text-lg font-bold outline-none transition-all neo-frame-small @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 group">
                            <label class="text-[10px] uppercase font-bold tracking-widest text-black transition-colors">Subject</label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                class="w-full bg-transparent border-2 border-black focus:border-black px-6 py-3 text-lg font-bold outline-none transition-all neo-frame-small @error('subject') border-red-500 @enderror">
                            @error('subject')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 group">
                            <label class="text-[10px] uppercase font-bold tracking-widest text-black transition-colors">Message</label>
                            <textarea name="message" rows="5"
                                class="w-full bg-transparent border-2 border-black focus:border-black px-6 py-3 text-lg font-bold outline-none transition-all resize-none neo-frame-small @error('message') border-red-500 @enderror"
                                required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-8">
                            <button type="submit"
                                class="bg-black text-white px-12 py-5 text-sm font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all neo-frame hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center space-x-4 w-full md:w-auto group">
                                <span>Transmit Message</span>
                                <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    @php
        $contactFaqs = [
            [
                'question' => 'How quickly does Sumit Kumar respond to inquiries?',
                'answer' => 'Sumit Kumar typically responds to all professional inquiries within 24 hours. For urgent project matters, please make sure to clearly state your timeline in the subject line or message body.',
            ],
            [
                'question' => 'What information should I include in my project inquiry?',
                'answer' => 'To help provide an accurate estimate and timeline, please include: a brief description of the project, your business goals, required features, preferred technology stack (if any), timeline expectations, and your estimated budget range.',
            ],
            [
                'question' => 'What is Sumit Kumar\'s process for taking on new projects?',
                'answer' => 'The typical process involves: 1) Initial discovery call to understand your needs. 2) Proposal detailing scope, timeline, and budget. 3) Agreement and milestone planning. 4) Iterative development with regular updates. 5) Testing, deployment, and handover.',
            ],
            [
                'question' => 'Does Sumit Kumar provide ongoing maintenance?',
                'answer' => 'Yes, Sumit Kumar offers post-launch maintenance and support contracts. This includes server monitoring, security updates, bug fixes, and feature enhancements to ensure your application remains stable and up-to-date.',
            ],
            [
                'question' => 'Is Sumit Kumar open to full-time employment opportunities?',
                'answer' => 'Yes, Sumit Kumar is open to discussing full-time opportunities with innovative companies that value clean code and strong engineering practices. Please feel free to reach out via email or LinkedIn with job details.',
            ],
        ];
    @endphp

    <x-faq-section 
        :faqs="$contactFaqs" 
        title="Common Inquiries" 
        subtitle="Before You Reach Out"
        :dark="true"
    />
@endsection
