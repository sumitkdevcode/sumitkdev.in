@extends('layouts.admin')

@section('header', 'Edit Social Post')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.social-posts.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Back to Posts
    </a>
</div>

<div class="bg-white border border-black/5 p-6 md:p-8">
    <form action="{{ route('admin.social-posts.update', $social_post) }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="platform" class="block text-sm font-bold text-gray-900 mb-1">Platform <span class="text-red-500">*</span></label>
                <select name="platform" id="platform" required class="w-full border-gray-300 rounded-none shadow-sm focus:border-black focus:ring-black">
                    <option value="instagram" {{ old('platform', $social_post->platform) == 'instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="twitter" {{ old('platform', $social_post->platform) == 'twitter' ? 'selected' : '' }}>Twitter / X</option>
                    <option value="linkedin" {{ old('platform', $social_post->platform) == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                    <option value="custom" {{ old('platform', $social_post->platform) == 'custom' ? 'selected' : '' }}>Custom Update</option>
                </select>
            </div>

            <div>
                <label for="media_type" class="block text-sm font-bold text-gray-900 mb-1">Media Type <span class="text-red-500">*</span></label>
                <select name="media_type" id="media_type" required class="w-full border-gray-300 rounded-none shadow-sm focus:border-black focus:ring-black">
                    <option value="IMAGE" {{ old('media_type', $social_post->media_type) == 'IMAGE' ? 'selected' : '' }}>Image</option>
                    <option value="VIDEO" {{ old('media_type', $social_post->media_type) == 'VIDEO' ? 'selected' : '' }}>Video</option>
                    <option value="CAROUSEL_ALBUM" {{ old('media_type', $social_post->media_type) == 'CAROUSEL_ALBUM' ? 'selected' : '' }}>Carousel</option>
                </select>
            </div>
        </div>

        <div>
            <label for="content" class="block text-sm font-bold text-gray-900 mb-1">Caption / Content</label>
            <textarea name="content" id="content" rows="4" class="w-full border-gray-300 rounded-none shadow-sm focus:border-black focus:ring-black placeholder-gray-400">{{ old('content', $social_post->content) }}</textarea>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Media Attachment</h3>
            
            @if($social_post->media_url)
                <div class="mb-4">
                    <p class="text-sm font-bold mb-2">Current Media:</p>
                    <img src="{{ str_starts_with($social_post->media_url, 'http') ? $social_post->media_url : asset('storage/' . $social_post->media_url) }}" class="h-32 object-cover border border-gray-200">
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 border border-gray-200">
                    <label for="media_upload" class="block text-sm font-bold text-gray-900 mb-1">Option A: Upload New Image</label>
                    <p class="text-xs text-gray-500 mb-3">Leave blank to keep current image.</p>
                    <input type="file" name="media_upload" id="media_upload" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white hover:file:bg-gray-800 transition-all cursor-pointer">
                </div>

                <div class="bg-gray-50 p-4 border border-gray-200">
                    <label for="media_url" class="block text-sm font-bold text-gray-900 mb-1">Option B: External Image URL</label>
                    <input type="url" name="media_url" id="media_url" value="{{ old('media_url', str_starts_with($social_post->media_url, 'http') ? $social_post->media_url : '') }}" class="w-full border-gray-300 rounded-none shadow-sm focus:border-black focus:ring-black" placeholder="https://...">
                </div>
            </div>
        </div>

        <div>
            <label for="permalink" class="block text-sm font-bold text-gray-900 mb-1">Original Post Link</label>
            <input type="url" name="permalink" id="permalink" value="{{ old('permalink', $social_post->permalink) }}" class="w-full border-gray-300 rounded-none shadow-sm focus:border-black focus:ring-black" placeholder="https://instagram.com/p/...">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="published_at" class="block text-sm font-bold text-gray-900 mb-1">Date Posted <span class="text-red-500">*</span></label>
                <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $social_post->published_at->format('Y-m-d\TH:i')) }}" required class="w-full border-gray-300 rounded-none shadow-sm focus:border-black focus:ring-black">
            </div>

            <div class="flex items-center mt-6">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $social_post->is_published) ? 'checked' : '' }} class="h-5 w-5 text-black border-gray-300 rounded focus:ring-black">
                <label for="is_published" class="ml-2 block text-sm font-bold text-gray-900">Publish Immediately</label>
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-black text-white px-8 py-3 font-bold hover:bg-gray-800 transition-colors uppercase tracking-widest text-sm">
                Update Post
            </button>
        </div>
    </form>
</div>
@endsection
