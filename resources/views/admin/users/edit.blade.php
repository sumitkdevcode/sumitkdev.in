@extends('layouts.admin')

@section('header', 'Edit User: ' . $user->name)

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 lg:mb-12">
            <a href="{{ route('admin.users.index') }}"
                class="text-[10px] uppercase font-bold text-gray-400 hover:text-black transition-colors mb-4 inline-block">←
                Back to List</a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Edit User</h1>
            <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Update portal access for <span
                    class="text-black font-bold">{{ $user->email }}</span></p>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-12 lg:space-y-20 pb-20">
            @csrf
            @method('PUT')

            <!-- User Identity -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">Basic Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12">
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Full
                            Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all @error('name') border-red-500 @enderror">
                        @error('name') <p class="text-[10px] text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Email
                            Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all @error('email') border-red-500 @enderror">
                        @error('email') <p class="text-[10px] text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            <!-- Password & Role -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">Security & Access
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12">
                    <div class="col-span-1 md:col-span-2">
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-4">Leave password fields empty to
                            keep the current password.</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">New
                            Password</label>
                        <input type="password" name="password"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="••••••••">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Confirm
                            New Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="••••••••">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">System
                            Role</label>
                        <select name="role" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all">
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin (Full
                                Access)</option>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User (Restricted
                                Access)</option>
                        </select>
                    </div>
                </div>
            </section>

            <div class="pt-8 lg:pt-12 border-t border-black/5">
                <button type="submit"
                    class="w-full sm:w-auto bg-black text-white px-10 lg:px-12 py-4 lg:py-5 text-[10px] lg:text-xs font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    Update User Account
                </button>
            </div>
        </form>
    </div>
@endsection