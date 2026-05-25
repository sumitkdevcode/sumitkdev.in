@extends('layouts.admin')

@section('header', 'Edit Project')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 lg:mb-12">
            <a href="{{ route('admin.portfolio.index') }}"
                class="text-[9px] lg:text-[10px] uppercase font-bold text-gray-400 hover:text-black transition-colors flex items-center space-x-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back to Work</span>
            </a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight mt-4">Edit: {{ $portfolio->title }}</h1>
        </div>

        <form action="{{ route('admin.portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-8 lg:space-y-12 pb-20">
            @csrf
            @method('PUT')

            <div class="space-y-6 lg:space-y-8">
                <!-- Title -->
                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Project
                        Title</label>
                    <input type="text" name="title" value="{{ old('title', $portfolio->title) }}"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-lg lg:text-xl font-bold outline-none transition-all placeholder:text-gray-200"
                        placeholder="Project Name" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <!-- Category -->
                    <div class="space-y-2">
                        <label
                            class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Category</label>
                        <input type="text" name="category" value="{{ old('category', $portfolio->category) }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all placeholder:text-gray-200"
                            placeholder="e.g. Development">
                    </div>

                    <!-- Featured Image -->
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Featured
                            Media</label>
                        @if($portfolio->featured_image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $portfolio->featured_image) }}"
                                    class="w-32 h-20 object-cover border border-black/5" alt="">
                            </div>
                        @endif
                        <div class="mt-2 text-xs">
                            <input type="file" name="featured_image"
                                class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-black file:text-white hover:file:bg-gray-800 transition-all cursor-pointer">
                        </div>
                    </div>

                    <!-- Sub Images -->
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Project
                            Gallery (Sub Images)</label>
                        @if($portfolio->sub_images && count($portfolio->sub_images) > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($portfolio->sub_images as $image)
                                    <img src="{{ asset('storage/' . $image) }}" class="w-16 h-16 object-cover border border-black/5"
                                        alt="">
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-2 text-xs">
                            <input type="file" name="sub_images[]" multiple
                                class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-black file:text-white hover:file:bg-gray-800 transition-all cursor-pointer">
                            <p class="text-[8px] text-gray-400 mt-1 uppercase">Selection will replace all existing sub
                                images.</p>
                        </div>
                    </div>
                </div>

                <!-- Short Description -->
                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Overview
                        (Excerpt)</label>
                    <textarea name="short_description" rows="2"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all resize-none placeholder:text-gray-200"
                        placeholder="A brief summary for cards...">{{ old('short_description', $portfolio->short_description) }}</textarea>
                </div>

                <!-- Full Description -->
                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Case Study
                        Content</label>
                    <textarea name="description" id="editor" rows="10"
                        class="w-full border border-black/5 p-4 lg:p-6 text-sm outline-none focus:border-black transition-all bg-white shadow-sm"
                        placeholder="Detailed breakdown..."
                        required>{{ old('description', $portfolio->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <!-- GitHub -->
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Source
                            Link</label>
                        <input type="url" name="github_link" value="{{ old('github_link', $portfolio->github_link) }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all placeholder:text-gray-200"
                            placeholder="https://github.com/...">
                    </div>

                    <!-- Live Link -->
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Live
                            Link</label>
                        <input type="url" name="live_link" value="{{ old('live_link', $portfolio->live_link) }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all placeholder:text-gray-200"
                            placeholder="https://...">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-12 pt-8">
                    <label class="flex items-center space-x-3 cursor-pointer group text-xs">
                        <input type="checkbox" name="is_published" value="1" {{ $portfolio->is_published ? 'checked' : '' }}
                            class="w-4 h-4 border-2 border-black rounded-none checked:bg-black transition-all">
                        <span
                            class="text-[10px] uppercase tracking-widest font-bold group-hover:text-black">Published</span>
                    </label>

                    <label class="flex items-center space-x-3 cursor-pointer group text-xs">
                        <input type="checkbox" name="is_featured" value="1" {{ $portfolio->is_featured ? 'checked' : '' }}
                            class="w-4 h-4 border-2 border-black rounded-none checked:bg-black transition-all">
                        <span class="text-[10px] uppercase tracking-widest font-bold group-hover:text-black">Featured on
                            Homepage</span>
                    </label>
                </div>
            </div>

            <div class="pt-8 lg:pt-12 border-t border-black/5">
                <button type="submit"
                    class="w-full sm:w-auto bg-black text-white px-10 lg:px-12 py-4 lg:py-5 text-[10px] lg:text-xs font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    Update Project
                </button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        let editorInstance;

        // Wait for CKEditor to load
        function initCKEditor() {
            if (typeof ClassicEditor === 'undefined') {
                setTimeout(initCKEditor, 100);
                return;
            }

            ClassicEditor
                .create(document.querySelector('#editor'), window.CKEditorConfig)
                .then(editor => {
                    editorInstance = editor;
                    console.log('CKEditor initialized successfully');
                })
                .catch(error => {
                    console.error('CKEditor initialization error:', error);
                });
        }

        initCKEditor();

        // Sync CKEditor content to textarea before form submission
        document.querySelector('form').addEventListener('submit', function (e) {
            if (editorInstance) {
                const contentInput = document.querySelector('#editor');
                contentInput.value = editorInstance.getData();

                // Validate content
                if (!contentInput.value.trim()) {
                    e.preventDefault();
                    alert('Please enter description for the project.');
                    return false;
                }
            }
        });
    </script>
    <style>
        .ck-editor__editable {
            min-height: 400px;
            background: #ffffff;
        }

        .ck-editor__editable:focus {
            border-color: #000 !important;
        }

        .ck.ck-editor {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .ck.ck-toolbar {
            border-color: rgba(0, 0, 0, 0.1) !important;
            background: #fafafa !important;
        }

        .ck.ck-content {
            border-color: rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endpush