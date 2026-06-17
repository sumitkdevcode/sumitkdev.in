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
        "name": "JSON Formatter & Validator",
        "operatingSystem": "Any",
        "applicationCategory": "DeveloperApplication",
        "description": "Format, beautify, and validate JSON data instantly in your browser securely.",
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
    <div class="max-w-[1400px] mx-auto px-6">
        
        <div class="mb-10 text-center">
            <h1 class="text-3xl md:text-5xl font-black tracking-tighter mb-4 text-gray-900">JSON Formatter & Validator</h1>
            <p class="text-gray-500 max-w-2xl mx-auto">Paste your minified or unformatted JSON below. Everything is processed securely in your browser.</p>
        </div>

        <div x-data="jsonFormatter()" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 neo-frame">
            
            <!-- Controls -->
            <div class="flex flex-wrap gap-4 mb-6 pb-6 border-b border-gray-100">
                <button @click="formatJson" class="px-6 py-2 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
                    Format JSON
                </button>
                <button @click="minifyJson" class="px-6 py-2 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors">
                    Minify
                </button>
                <button @click="copyToClipboard" class="px-6 py-2 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors ml-auto relative">
                    <span x-show="!copied">Copy Output</span>
                    <span x-show="copied" class="text-emerald-600">Copied!</span>
                </button>
                <button @click="clearInput" class="px-6 py-2 bg-red-50 text-red-600 font-bold rounded-lg hover:bg-red-100 transition-colors">
                    Clear
                </button>
            </div>

            <!-- Error Banner -->
            <div x-show="error" x-cloak class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200 flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <span x-text="error" class="font-medium text-sm"></span>
            </div>

            <!-- Success Banner -->
            <div x-show="successMessage" x-cloak class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-lg border border-emerald-200 flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span x-text="successMessage" class="font-medium text-sm"></span>
            </div>

            <!-- Editor Grid -->
            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Input -->
                <div class="flex flex-col h-[500px]">
                    <label class="text-sm font-bold text-gray-700 uppercase tracking-widest mb-2 flex justify-between">
                        Input
                        <span class="text-gray-400 font-normal">Paste here</span>
                    </label>
                    <textarea x-model="input" placeholder='{"paste": "your JSON here"}'
                        class="flex-1 w-full p-4 font-mono text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all resize-none"></textarea>
                </div>

                <!-- Output -->
                <div class="flex flex-col h-[500px]">
                    <label class="text-sm font-bold text-gray-700 uppercase tracking-widest mb-2 flex justify-between">
                        Output
                        <span x-show="input && !error" x-cloak class="text-emerald-500 font-bold">Valid JSON</span>
                    </label>
                    <textarea x-model="output" readonly placeholder='Formatted output will appear here'
                        class="flex-1 w-full p-4 font-mono text-sm bg-gray-900 text-gray-100 border border-gray-800 rounded-lg focus:ring-0 resize-none"></textarea>
                </div>
            </div>
            
            <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">Ad Space</p>
                <!-- Google AdSense Placeholder -->
                <ins class="adsbygoogle block mt-2"
                    data-ad-client="ca-pub-5730762848368403"
                    data-ad-slot="auto"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('jsonFormatter', () => ({
            input: '',
            output: '',
            error: null,
            successMessage: null,
            copied: false,
            
            formatJson() {
                this.error = null;
                this.successMessage = null;
                if(!this.input.trim()) return;
                
                try {
                    const parsed = JSON.parse(this.input);
                    this.output = JSON.stringify(parsed, null, 4);
                    this.successMessage = "Valid JSON formatted successfully!";
                } catch (e) {
                    this.error = "Invalid JSON: " + e.message;
                    this.output = '';
                }
            },
            
            minifyJson() {
                this.error = null;
                this.successMessage = null;
                if(!this.input.trim()) return;
                
                try {
                    const parsed = JSON.parse(this.input);
                    this.output = JSON.stringify(parsed);
                } catch (e) {
                    this.error = "Invalid JSON: " + e.message;
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
                this.successMessage = null;
            }
        }))
    });
</script>
@endsection
