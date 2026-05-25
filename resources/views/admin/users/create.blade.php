@extends('layouts.admin')

@section('header', 'Add New User')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8 lg:mb-12">
            <a href="{{ route('admin.users.index') }}"
                class="text-[10px] uppercase font-bold text-gray-400 hover:text-black transition-colors mb-4 inline-block">←
                Back to List</a>
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Add New User</h1>
            <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Create a new system administrator
                or user</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-12 lg:space-y-20 pb-20">
            @csrf

            <!-- User Identity -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">Basic Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12">
                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Full
                            Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all @error('name') border-red-500 @enderror"
                            placeholder="e.g. John Doe">
                        @error('name') <p class="text-[10px] text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Email
                            Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all @error('email') border-red-500 @enderror"
                            placeholder="john@example.com">
                        @error('email') <p class="text-[10px] text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            <!-- Password & Role -->
            <section class="space-y-6 lg:space-y-8">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold border-b border-black/5 pb-4">Security & Access
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-12">
                    <div class="space-y-2">
                        <label
                            class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Password</label>
                        <input type="password" name="password" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="••••••••">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="••••••••">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">System
                            Role</label>
                        <select name="role" required
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all">
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Full Access)</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Restricted Access)
                            </option>
                        </select>
                    </div>
                </div>
            </section>

            <div class="pt-8 lg:pt-12 border-t border-black/5">
                <button type="submit"
                    class="w-full sm:w-auto bg-black text-white px-10 lg:px-12 py-4 lg:py-5 text-[10px] lg:text-xs font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all shadow-xl active:scale-95">
                    Create User Account
                </button>
            </div>
        </form>
    </div>
@endsection