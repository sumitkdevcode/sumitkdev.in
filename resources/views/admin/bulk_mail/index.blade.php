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
                <div x-data="emailTags()" x-init="init()">
                    <label for="emails" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Recipient Emails <span class="text-red-500">*</span></label>
                    <p class="text-[10px] text-gray-500 mb-3">Type an email and press Enter, Space, or Comma to add it. You can also paste a list of emails.</p>
                    
                    <div class="w-full bg-gray-50 border border-gray-200 p-3 min-h-[150px] cursor-text flex flex-wrap gap-2 items-start transition-colors"
                         @click="$refs.emailInput.focus()"
                         :class="{ 'ring-1 ring-black border-black': isFocused }">
                        
                        <template x-for="(email, index) in emails" :key="index">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-black text-white text-xs rounded-sm dark:bg-gray-700">
                                <span x-text="email"></span>
                                <button type="button" @click="removeEmail(index)" class="hover:text-red-400 focus:outline-none" title="Remove email">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </span>
                        </template>
                        
                        <input x-ref="emailInput" type="text" x-model="currentInput" 
                            @keydown="handleKeydown" @paste="handlePaste"
                            @focus="isFocused = true" @blur="isFocused = false; addEmails(currentInput); currentInput = ''"
                            class="flex-1 min-w-[200px] bg-transparent border-none focus:ring-0 p-0 text-sm text-gray-900 outline-none m-1"
                            placeholder="Add emails...">
                    </div>
                    
                    <!-- Hidden textarea to store the actual comma-separated emails for form submission -->
                    <textarea name="emails" id="emails" class="hidden" x-model="emails.join(', ')" required></textarea>
                </div>

                @push('scripts')
                <script>
                    function emailTags() {
                        return {
                            emails: [],
                            currentInput: '',
                            isFocused: false,
                            init() {
                                let oldEmails = `{{ old('emails') }}`;
                                if (oldEmails) {
                                    this.addEmails(oldEmails);
                                }
                            },
                            handleKeydown(e) {
                                if (['Enter', ' ', ','].includes(e.key)) {
                                    e.preventDefault();
                                    this.addEmails(this.currentInput);
                                    this.currentInput = '';
                                } else if (e.key === 'Backspace' && this.currentInput === '' && this.emails.length > 0) {
                                    this.removeEmail(this.emails.length - 1);
                                }
                            },
                            handlePaste(e) {
                                e.preventDefault();
                                let pastedData = (e.clipboardData || window.clipboardData).getData('text');
                                this.addEmails(pastedData);
                            },
                            addEmails(str) {
                                if (!str) return;
                                let parts = str.split(/[\s,;\n]+/);
                                parts.forEach(part => {
                                    let email = part.trim();
                                    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    if (email && emailRegex.test(email) && !this.emails.includes(email)) {
                                        this.emails.push(email);
                                    }
                                });
                            },
                            removeEmail(index) {
                                this.emails.splice(index, 1);
                            }
                        }
                    }
                </script>
                @endpush
                
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
