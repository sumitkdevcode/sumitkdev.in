@extends('layouts.admin')

@section('header', 'Message Detail')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 lg:mb-12">
            <a href="{{ route('admin.contacts.index') }}"
                class="text-[9px] lg:text-[10px] uppercase font-bold text-gray-400 hover:text-black transition-colors flex items-center space-x-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span>Back to Inbox</span>
            </a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight mt-4">Inquiry from {{ $message->name }}</h1>
        </div>

        <div
            class="bg-white border border-gray-100 p-8 lg:p-16 space-y-10 lg:space-y-16 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gray-50 rounded-full -mr-32 -mt-32 opacity-30"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 border-b border-gray-100 pb-10 lg:pb-16 relative z-10">
                <div class="space-y-2">
                    <p class="text-[9px] lg:text-[10px] uppercase tracking-[0.3em] text-gray-400 font-black">Sender Identity
                    </p>
                    <p class="text-xl font-black tracking-tight">{{ $message->name }}</p>
                    <p class="text-xs text-black/40 font-medium">{{ $message->email }}</p>
                </div>
                <div class="space-y-2">
                    <p class="text-[9px] lg:text-[10px] uppercase tracking-[0.3em] text-gray-400 font-black">Timeline</p>
                    <p class="text-xl font-black tracking-tight">{{ $message->created_at->format('F d, Y') }}</p>
                    <p class="text-xs text-black/40 font-medium">{{ $message->created_at->format('H:i') }} UTC</p>
                </div>
            </div>

            <div class="relative z-10">
                <p class="text-[9px] lg:text-[10px] uppercase tracking-[0.3em] text-gray-400 font-black mb-6">Subject</p>
                <p class="text-2xl lg:text-3xl font-black tracking-tight">{{ $message->subject ?: 'General Inquiry' }}</p>
            </div>

            <div class="relative z-10">
                <p class="text-[9px] lg:text-[10px] uppercase tracking-[0.3em] text-gray-400 font-black mb-8">Journal Entry
                    / Message</p>
                <div
                    class="text-base lg:text-xl font-light leading-relaxed text-black/80 py-8 lg:py-12 px-8 lg:px-12 bg-gray-50/50 border-l-4 border-black shadow-inner">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </div>

            <div class="pt-10 lg:pt-16 flex flex-col sm:flex-row gap-4 lg:gap-8 relative z-10">
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}"
                    class="w-full sm:w-auto text-center bg-black text-white px-10 py-5 text-[10px] font-black uppercase tracking-[0.3em] hover:bg-gray-800 transition-all active:scale-95 shadow-premium">
                    Initiate Response
                </a>
                <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full sm:w-auto border-2 border-black/5 text-black/20 px-10 py-5 text-[10px] font-black uppercase tracking-[0.3em] hover:border-red-600 hover:text-red-600 transition-all active:scale-95"
                        onclick="return confirm('Delete permanently?')">Remove Record</button>
                </form>
            </div>
        </div>
    </div>
@endsection