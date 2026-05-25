@extends('layouts.admin')

@section('header', 'Manage Admins')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="mb-8 lg:mb-12 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">User Management</h1>
                <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Manage system administrators
                    and users</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="bg-black text-white px-6 py-3 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">
                Add New User +
            </a>
        </div>

        @if(session('success'))
            <div class="bg-black text-white p-4 mb-8 text-[10px] uppercase tracking-widest">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 mb-8 text-[10px] uppercase tracking-widest">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white border border-gray-100 shadow-sm overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Name</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Email</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Role</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Joined</th>
                        <th class="px-6 py-4 text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-900">{{ $user->name }}</span>
                                @if(auth()->id() === $user->id)
                                    <span
                                        class="ml-2 text-[9px] bg-gray-100 px-2 py-0.5 uppercase tracking-widest text-gray-500">You</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-[10px] font-medium text-gray-400">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="text-[10px] uppercase tracking-widest font-bold {{ $user->role === 'admin' ? 'text-black' : 'text-gray-400' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-[10px] text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="text-[9px] uppercase font-bold text-black border border-black/20 px-3 py-1.5 hover:border-black transition-all">
                                        Edit
                                    </a>

                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this user? This cannot be undone.');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-[9px] uppercase font-bold text-red-500 border border-red-100 px-3 py-1.5 hover:bg-red-50 transition-all">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection