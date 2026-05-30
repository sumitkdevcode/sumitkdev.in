@extends('layouts.admin')

@section('header', 'Add Social Link')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Add New Link</h1>
            <a href="{{ route('admin.social-links.index') }}"
                class="text-[10px] uppercase font-bold tracking-widest text-gray-500 hover:text-black transition-colors">
                &larr; Back to Links
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 mb-8 text-[10px] uppercase tracking-widest border border-red-100">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.social-links.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white border border-gray-100 p-6 md:p-8">
                <h2 class="text-xs uppercase tracking-[0.2em] font-bold text-gray-400 mb-6 pb-4 border-b border-gray-100">
                    Link Details
                </h2>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Platform Name</label>
                        <input type="text" name="platform_name" value="{{ old('platform_name') }}" required
                            class="w-full border-gray-200 focus:border-black focus:ring-black text-sm" placeholder="e.g., LinkedIn">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Category</label>
                        <select name="category" required class="w-full border-gray-200 focus:border-black focus:ring-black text-sm">
                            <option value="social_media">Social Media</option>
                            <option value="developer_profiles">Developer Profiles</option>
                            <option value="competitive_coding">Competitive Coding</option>
                            <option value="freelance_platforms">Freelance Platforms</option>
                            <option value="website_blog">Website & Blog</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">URL</label>
                        <input type="url" name="url" value="{{ old('url') }}" required
                            class="w-full border-gray-200 focus:border-black focus:ring-black text-sm" placeholder="e.g., https://linkedin.com/in/sumitkdev">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Handle (Optional)</label>
                        <input type="text" name="handle" value="{{ old('handle') }}"
                            class="w-full border-gray-200 focus:border-black focus:ring-black text-sm" placeholder="e.g., @sumitkdev">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Order</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" required
                            class="w-full border-gray-200 focus:border-black focus:ring-black text-sm">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Icon SVG Code</label>
                        <textarea name="icon_svg" rows="4"
                            class="w-full border-gray-200 focus:border-black focus:ring-black text-sm font-mono" placeholder="<svg>...</svg>">{{ old('icon_svg') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                class="border-gray-300 text-black focus:ring-black rounded-sm">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-gray-900">Active (Visible on frontend)</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-black text-white px-8 py-4 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">
                    Save Link
                </button>
            </div>
        </form>
    </div>
@endsection
