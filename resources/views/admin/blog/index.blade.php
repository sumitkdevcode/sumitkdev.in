@extends('layouts.admin')

@section('header', 'Journal Management')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-12">
        <div>
            <h1 class="text-3xl lg:text-4xl font-black tracking-tighter">Journal</h1>
            <p class="text-[9px] lg:text-[10px] text-gray-400 uppercase tracking-[0.4em] mt-2">Editorial Control & Insights</p>
        </div>
        <a href="{{ route('admin.blog.create') }}"
            class="w-full sm:w-auto text-center bg-black text-white px-10 py-4 text-[10px] font-black uppercase tracking-[0.2em] shadow-premium hover:bg-gray-800 transition-all active:scale-95">
            Create Entry
        </a>
    </div>

    <div class="bg-white border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[800px]">
                <thead>
                    <tr class="border-b border-gray-50 text-[9px] uppercase tracking-[0.3em] font-black text-gray-400">
                        <th class="px-8 lg:px-10 py-6">Article Description</th>
                        <th class="px-8 lg:px-10 py-6">Classification</th>
                        <th class="px-8 lg:px-10 py-6 whitespace-nowrap text-center">Visibility</th>
                        <th class="px-8 lg:px-10 py-6 text-right">Utility</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50" data-infinite-scroll-container>
                    @forelse($posts as $post)
                        <tr class="group hover:bg-gray-50/50 transition-all">
                            <td class="px-8 lg:px-10 py-6">
                                <div class="flex items-center space-x-6">
                                     @if($post->featured_image)
                                         <div class="relative group/img">
                                             <img src="{{ $post->getImageUrl() }}" class="w-12 h-12 object-cover" alt="">
                                             <div class="absolute inset-0 border border-black/5"></div>
                                         </div>
                                     @else
                                         <div class="w-12 h-12 bg-gray-50 flex items-center justify-center text-[8px] text-gray-300 font-black uppercase tracking-widest border border-gray-100">
                                             None</div>
                                     @endif
                                     <div class="min-w-0">
                                         <p class="text-sm font-black tracking-tight group-hover:text-black transition-colors truncate">{{ $post->title }}</p>
                                         <div class="flex items-center space-x-3 mt-1">
                                             <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest">{{ $post->reading_time }}m read</p>
                                             <span class="w-1 h-1 rounded-full bg-gray-200"></span>
                                             <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest">
                                                 {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Temporal Draft' }}
                                             </p>
                                         </div>
                                     </div>
                                 </div>
                             </td>
                             <td class="px-8 lg:px-10 py-6 text-[9px] font-black uppercase tracking-[0.2em] text-gray-400">
                                 {{ $post->category ?: 'General' }}
                             </td>
                             <td class="px-8 lg:px-10 py-6">
                                 <div class="flex items-center justify-center">
                                     @if($post->is_published)
                                         <div class="flex items-center space-x-2 bg-black text-white px-3 py-1 scale-90">
                                             <span class="w-1 h-1 bg-white animate-pulse"></span>
                                             <span class="text-[8px] uppercase font-black tracking-[0.2em]">Live</span>
                                         </div>
                                     @else
                                         <div class="flex items-center space-x-2 bg-gray-100 text-gray-400 px-3 py-1 scale-90">
                                             <span class="w-1 h-1 bg-gray-300"></span>
                                             <span class="text-[8px] uppercase font-black tracking-[0.2em]">Draft</span>
                                         </div>
                                     @endif
                                 </div>
                             </td>
                             <td class="px-8 lg:px-10 py-6 text-right space-x-4 whitespace-nowrap">
                                 <a href="{{ route('admin.blog.edit', $post->id) }}"
                                     class="text-[9px] font-black uppercase tracking-widest hover:text-black transition-colors underline decoration-transparent hover:decoration-black underline-offset-4">Edit</a>
                                 <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST" class="inline-block">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="text-[9px] font-black uppercase tracking-widest text-red-600 hover:text-red-700 transition-colors"
                                         onclick="return confirm('Archive this entry?')">Delete</button>
                                 </form>
                             </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 lg:px-8 py-20 text-center text-[10px] lg:text-xs text-gray-400 uppercase tracking-widest">No blog
                                posts yet. Start writing.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="px-6 lg:px-8 py-4 lg:py-6 border-t border-black/5" data-pagination-wrapper>
                {{ $posts->links() }}
            </div>
            <div data-next-page-url="{{ $posts->nextPageUrl() }}"></div>
        @endif
    </div>
@endsection