@extends('layouts.admin')

@section('header', 'Portfolio Management')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 lg:mb-12">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Work</h1>
            <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Manage your project showcase</p>
        </div>
        <a href="{{ route('admin.portfolio.create') }}"
            class="w-full sm:w-auto text-center bg-black text-white px-6 lg:px-8 py-3 lg:py-4 text-[10px] lg:text-xs font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
            Add New Project
        </a>
    </div>

    <div class="bg-white border border-black/5 rounded-sm shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[600px]">
                <thead>
                    <tr class="border-b border-black/5 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">
                        <th class="px-6 lg:px-8 py-4 lg:py-6">Project</th>
                        <th class="px-6 lg:px-8 py-4 lg:py-6">Category</th>
                        <th class="px-6 lg:px-8 py-4 lg:py-6">Visibility</th>
                        <th class="px-6 lg:px-8 py-4 lg:py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black/5">
                    @forelse($items as $item)
                        <tr class="group hover:bg-gray-50 transition-colors">
                            <td class="px-6 lg:px-8 py-4 lg:py-6">
                                <div class="flex items-center space-x-4">
                                    @if($item->featured_image)
                                        <img src="{{ asset('storage/' . $item->featured_image) }}" class="w-10 h-10 lg:w-12 lg:h-12 object-cover rounded-sm"
                                            alt="">
                                    @else
                                        <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gray-100 flex items-center justify-center text-[10px] text-gray-400">
                                            N/A</div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold truncate">{{ $item->title }}</p>
                                        <p class="text-[9px] lg:text-[10px] text-gray-400 uppercase tracking-tighter truncate">{{ $item->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 lg:px-8 py-4 lg:py-6 text-[10px] lg:text-xs uppercase tracking-widest text-gray-500">
                                {{ $item->category ?: 'General' }}
                            </td>
                            <td class="px-6 lg:px-8 py-4 lg:py-6">
                                <div class="flex items-center">
                                    @if($item->is_published)
                                        <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                                        <span class="text-[9px] lg:text-[10px] uppercase font-bold ml-2">Live</span>
                                    @else
                                        <span class="inline-block w-2 h-2 rounded-full bg-gray-200"></span>
                                        <span class="text-[9px] lg:text-[10px] uppercase font-bold ml-2 text-gray-400">Draft</span>
                                    @endif
                                    
                                    @if($item->is_featured)
                                        <span class="ml-4 text-black">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 lg:px-8 py-4 lg:py-6 text-right space-x-2 lg:space-x-4 whitespace-nowrap">
                                <a href="{{ route('admin.portfolio.edit', $item->id) }}"
                                    class="text-[9px] lg:text-[10px] font-bold uppercase hover:underline">Edit</a>
                                <form action="{{ route('admin.portfolio.destroy', $item->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[9px] lg:text-[10px] font-bold uppercase text-red-600 hover:underline"
                                        onclick="return confirm('Archive this project?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 lg:px-8 py-20 text-center text-[10px] lg:text-xs text-gray-400 uppercase tracking-widest">No
                                projects found. Launch your first project.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
            <div class="px-6 lg:px-8 py-4 lg:py-6 border-t border-black/5">
                {{ $items->links() }}
            </div>
        @endif
    </div>
@endsection