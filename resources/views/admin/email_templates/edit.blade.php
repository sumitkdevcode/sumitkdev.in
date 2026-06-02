@extends('layouts.admin')

@section('header', 'Edit Email Template')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.email-templates.index') }}" class="text-[10px] uppercase tracking-widest text-gray-500 hover:text-black transition-colors">
                &larr; Back to Email Templates
            </a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight mt-4">Edit Template: {{ $emailTemplate->name }}</h1>
        </div>

        <form action="{{ route('admin.email-templates.update', $emailTemplate->id) }}" method="POST" enctype="multipart/form-data" class="bg-white border border-gray-100 p-6 lg:p-8 space-y-8 shadow-sm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Template Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $emailTemplate->name) }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Email Subject <span class="text-red-500">*</span></label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject', $emailTemplate->subject) }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">
                </div>

                <!-- Body -->
                <div>
                    <label for="body" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Email Body <span class="text-red-500">*</span></label>
                    <p class="text-[10px] text-gray-500 mb-3">You can use <code class="bg-gray-100 px-1 py-0.5">@{{ name }}</code> as a placeholder for the recipient's name.</p>
                    <textarea name="body" id="body" rows="10" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">{{ old('body', $emailTemplate->body) }}</textarea>
                </div>

                <!-- Existing Attachments -->
                @if(!empty($emailTemplate->attachments))
                    <div>
                        <label class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Current Attachments</label>
                        <div class="space-y-2">
                            @foreach($emailTemplate->attachments as $index => $attachment)
                                <div class="flex items-center space-x-3 bg-gray-50 border border-gray-200 p-3">
                                    <a href="{{ asset('storage/' . $attachment) }}" target="_blank" class="text-sm text-blue-600 hover:underline flex-1 truncate">
                                        {{ basename($attachment) }}
                                    </a>
                                    <label class="flex items-center space-x-2 text-sm text-red-600 cursor-pointer">
                                        <input type="checkbox" name="remove_attachments[{{ $index }}]" value="1" class="border-gray-300 text-red-600 focus:ring-red-500 rounded-none">
                                        <span>Remove</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Attachments -->
                <div>
                    <label for="attachments" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Add New Attachments</label>
                    <p class="text-[10px] text-gray-500 mb-3">Upload PDF or image files to be attached to this email. Hold Ctrl/Cmd to select multiple files.</p>
                    <input type="file" name="attachments[]" id="attachments" multiple accept=".pdf,.jpg,.jpeg,.png,.gif"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">
                    @error('attachments.*')
                        <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                    class="bg-black text-white px-8 py-4 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors w-full sm:w-auto">
                    Update Template
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
