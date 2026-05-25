{{--
    FAQ Section Component
    Usage: <x-faq-section :faqs="$faqs" title="Frequently Asked Questions" />
    
    Each FAQ item: ['question' => '...', 'answer' => '...']
    Includes FAQ Schema (JSON-LD) for Google Rich Results.
--}}

@props([
    'faqs' => [],
    'title' => 'Frequently Asked Questions',
    'subtitle' => 'Common Questions',
    'dark' => false,
])

@if(count($faqs) > 0)
<section class="{{ $dark ? 'bg-black text-white' : 'bg-gray-50' }} py-32" id="faq">
    <div class="max-w-4xl mx-auto px-6">
        <div class="mb-20 text-center" data-aos="fade-up">
            <p class="text-xs uppercase tracking-[0.4em] {{ $dark ? 'text-gray-500' : 'text-gray-400' }} mb-4">{{ $subtitle }}</p>
            <h2 class="text-5xl font-premium italic">{{ $title }}</h2>
        </div>

        <div class="space-y-0" x-data="{ openIndex: null }">
            @foreach($faqs as $index => $faq)
                <div 
                    class="border-t {{ $dark ? 'border-white/10' : 'border-black/10' }} {{ $loop->last ? ($dark ? 'border-b border-white/10' : 'border-b border-black/10') : '' }}"
                    data-aos="fade-up"
                    data-aos-delay="{{ $index * 50 }}"
                >
                    <button 
                        @click="openIndex = openIndex === {{ $index }} ? null : {{ $index }}"
                        class="w-full py-8 flex items-center justify-between text-left group transition-all duration-300"
                        :class="openIndex === {{ $index }} ? 'pb-4' : ''"
                        aria-expanded="false"
                        :aria-expanded="openIndex === {{ $index }} ? 'true' : 'false'"
                    >
                        <span class="text-xl md:text-2xl font-bold tracking-tight pr-8 group-hover:opacity-70 transition-opacity">
                            {{ $faq['question'] }}
                        </span>
                        <span 
                            class="flex-shrink-0 w-10 h-10 {{ $dark ? 'border-white/20' : 'border-black/20' }} border rounded-full flex items-center justify-center transition-all duration-300"
                            :class="openIndex === {{ $index }} ? '{{ $dark ? 'bg-white text-black rotate-45' : 'bg-black text-white rotate-45' }}' : ''"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"></path>
                            </svg>
                        </span>
                    </button>
                    <div 
                        x-show="openIndex === {{ $index }}"
                        x-collapse
                        x-cloak
                    >
                        <div class="pb-8 pr-16">
                            <p class="{{ $dark ? 'text-gray-400' : 'text-gray-600' }} font-light leading-relaxed text-lg">
                                {{ $faq['answer'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FAQ Schema for Google Rich Results --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        @foreach($faqs as $index => $faq)
        {
            "@type": "Question",
            "name": @json($faq['question']),
            "acceptedAnswer": {
                "@type": "Answer",
                "text": @json($faq['answer'])
            }
        }{{ $loop->last ? '' : ',' }}
        @endforeach
    ]
}
</script>
@endif
