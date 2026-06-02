@extends('layouts.admin')

@section('header', 'Add SMTP Configuration')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.smtp-settings.index') }}" class="text-[10px] uppercase tracking-widest text-gray-500 hover:text-black transition-colors">
                &larr; Back to SMTP Settings
            </a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight mt-4">New SMTP Configuration</h1>
        </div>

        <form action="{{ route('admin.smtp-settings.store') }}" method="POST" class="bg-white border border-gray-100 p-6 lg:p-8 space-y-8 shadow-sm">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Configuration Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors"
                        placeholder="e.g. Mailgun Production, SendGrid">
                </div>

                <!-- Mailer -->
                <div>
                    <label for="mail_mailer" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Mailer <span class="text-red-500">*</span></label>
                    <input type="text" name="mail_mailer" id="mail_mailer" value="{{ old('mail_mailer', 'smtp') }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">
                </div>

                <!-- Host -->
                <div>
                    <label for="mail_host" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Mail Host <span class="text-red-500">*</span></label>
                    <input type="text" name="mail_host" id="mail_host" value="{{ old('mail_host') }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors"
                        placeholder="smtp.mailgun.org">
                </div>

                <!-- Port -->
                <div>
                    <label for="mail_port" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Mail Port <span class="text-red-500">*</span></label>
                    <input type="number" name="mail_port" id="mail_port" value="{{ old('mail_port', 587) }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">
                </div>

                <!-- Encryption -->
                <div>
                    <label for="mail_encryption" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Encryption</label>
                    <select name="mail_encryption" id="mail_encryption"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">
                        <option value="">None</option>
                        <option value="tls" {{ old('mail_encryption') == 'tls' ? 'selected' : '' }}>TLS</option>
                        <option value="ssl" {{ old('mail_encryption') == 'ssl' ? 'selected' : '' }}>SSL</option>
                    </select>
                </div>

                <!-- Username -->
                <div>
                    <label for="mail_username" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Username</label>
                    <input type="text" name="mail_username" id="mail_username" value="{{ old('mail_username') }}"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">
                </div>

                <!-- Password -->
                <div>
                    <label for="mail_password" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">Password</label>
                    <input type="text" name="mail_password" id="mail_password" value="{{ old('mail_password') }}"
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors">
                </div>

                <!-- From Address -->
                <div>
                    <label for="mail_from_address" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">From Address <span class="text-red-500">*</span></label>
                    <input type="email" name="mail_from_address" id="mail_from_address" value="{{ old('mail_from_address') }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors"
                        placeholder="noreply@example.com">
                </div>

                <!-- From Name -->
                <div>
                    <label for="mail_from_name" class="block text-xs font-bold text-gray-900 uppercase tracking-widest mb-2">From Name <span class="text-red-500">*</span></label>
                    <input type="text" name="mail_from_name" id="mail_from_name" value="{{ old('mail_from_name') }}" required
                        class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-none focus:ring-black focus:border-black block p-3 transition-colors"
                        placeholder="John Doe">
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit"
                    class="bg-black text-white px-8 py-4 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors w-full sm:w-auto">
                    Save Configuration
                </button>
            </div>
        </form>
    </div>
@endsection
