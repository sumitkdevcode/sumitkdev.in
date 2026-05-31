@extends('layouts.admin')

@section('header', 'Edit Media')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Edit Media</h1>
        <p class="text-xs text-gray-500 uppercase tracking-widest mt-1">Update media details</p>
    </div>

    <div class="bg-white border border-black/5 p-6 md:p-8 max-w-3xl">
        <form action="{{ route('admin.media.update', $medium->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-8 border border-black/10 bg-gray-50 p-4 inline-block relative group">
                @if($medium->file_type === 'video')
                    <video src="{{ asset('storage/' . $medium->file_path) }}" class="max-h-64 object-contain" controls></video>
                @else
                    <img src="{{ asset('storage/' . $medium->file_path) }}" alt="{{ $medium->title }}" class="max-h-64 object-contain">
                @endif
                <div class="mt-4">
                    <label class="block text-[10px] font-bold uppercase tracking-widest mb-2">Replace File <span class="text-gray-400 font-normal">(Optional)</span></label>
                    <input type="file" name="file"
                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-black file:text-white hover:file:bg-gray-800 transition-all cursor-pointer">
                    @error('file')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-[10px] font-bold uppercase tracking-widest mb-2">Title <span class="text-gray-400 font-normal">(Optional)</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $medium->title) }}"
                        class="w-full border-black/10 focus:border-black focus:ring-black px-4 py-3 bg-gray-50 focus:bg-white transition-colors"
                        placeholder="e.g. Hero Background Image">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-[10px] font-bold uppercase tracking-widest mb-2">Category <span class="text-gray-400 font-normal">(Optional)</span></label>
                    <input type="text" name="category" id="category" value="{{ old('category', $medium->category) }}"
                        class="w-full border-black/10 focus:border-black focus:ring-black px-4 py-3 bg-gray-50 focus:bg-white transition-colors"
                        placeholder="e.g. Portfolio, Blog">
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6 border-t border-black/5 flex gap-4">
                    <button type="submit" class="bg-black text-white px-8 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
                        Update Media
                    </button>
                    <a href="{{ route('admin.media.index') }}" class="px-8 py-3 border-2 border-black/10 text-xs font-bold uppercase tracking-widest hover:border-black transition-colors">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
