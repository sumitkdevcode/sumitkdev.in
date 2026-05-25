@extends('layouts.admin')

@section('header', 'New Journal Entry')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 lg:mb-12">
            <a href="{{ route('admin.blog.index') }}"
                class="text-[9px] lg:text-[10px] uppercase font-bold text-gray-400 hover:text-black transition-colors flex items-center space-x-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back to Journal</span>
            </a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight mt-4">Write New Entry</h1>
        </div>

        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-8 lg:space-y-12 pb-20">
            @csrf

            <div class="space-y-6 lg:space-y-8">
                <!-- Title -->
                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Post
                        Title</label>
                    <input type="text" name="title"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-lg lg:text-xl font-bold outline-none transition-all placeholder:text-gray-200"
                        placeholder="Article Title" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <!-- Category -->
                    <div class="space-y-2">
                        <label
                            class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Category</label>
                        <input type="text" name="category"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all placeholder:text-gray-200"
                            placeholder="e.g. Insights">
                    </div>

                    <!-- Featured Image -->
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Cover
                            Image</label>
                        <div class="mt-2 text-xs">
                            <input type="file" name="featured_image"
                                class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-black file:text-white hover:file:bg-gray-800 transition-all cursor-pointer">
                        </div>
                    </div>

                    <!-- Sub Images -->
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Sub
                            Images (Max 5)</label>
                        <div class="mt-2 text-xs">
                            <input type="file" name="sub_images[]" multiple
                                class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-black file:text-white hover:file:bg-gray-800 transition-all cursor-pointer">
                            <p class="text-[8px] text-gray-400 mt-1 uppercase">JPG, PNG, JPG accepted. Hold Ctrl to select
                                multiple.</p>
                        </div>
                    </div>
                </div>

                <!-- Excerpt -->
                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Summary
                        (Excerpt)</label>
                    <textarea name="excerpt" rows="2"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all resize-none placeholder:text-gray-200"
                        placeholder="A short hook for the post..."></textarea>
                </div>

                <!-- Content -->
                <div class="space-y-2">
                    <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Body
                        Content</label>
                    <textarea name="content" id="editor" rows="15"
                        class="w-full border border-black/5 p-4 lg:p-6 text-sm outline-none focus:border-black transition-all bg-white shadow-sm"
                        placeholder="Write your article here..."></textarea>
                </div>

                <div class="pt-8">
                    <label class="flex items-center space-x-3 cursor-pointer group text-xs">
                        <input type="checkbox" name="is_published" value="1" checked
                            class="w-4 h-4 border-2 border-black rounded-none checked:bg-black transition-all">
                        <span class="text-[10px] uppercase tracking-widest font-bold group-hover:text-black">Publish
                            Immediately</span>
                    </label>
                </div>
            </div>

            <div class="pt-8 lg:pt-12 border-t border-black/5">
                <button type="submit"
                    class="w-full sm:w-auto bg-black text-white px-10 lg:px-12 py-4 lg:py-5 text-[10px] lg:text-xs font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    Publish Entry
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
                    alert('Please enter content for the blog post.');
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