@extends('layouts.admin')

@section('header', 'Add New Page SEO')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 lg:mb-12">
            <a href="{{ route('admin.seo.index') }}"
                class="text-[10px] uppercase font-bold text-gray-400 hover:text-black transition-colors mb-4 inline-block">←
                Back to List</a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Add New Page SEO</h1>
            <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Configure meta tags for a new
                page link</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-4 mb-8 text-[10px] uppercase tracking-widest border border-red-100">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.seo.store') }}" method="POST" class="space-y-12 lg:space-y-20 pb-20">
            @csrf

            <!-- Page Identity -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">Page Details</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12">
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Page
                            Name</label>
                        <input type="text" name="page_name" value="{{ old('page_name') }}" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="e.g. Services, Custom Page">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Page Link
                            / Path</label>
                        <input type="text" name="page_path" value="{{ old('page_path') }}" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="e.g. /services, /custom-page">
                        <p class="text-[10px] text-gray-400 mt-1">Must start with /</p>
                    </div>
                </div>
            </section>

            <!-- Meta Tags -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">Standard Meta Tags
                </h3>

                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Meta
                            Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="Page Title">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Meta
                            Description</label>
                        <textarea name="meta_description" rows="3"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all resize-none"
                            placeholder="Detailed description of the page content">{{ old('meta_description') }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Meta
                            Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="keyword1, keyword2, keyword3">
                    </div>
                </div>
            </section>

            <!-- Social Media (Open Graph) -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">Social Media (Open
                    Graph)</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12">
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">OG
                            Title</label>
                        <input type="text" name="og_title" value="{{ old('og_title') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="Sharing Title">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">OG Image
                            URL</label>
                        <input type="text" name="og_image" value="{{ old('og_image') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="https://example.com/image.jpg">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">OG
                        Description</label>
                    <textarea name="og_description" rows="2"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all resize-none"
                        placeholder="Sharing Description">{{ old('og_description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12 pt-6">
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Twitter
                            Card</label>
                        <select name="twitter_card"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all">
                            <option value="summary">Summary</option>
                            <option value="summary_large_image" selected>Summary Large Image</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Twitter
                            Handle</label>
                        <input type="text" name="twitter_handle" value="{{ old('twitter_handle') }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="@yourusername">
                    </div>
                </div>
            </section>

            <div class="pt-8 lg:pt-12 border-t border-black/5">
                <button type="submit"
                    class="w-full sm:w-auto bg-black text-white px-10 lg:px-12 py-4 lg:py-5 text-[10px] lg:text-xs font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    Create SEO Entry
                </button>
            </div>
        </form>
    </div>
@endsection