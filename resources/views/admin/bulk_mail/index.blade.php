@extends('layouts.admin')

@section('header', 'Bulk Mailer')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Send Bulk Mail</h1>
            <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Blast emails using your custom templates</p>
        </div>

        <form action="{{ route('admin.bulk-mail.send') }}" method="POST" class="bg-white border border-gray-100 p-6 lg:p-8 space-y-8 shadow-sm">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                <!-- Template Selection -->
                <div>
                    <label for="template_id" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Select Template <span class="text-red-500">*</span></label>
                    <select name="template_id" id="template_id" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">
                        <option value="">-- Choose an Email Template --</option>
                        @foreach($templates as $template)
                            <option value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'selected' : '' }}>
                                {{ $template->name }} (Subject: {{ $template->subject }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Email List -->
                <div>
                    <label for="emails" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Recipient Emails <span class="text-red-500">*</span></label>
                    <p class="text-[10px] text-gray-500 mb-3">Paste a list of email addresses. You can separate them by commas or new lines.</p>
                    <textarea name="emails" id="emails" rows="12" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors"
                        placeholder="john@example.com&#10;jane@company.com&#10;contact@agency.com">{{ old('emails') }}</textarea>
                </div>
                
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs text-blue-800 font-medium">Emails will be dispatched in the background to prevent timeouts.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                    class="bg-black text-white px-8 py-4 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors w-full sm:w-auto flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    Send Bulk Email
                </button>
            </div>
        </form>
    </div>
@endsection
