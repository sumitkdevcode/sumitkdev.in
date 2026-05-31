@extends('layouts.admin')

@section('header', 'Media Assets')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 lg:mb-12">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Media</h1>
            <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Manage your visual library</p>
        </div>
        <a href="{{ route('admin.media.create') }}"
            class="w-full sm:w-auto text-center bg-black text-white px-6 lg:px-8 py-3 lg:py-4 text-[10px] lg:text-xs font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
            Upload File
        </a>
    </div>

    @if($media->isEmpty())
        <div class="bg-white border border-black/5 py-40 text-center opacity-20 rounded-sm">
            <p class="text-2xl lg:text-3xl italic">No media assets found.</p>
        </div>
    @else
        <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 lg:gap-6">
            @foreach($media as $item)
                <div class="group bg-white border border-black/5 overflow-hidden shadow-sm flex flex-col">
                    <div class="aspect-square relative flex items-center justify-center bg-gray-50 flex-shrink-0">
                        @if($item->file_type === 'video')
                            <div class="absolute inset-0 flex items-center justify-center bg-black/5 z-10 pointer-events-none">
                                <svg class="w-8 h-8 text-black opacity-20" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"></path>
                                </svg>
                            </div>
                        @endif
                        <img src="{{ asset('storage/' . $item->file_path) }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105 {{ $item->file_type === 'video' ? 'opacity-50' : '' }}" alt="">

                        <!-- Desktop Overlay (Hover) -->
                        <div class="hidden lg:flex absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-opacity flex-col justify-center items-center p-6 text-center space-y-4">
                            <p class="text-[8px] uppercase tracking-widest text-gray-400 font-bold">{{ $item->mime_type }}</p>
                            <p class="text-[8px] uppercase tracking-widest text-gray-400 font-bold">{{ $item->file_size }} KB</p>
                            <div class="flex items-center gap-4">
                                <a href="{{ route('admin.media.edit', $item->id) }}" class="text-[10px] font-bold uppercase text-white hover:underline">Edit</a>
                                <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] font-bold uppercase text-red-500 hover:underline"
                                        onclick="return confirm('Delete permanently?')">Remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info for both Desktop and Mobile -->
                    <div class="p-3 lg:p-4 border-t border-black/5 bg-white mt-auto">
                        <p class="text-[9px] lg:text-[10px] font-bold truncate uppercase tracking-tighter mb-2">{{ $item->title }}</p>
                        <!-- Mobile Actions (visible only on smaller screens) -->
                        <div class="flex lg:hidden justify-between items-center">
                             <p class="text-[8px] uppercase tracking-widest text-gray-400">{{ $item->file_size }} KB</p>
                             <div class="flex gap-3">
                                 <a href="{{ route('admin.media.edit', $item->id) }}" class="text-[9px] font-bold uppercase text-black">Edit</a>
                                 <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[9px] font-bold uppercase text-red-500"
                                        onclick="return confirm('Delete permanently?')">Delete</button>
                                </form>
                             </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($media->hasPages())
            <div class="mt-8 lg:mt-12">
                {{ $media->links() }}
            </div>
        @endif
    @endif
@endsection