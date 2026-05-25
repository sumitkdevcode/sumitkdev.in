@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
    <div class="space-y-10">
        <!-- Welcome -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Welcome back, Admin!</h2>
            <p class="text-gray-500 text-sm mt-1">Here's what's happening with your portfolio today.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-[#1a1a1a] p-8 shadow-lg transition-transform hover:scale-[1.02]">
                <h3 class="text-5xl font-bold text-white mb-4">{{ $stats['projects_count'] }}</h3>
                <p class="text-sm text-gray-400 font-medium tracking-wide">Total Projects</p>
            </div>

            <div class="bg-[#2d2d2d] p-8 shadow-lg transition-transform hover:scale-[1.02]">
                <h3 class="text-5xl font-bold text-white mb-4">{{ $stats['featured_count'] }}</h3>
                <p class="text-sm text-gray-400 font-medium tracking-wide">Featured Items</p>
            </div>

            <div class="bg-[#3d3d3d] p-8 shadow-lg transition-transform hover:scale-[1.02]">
                <h3 class="text-5xl font-bold text-white mb-4">{{ $stats['posts_count'] }}</h3>
                <p class="text-sm text-gray-400 font-medium tracking-wide">Total blog Posts</p>
            </div>

            <div class="bg-[#4d4d4d] p-8 shadow-lg transition-transform hover:scale-[1.02]">
                <h3 class="text-5xl font-bold text-white mb-4">{{ $stats['messages_unread'] }}</h3>
                <p class="text-sm text-gray-400 font-medium tracking-wide">Unread Messages</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-6 font-primary">Quick Actions</h3>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.portfolio.create') }}"
                    class="bg-black text-white px-8 py-3 font-bold text-sm tracking-wide transition-all hover:bg-gray-800">
                    + Create Project
                </a>
                <a href="{{ route('admin.blog.create') }}"
                    class="bg-black text-white px-8 py-3 font-bold text-sm tracking-wide transition-all hover:bg-gray-800">
                    + Create Post
                </a>
                <a href="{{ route('admin.media.index') }}"
                    class="bg-black text-white px-8 py-3 font-bold text-sm tracking-wide transition-all hover:bg-gray-800">
                    Manage Media
                </a>
                <a href="{{ route('admin.contacts.index') }}"
                    class="bg-black text-white px-8 py-3 font-bold text-sm tracking-wide transition-all hover:bg-gray-800">
                    View Messages
                </a>
            </div>
        </div>

        <!-- System Table / Recent Items -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 pb-20">
            <div class="bg-white p-8 lg:p-12 border border-gray-100 shadow-sm transition-all hover:shadow-md">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400">Recent Inquiries</h3>
                    <a href="{{ route('admin.contacts.index') }}"
                        class="text-[9px] uppercase font-black hover:underline tracking-widest">See All</a>
                </div>
                <div class="space-y-6">
                    @forelse($recent_messages as $msg)
                        <div class="flex justify-between items-center group">
                            <div class="space-y-1">
                                <p class="text-sm font-black tracking-tight group-hover:text-black transition-colors">
                                    {{ $msg->name }}</p>
                                <p class="text-[10px] text-gray-400 font-medium tracking-wide uppercase">
                                    {{ $msg->created_at->diffForHumans() }}</p>
                            </div>
                            <a href="{{ route('admin.contacts.show', $msg->id) }}"
                                class="text-[9px] uppercase font-bold text-gray-300 hover:text-black border border-gray-100 hover:border-black px-4 py-2 transition-all">Review</a>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <p class="text-[10px] uppercase tracking-widest text-gray-300">Quiet for now.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white p-8 lg:p-12 border border-gray-100 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold text-gray-400 mb-10">System Core</h3>
                <div class="space-y-6 text-[10px] font-bold uppercase tracking-[0.2em]">
                    <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                        <span class="text-gray-300">Framework</span>
                        <span class="text-black">Laravel v{{ app()->version() }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                        <span class="text-gray-300">PHP Node</span>
                        <span class="text-black">{{ PHP_VERSION }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                        <span class="text-gray-300">Status</span>
                        <span class="text-black">Active / Ready</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Environment</span>
                        <span class="text-black flex items-center">
                            <span class="w-1.5 h-1.5 bg-black rounded-full mr-2"></span>
                            Production
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection