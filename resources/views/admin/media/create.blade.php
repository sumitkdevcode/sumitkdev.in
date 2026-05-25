@extends('layouts.admin')

@section('header', 'New Asset')

@section('content')
    <div class="max-w-xl mx-auto">
        <div class="mb-8 lg:mb-12">
            <a href="{{ route('admin.media.index') }}"
                class="text-[9px] lg:text-[10px] uppercase font-bold text-gray-400 hover:text-black transition-colors flex items-center space-x-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back to Assets</span>
            </a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight mt-4">Upload Media</h1>
        </div>

        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-8 lg:space-y-12 bg-white border border-black/5 p-6 lg:p-12 shadow-sm rounded-sm">
            @csrf

            <div class="space-y-6 lg:space-y-8">
                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Descriptive Title</label>
                    <input type="text" name="title"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm font-bold outline-none transition-all placeholder:text-gray-200"
                        placeholder="Enter title (optional)">
                </div>

                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Category Tag</label>
                    <input type="text" name="category"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all placeholder:text-gray-200"
                        placeholder="e.g. Photography, Motion">
                </div>

                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Select File (Image/Video)</label>
                    <div
                        class="mt-4 border-2 border-dashed border-black/10 p-8 lg:p-12 text-center group hover:border-black transition-all bg-gray-50/50">
                        <input type="file" name="file" class="hidden" id="fileInput" required
                            onchange="updateFileName(this)">
                        <label for="fileInput" class="cursor-pointer block">
                            <svg class="w-10 h-10 lg:w-12 lg:h-12 mx-auto text-gray-200 mb-4 group-hover:text-black transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                            </svg>
                            <p id="fileName"
                                class="text-[10px] uppercase tracking-widest font-bold text-gray-400 group-hover:text-black px-4">
                                Click to select asset</p>
                        </label>
                    </div>
                    <p class="text-[7px] lg:text-[8px] uppercase tracking-widest text-gray-400 mt-4 leading-loose">Max size: 20MB. Supported: JPG, PNG, WEBP, MP4, MOV.</p>
                </div>
            </div>

            <div class="pt-4 lg:pt-8">
                <button type="submit"
                    class="w-full bg-black text-white px-8 lg:px-12 py-4 lg:py-5 text-[10px] lg:text-xs font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    Start Upload
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateFileName(input) {
            const fileName = input.files[0] ? input.files[0].name : 'Click to select asset';
            document.getElementById('fileName').textContent = fileName;
        }
    </script>
@endsection