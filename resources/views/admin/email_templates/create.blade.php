@extends('layouts.admin')

@section('header', 'Add Email Template')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.email-templates.index') }}" class="text-[10px] uppercase tracking-widest text-gray-500 hover:text-black transition-colors">
                &larr; Back to Email Templates
            </a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight mt-4">New Email Template</h1>
        </div>

        <form action="{{ route('admin.email-templates.store') }}" method="POST" class="bg-white border border-gray-100 p-6 lg:p-8 space-y-8 shadow-sm">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Template Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors"
                        placeholder="Internal name for this template">
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Email Subject <span class="text-red-500">*</span></label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors"
                        placeholder="Welcome to my newsletter!">
                </div>

                <!-- Body -->
                <div>
                    <label for="body" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Email Body <span class="text-red-500">*</span></label>
                    <p class="text-[10px] text-gray-500 mb-3">You can use <code class="bg-gray-100 px-1 py-0.5">@{{ name }}</code> as a placeholder for the recipient's name.</p>
                    <textarea name="body" id="body" rows="10" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">{{ old('body') }}</textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                    class="bg-black text-white px-8 py-4 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors w-full sm:w-auto">
                    Save Template
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof window.initCKEditor === 'function') {
                window.initCKEditor('body');
            }
        });
    </script>
@endpush
