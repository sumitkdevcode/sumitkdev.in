@extends('layouts.admin')

@section('header', 'Inbox')

@section('content')
    <div class="mb-8 lg:mb-12">
        <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Messages</h1>
        <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Inquiries from your portfolio</p>
    </div>

    <div class="bg-white border border-black/5 rounded-sm shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[700px]">
                <thead>
                    <tr class="border-b border-black/5 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">
                        <th class="px-6 lg:px-8 py-4 lg:py-6 whitespace-nowrap">Status</th>
                        <th class="px-6 lg:px-8 py-4 lg:py-6">Sender</th>
                        <th class="px-6 lg:px-8 py-4 lg:py-6">Subject</th>
                        <th class="px-6 lg:px-8 py-4 lg:py-6 whitespace-nowrap">Received</th>
                        <th class="px-6 lg:px-8 py-4 lg:py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5" data-infinite-scroll-container>
                    @forelse($messages as $msg)
                        <tr
                            class="group hover:bg-gray-50 transition-colors {{ !$msg->is_read ? 'font-bold bg-black/[0.02]' : '' }}">
                            <td class="px-6 lg:px-8 py-4 lg:py-6">
                                @if(!$msg->is_read)
                                    <span
                                        class="inline-block px-2 py-0.5 bg-black text-white text-[7px] lg:text-[8px] uppercase tracking-widest">New</span>
                                @else
                                    <span
                                        class="inline-block px-2 py-0.5 bg-gray-100 text-gray-400 text-[7px] lg:text-[8px] uppercase tracking-widest">Read</span>
                                @endif
                            </td>
                            <td class="px-6 lg:px-8 py-4 lg:py-6">
                                <p class="text-xs lg:text-sm truncate">{{ $msg->name }}</p>
                                <p class="text-[9px] lg:text-[10px] text-gray-400 truncate">{{ $msg->email }}</p>
                            </td>
                            <td class="px-6 lg:px-8 py-4 lg:py-6 text-xs lg:text-sm truncate max-w-xs">
                                {{ $msg->subject ?: 'No Subject' }}
                            </td>
                            <td
                                class="px-6 lg:px-8 py-4 lg:py-6 text-[9px] lg:text-[10px] uppercase tracking-widest text-gray-400">
                                {{ $msg->created_at->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 lg:px-8 py-4 lg:py-6 text-right space-x-2 lg:space-x-4 whitespace-nowrap">
                                <a href="{{ route('admin.contacts.show', $msg->id) }}"
                                    class="text-[9px] lg:text-[10px] font-bold uppercase hover:underline">View</a>
                                <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-[9px] lg:text-[10px] font-bold uppercase text-red-600 hover:underline"
                                        onclick="return confirm('Delete this inquiry?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-6 lg:px-8 py-20 text-center text-[10px] lg:text-xs text-gray-400 uppercase tracking-widest">
                                Inbox is
                                empty.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="px-6 lg:px-8 py-4 lg:py-6 border-t border-black/5" data-pagination-wrapper>
                {{ $messages->links() }}
            </div>
            <div data-next-page-url="{{ $messages->nextPageUrl() }}"></div>
        @endif
    </div>
@endsection