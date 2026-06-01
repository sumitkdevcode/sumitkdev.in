@extends('layouts.admin')

@section('header', 'Social Links Management')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 lg:mb-12 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Social Links & Profiles</h1>
                <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Manage external links and profiles</p>
            </div>
            <a href="{{ route('admin.social-links.create') }}"
                class="bg-black text-white px-6 py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">
                Add New Link +
            </a>
        </div>

        @if(session('success'))
            <div class="bg-black text-white p-4 mb-8 text-[10px] uppercase tracking-widest">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-gray-100 shadow-sm overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Order</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Platform</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Category</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">URL / Handle</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Status</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50" data-infinite-scroll-container>
                    @foreach($links as $link)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-[10px] font-medium text-gray-400 font-mono">{{ $link->order }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 text-black flex items-center justify-center">
                                        {!! $link->icon_svg !!}
                                    </div>
                                    <span class="text-sm font-bold text-gray-900">{{ $link->platform_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[10px] font-medium text-gray-400 font-mono">{{ $link->category }}</td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-gray-600 truncate max-w-[200px] block">
                                    <a href="{{ $link->url }}" target="_blank" class="hover:underline">{{ $link->url }}</a>
                                </span>
                                @if($link->handle)
                                <span class="text-[10px] text-gray-400 font-mono">{{ $link->handle }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($link->is_active)
                                    <span class="bg-green-100 text-green-800 text-[9px] uppercase font-bold px-2 py-1">Active</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-[9px] uppercase font-bold px-2 py-1">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('admin.social-links.edit', $link->id) }}"
                                        class="text-[9px] uppercase font-bold text-black border border-black/20 px-3 py-1.5 hover:border-black transition-all">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.social-links.destroy', $link->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this link?');" class="inline">
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
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($links->hasPages())
            <div class="px-6 lg:px-8 py-4 lg:py-6" data-pagination-wrapper>
                {{ $links->links() }}
            </div>
            <div data-next-page-url="{{ $links->nextPageUrl() }}"></div>
        @endif
    </div>
@endsection
