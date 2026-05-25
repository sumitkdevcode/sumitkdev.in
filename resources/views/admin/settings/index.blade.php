@extends('layouts.admin')

@section('header', 'Site Configuration')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 lg:mb-12">
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Settings</h1>
            <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Personalize your portfolio
                identity</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-12 lg:space-y-20 pb-20">
            @csrf

            <!-- General Identity -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">Personal Info</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12">
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Full
                            Name</label>
                        <input type="text" name="site_name"
                            value="{{ \App\Models\Setting::get('site_name', 'SUMIT KUMAR') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all placeholder:text-gray-200">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Main
                            Title / Role</label>
                        <input type="text" name="tagline"
                            value="{{ \App\Models\Setting::get('tagline', 'Full Stack Developer') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all placeholder:text-gray-200">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Biography /
                        About Short</label>
                    <textarea name="bio" rows="4"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all resize-none placeholder:text-gray-200">{{ \App\Models\Setting::get('bio') }}</textarea>
                </div>
            </section>

            <!-- SEO Management -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">SEO Management
                </h3>

                <!-- Meta Tags -->
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Meta
                            Title (Home Page)</label>
                        <input type="text" name="meta_title"
                            value="{{ \App\Models\Setting::get('meta_title', 'Sumit Kumar - Full Stack Developer') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="Your Name - Professional Title">
                        <p class="text-xs text-gray-400 mt-1">Recommended: 50-60 characters</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Meta
                            Description</label>
                        <textarea name="meta_description" rows="3"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all resize-none"
                            placeholder="Brief description of your portfolio and services">{{ \App\Models\Setting::get('meta_description') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Recommended: 150-160 characters</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Meta
                            Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ \App\Models\Setting::get('meta_keywords') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="web developer, portfolio, full stack, laravel">
                        <p class="text-xs text-gray-400 mt-1">Comma-separated keywords</p>
                    </div>
                </div>

                <!-- Open Graph Tags -->
                <div class="space-y-6 pt-6 border-t border-black/5">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-600">Open Graph (Facebook/LinkedIn)</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">OG
                                Title</label>
                            <input type="text" name="og_title" value="{{ \App\Models\Setting::get('og_title') }}"
                                class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                                placeholder="Leave empty to use Meta Title">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">OG
                                Image URL</label>
                            <input type="url" name="og_image" value="{{ \App\Models\Setting::get('og_image') }}"
                                class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                                placeholder="https://yoursite.com/og-image.jpg">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">OG
                            Description</label>
                        <textarea name="og_description" rows="2"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all resize-none"
                            placeholder="Leave empty to use Meta Description">{{ \App\Models\Setting::get('og_description') }}</textarea>
                    </div>
                </div>

                <!-- Twitter Card -->
                <div class="space-y-6 pt-6 border-t border-black/5">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-600">Twitter Card</h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label
                                class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Twitter
                                Card Type</label>
                            <select name="twitter_card"
                                class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all">
                                <option value="summary" {{ \App\Models\Setting::get('twitter_card') == 'summary' ? 'selected' : '' }}>Summary</option>
                                <option value="summary_large_image" {{ \App\Models\Setting::get('twitter_card') == 'summary_large_image' ? 'selected' : '' }}>
                                    Summary Large Image</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Twitter
                                Handle</label>
                            <input type="text" name="twitter_handle"
                                value="{{ \App\Models\Setting::get('twitter_handle') }}"
                                class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                                placeholder="@yourusername">
                        </div>
                    </div>
                </div>

                <!-- Analytics -->
                <div class="space-y-6 pt-6 border-t border-black/5">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-600">Analytics & Tracking</h4>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Google
                            Analytics ID</label>
                        <input type="text" name="google_analytics"
                            value="{{ \App\Models\Setting::get('google_analytics') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="G-XXXXXXXXXX or UA-XXXXXXXXX-X">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Google
                            Search Console Verification</label>
                        <input type="text" name="google_verification"
                            value="{{ \App\Models\Setting::get('google_verification') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="Verification meta tag content">
                    </div>
                </div>
            </section>

            <!-- Connectivity -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">Digital Presence
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12">
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">LinkedIn
                            Profile</label>
                        <input type="url" name="linkedin" value="{{ \App\Models\Setting::get('linkedin') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="https://linkedin.com/in/...">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">GitHub
                            Source</label>
                        <input type="url" name="github" value="{{ \App\Models\Setting::get('github') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="https://github.com/...">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Twitter /
                            X</label>
                        <input type="url" name="twitter" value="{{ \App\Models\Setting::get('twitter') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="https://x.com/...">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Contact
                            Email</label>
                        <input type="email" name="email" value="{{ \App\Models\Setting::get('email') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all">
                    </div>
                </div>
            </section>

            <div class="pt-8 lg:pt-12 border-t border-black/5">
                <button type="submit"
                    class="w-full sm:w-auto bg-black text-white px-10 lg:px-12 py-4 lg:py-5 text-[10px] lg:text-xs font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    Apply System Changes
                </button>
            </div>
        </form>
    </div>
@endsection