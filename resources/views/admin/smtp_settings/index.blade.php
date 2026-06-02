@extends('layouts.admin')

@section('header', 'SMTP Settings')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 lg:mb-12 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">SMTP Configurations</h1>
                <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Manage outbound email settings</p>
            </div>
            <a href="{{ route('admin.smtp-settings.create') }}"
                class="bg-black text-white px-6 py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">
                Add New Configuration +
            </a>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Name</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Host / Port</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">From Address</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Status</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($settings as $setting)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-900">{{ $setting->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-gray-600 block">{{ $setting->mail_host }}</span>
                                <span class="text-[10px] text-gray-400 font-mono">Port: {{ $setting->mail_port }} ({{ $setting->mail_encryption ?? 'none' }})</span>
                            </td>
                            <td class="px-6 py-4 text-[10px] font-medium text-gray-600 font-mono">
                                {{ $setting->mail_from_address }}
                            </td>
                            <td class="px-6 py-4">
                                @if($setting->is_default)
                                    <span class="bg-green-100 text-green-800 text-[9px] uppercase font-bold px-2 py-1">Default</span>
                                @else
                                    <span class="bg-gray-100 text-gray-600 text-[9px] uppercase font-bold px-2 py-1">Standby</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    @if(!$setting->is_default)
                                    <form action="{{ route('admin.smtp-settings.make-default', $setting->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="text-[9px] uppercase font-bold text-blue-500 border border-blue-100 px-3 py-1.5 hover:bg-blue-50 transition-all">
                                            Make Default
                                        </button>
                                    </form>
                                    @endif

                                    <a href="{{ route('admin.smtp-settings.edit', $setting->id) }}"
                                        class="text-[9px] uppercase font-bold text-black border border-black/20 px-3 py-1.5 hover:border-black transition-all">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.smtp-settings.destroy', $setting->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this SMTP configuration?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-[9px] uppercase font-bold text-red-500 border border-red-100 px-3 py-1.5 hover:bg-red-50 transition-all">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">
                                No SMTP configurations found. Create one to start sending emails.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
