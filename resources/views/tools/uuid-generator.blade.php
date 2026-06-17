@extends('layouts.app')

@section('meta_title', $seoData->meta_title)
@section('meta_description', $seoData->meta_description)
@section('og_title', $seoData->og_title)
@section('og_description', $seoData->og_description)

@section('meta')
    <!-- SoftwareApplication Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "UUID / GUID Generator",
        "operatingSystem": "Any",
        "applicationCategory": "DeveloperApplication",
        "description": "Generate secure random UUIDs (v4) online instantly.",
        "offers": {
            "@type": "Offer",
            "price": "0",
            "priceCurrency": "USD"
        }
    }
    </script>
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen py-16">
    <div class="max-w-[800px] mx-auto px-6">
        
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-5xl font-black tracking-tighter mb-4 text-gray-900">UUID / GUID Generator</h1>
            <p class="text-gray-500 max-w-xl mx-auto">Generate cryptographically secure version 4 UUIDs instantly in your browser.</p>
        </div>

        <div x-data="uuidGenerator()" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 neo-frame text-center">
            
            <div class="mb-10">
                <div class="inline-flex flex-wrap justify-center gap-4 bg-gray-50 p-2 rounded-xl border border-gray-100">
                    <button @click="generate(1)" class="px-6 py-2 bg-white shadow-sm border border-gray-200 text-gray-900 font-bold rounded-lg hover:border-rose-300 transition-colors">
                        Generate 1
                    </button>
                    <button @click="generate(5)" class="px-6 py-2 bg-white shadow-sm border border-gray-200 text-gray-900 font-bold rounded-lg hover:border-rose-300 transition-colors">
                        Generate 5
                    </button>
                    <button @click="generate(20)" class="px-6 py-2 bg-white shadow-sm border border-gray-200 text-gray-900 font-bold rounded-lg hover:border-rose-300 transition-colors">
                        Generate 20
                    </button>
                </div>
            </div>

            <div class="relative text-left">
                <textarea x-model="output" rows="10" readonly placeholder="UUIDs will appear here..."
                    class="w-full p-6 font-mono text-lg leading-relaxed bg-gray-900 text-rose-300 border border-gray-800 rounded-xl focus:ring-0 resize-none selection:bg-rose-500/30 text-center"></textarea>
                
                <button @click="copyToClipboard" x-show="output" class="absolute bottom-6 right-6 px-6 py-3 bg-white/10 hover:bg-white/20 text-white rounded-lg text-sm font-bold uppercase tracking-widest backdrop-blur-sm transition-colors border border-white/20">
                    <span x-show="!copied">Copy All</span>
                    <span x-show="copied" class="text-rose-400">Copied!</span>
                </button>
            </div>
            
            <div class="mt-10 pt-8 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">Ad Space</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('uuidGenerator', () => ({
            output: '',
            copied: false,
            
            init() {
                // Generate 1 by default on load
                this.generate(1);
            },
            
            generate(count) {
                let uuids = [];
                for(let i=0; i<count; i++) {
                    uuids.push(this.uuidv4());
                }
                this.output = uuids.join('\n');
            },
            
            uuidv4() {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
            },
            
            copyToClipboard() {
                if(!this.output) return;
                navigator.clipboard.writeText(this.output).then(() => {
                    this.copied = true;
                    setTimeout(() => this.copied = false, 2000);
                });
            }
        }))
    });
</script>
@endsection
