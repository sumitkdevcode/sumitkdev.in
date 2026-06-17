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
        "name": "Base64 Encoder & Decoder",
        "operatingSystem": "Any",
        "applicationCategory": "DeveloperApplication",
        "description": "Fast and secure tool to encode strings to Base64 or decode them back directly in your browser.",
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
    <div class="max-w-[1000px] mx-auto px-6">
        
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-5xl font-black tracking-tighter mb-4 text-gray-900">Base64 Encoder / Decoder</h1>
            <p class="text-gray-500 max-w-2xl mx-auto">Convert text to Base64 or decode Base64 back to text instantly. 100% client-side for privacy.</p>
        </div>

        <div x-data="base64Tool()" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-10 neo-frame">
            
            <!-- Mode Switcher -->
            <div class="flex justify-center mb-8">
                <div class="inline-flex bg-gray-100 rounded-lg p-1">
                    <button @click="mode = 'encode'; process()" :class="mode === 'encode' ? 'bg-white shadow-sm text-emerald-600' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2 rounded-md text-sm font-bold uppercase tracking-widest transition-all">
                        Encode to Base64
                    </button>
                    <button @click="mode = 'decode'; process()" :class="mode === 'decode' ? 'bg-white shadow-sm text-emerald-600' : 'text-gray-500 hover:text-gray-700'" class="px-6 py-2 rounded-md text-sm font-bold uppercase tracking-widest transition-all">
                        Decode from Base64
                    </button>
                </div>
            </div>

            <!-- Error Banner -->
            <div x-show="error" x-cloak class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200 flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <span x-text="error" class="font-medium text-sm"></span>
            </div>

            <div class="space-y-6">
                <!-- Input -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-700 uppercase tracking-widest mb-2" x-text="mode === 'encode' ? 'Text Input' : 'Base64 Input'"></label>
                    <textarea x-model="input" @input="process" rows="6" placeholder="Type or paste here..."
                        class="w-full p-4 font-mono text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-y"></textarea>
                </div>

                <!-- Action Button (Clear) -->
                <div class="flex justify-end">
                     <button @click="clearInput" class="px-4 py-2 bg-gray-100 text-gray-600 text-xs font-bold uppercase tracking-widest rounded hover:bg-gray-200 transition-colors">
                        Clear
                    </button>
                </div>

                <!-- Output -->
                <div class="flex flex-col relative">
                    <label class="text-sm font-bold text-gray-700 uppercase tracking-widest mb-2" x-text="mode === 'encode' ? 'Base64 Output' : 'Text Output'"></label>
                    <textarea x-model="output" rows="6" readonly placeholder="Result will appear here..."
                        class="w-full p-4 font-mono text-sm bg-gray-900 text-gray-100 border border-gray-800 rounded-lg focus:ring-0 resize-y"></textarea>
                    
                    <button @click="copyToClipboard" x-show="output" class="absolute bottom-4 right-4 px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-md text-xs font-bold uppercase tracking-widest backdrop-blur-sm transition-colors border border-white/20">
                        <span x-show="!copied">Copy</span>
                        <span x-show="copied" class="text-emerald-400">Copied!</span>
                    </button>
                </div>
            </div>
            
            <div class="mt-10 pt-8 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">Ad Space</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('base64Tool', () => ({
            mode: 'encode', // 'encode' or 'decode'
            input: '',
            output: '',
            error: null,
            copied: false,
            
            process() {
                this.error = null;
                if(!this.input) {
                    this.output = '';
                    return;
                }
                
                try {
                    if(this.mode === 'encode') {
                        // Support unicode characters
                        this.output = btoa(unescape(encodeURIComponent(this.input)));
                    } else {
                        this.output = decodeURIComponent(escape(atob(this.input)));
                    }
                } catch (e) {
                    this.error = "Error processing data. Ensure input is valid for the selected mode.";
                    this.output = '';
                }
            },
            
            copyToClipboard() {
                if(!this.output) return;
                navigator.clipboard.writeText(this.output).then(() => {
                    this.copied = true;
                    setTimeout(() => this.copied = false, 2000);
                });
            },
            
            clearInput() {
                this.input = '';
                this.output = '';
                this.error = null;
            }
        }))
    });
</script>
@endsection
