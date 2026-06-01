@extends('layouts.admin')

@section('header', 'SEO Management')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 lg:mb-12 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">SEO Management</h1>
                <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Manage meta tags for all your
                    portal pages</p>
            </div>
            <a href="{{ route('admin.seo.create') }}"
                class="bg-black text-white px-6 py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">
                Add New Page Link +
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
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Page Name</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Path</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Title Preview
                        </th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50" data-infinite-scroll-container>
                    @foreach($seos as $seo)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-900">{{ $seo->page_name }}</span>
                            </td>
                            <td class="px-6 py-4 text-[10px] font-medium text-gray-400 font-mono">{{ $seo->page_path }}</td>
                            <td class="px-6 py-4">
                                <span class="text-xs text-gray-600 truncate max-w-[200px] block">
                                    {{ $seo->meta_title ?: 'Not Set' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('admin.seo.edit', $seo->id) }}"
                                        class="text-[9px] uppercase font-bold text-black border border-black/20 px-3 py-1.5 hover:border-black transition-all">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.seo.destroy', $seo->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this SEO entry?');" class="inline">
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
        
        @if($seos->hasPages())
            <div class="px-6 lg:px-8 py-4 lg:py-6" data-pagination-wrapper>
                {{ $seos->links() }}
            </div>
            <div data-next-page-url="{{ $seos->nextPageUrl() }}"></div>
        @endif
    </div>
@endsection