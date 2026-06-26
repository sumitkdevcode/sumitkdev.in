@extends('layouts.admin')

@section('header', 'Resume Management')

@section('content')
    <div class="max-w-5xl mx-auto pb-20">
        <div class="mb-8 lg:mb-12">
            <h1 class="text-2xl lg:text-3xl font-bold tracking-tight">Resume / CV</h1>
            <p class="text-[10px] lg:text-xs text-gray-500 uppercase tracking-widest mt-1">Manage your resume content — all
                changes reflect on the public resume page</p>
            <a href="{{ route('resume') }}" target="_blank"
                class="inline-block mt-3 text-[10px] font-bold uppercase tracking-widest text-indigo-600 hover:underline">
                View Public Resume →
            </a>
        </div>

        {{-- ═══════════════════════════════════════════════════════
             RESUME SETTINGS (Summary & Title)
             ═══════════════════════════════════════════════════════ --}}
        <section class="mb-12" x-data="{ open: true }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between text-left border-b border-black/5 pb-4 mb-6">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold">Resume Header & Summary</h3>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-collapse>
                <form action="{{ route('admin.resume.settings') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label
                            class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Resume
                            Title / Role</label>
                        <input type="text" name="resume_title" value="{{ $resumeTitle }}"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all"
                            placeholder="e.g. Software Engineer">
                    </div>
                    <div class="space-y-2">
                        <label
                            class="text-[9px] lg:text-[10px] uppercase tracking-widest font-bold text-gray-400">Summary
                            Paragraph</label>
                        <textarea name="resume_summary" rows="4"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-4 text-sm outline-none transition-all resize-none"
                            placeholder="Write your professional summary...">{{ $resumeSummary }}</textarea>
                    </div>
                    <button type="submit"
                        class="bg-black text-white px-8 py-3 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
                        Save Settings
                    </button>
                </form>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════
             WORK EXPERIENCE
             ═══════════════════════════════════════════════════════ --}}
        <section class="mb-12" x-data="{ open: true, showForm: false, editId: null }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between text-left border-b border-black/5 pb-4 mb-6">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold">Work Experience
                    <span class="text-gray-400 ml-2">({{ $experiences->count() }})</span>
                </h3>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-collapse>
                {{-- Existing entries --}}
                <div class="space-y-4 mb-6">
                    @foreach ($experiences as $exp)
                        <div class="bg-white border border-black/5 rounded-sm p-6" x-data="{ editing: false }">
                            <div x-show="!editing">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm font-bold">{{ $exp->title }}</p>
                                        <p class="text-[10px] text-gray-500 uppercase tracking-widest">
                                            {{ $exp->company }} | {{ $exp->start_date }} –
                                            {{ $exp->end_date ?? 'Present' }}</p>
                                        @if ($exp->bullets)
                                            <ul class="mt-3 text-xs text-gray-600 list-disc pl-4 space-y-1">
                                                @foreach ($exp->bullets as $bullet)
                                                    <li>{{ $bullet }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-3 ml-4 flex-shrink-0">
                                        @if (!$exp->is_visible)
                                            <span
                                                class="text-[9px] uppercase font-bold text-gray-400 tracking-widest">Hidden</span>
                                        @endif
                                        <span
                                            class="text-[9px] uppercase font-bold text-gray-300">{{ $exp->order }}</span>
                                        <button @click="editing = true"
                                            class="text-[9px] font-bold uppercase hover:underline">Edit</button>
                                        <form
                                            action="{{ route('admin.resume.experience.destroy', $exp->id) }}"
                                            method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-[9px] font-bold uppercase text-red-600 hover:underline"
                                                onclick="return confirm('Delete this experience?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Inline Edit Form --}}
                            <form x-show="editing"
                                action="{{ route('admin.resume.experience.update', $exp->id) }}"
                                method="POST" class="space-y-4">
                                @csrf @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="title" value="{{ $exp->title }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Job Title" required>
                                    <input type="text" name="company" value="{{ $exp->company }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Company" required>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <input type="text" name="location" value="{{ $exp->location }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Location">
                                    <input type="text" name="start_date" value="{{ $exp->start_date }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Start Date" required>
                                    <input type="text" name="end_date" value="{{ $exp->end_date }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="End Date (or Present)">
                                </div>
                                <textarea name="bullets" rows="5"
                                    class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none resize-none"
                                    placeholder="One bullet point per line">{{ $exp->bullets ? implode("\n", $exp->bullets) : '' }}</textarea>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                                    <div>
                                        <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                                        <input type="number" name="order" value="{{ $exp->order }}"
                                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                                    </div>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="is_visible" {{ $exp->is_visible ? 'checked' : '' }}
                                            class="rounded">
                                        <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                                    </label>
                                </div>
                                <div class="flex gap-3">
                                    <button type="submit"
                                        class="bg-black text-white px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
                                        Update
                                    </button>
                                    <button type="button" @click="editing = false"
                                        class="px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] border border-black/10 hover:bg-gray-50 transition-all">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>

                {{-- Add New Form --}}
                <button @click="showForm = !showForm"
                    class="text-[10px] font-bold uppercase tracking-[0.2em] hover:underline mb-4">
                    <span x-text="showForm ? '− Cancel' : '+ Add Experience'"></span>
                </button>

                <form x-show="showForm" action="{{ route('admin.resume.experience.store') }}" method="POST"
                    class="bg-white border border-black/5 rounded-sm p-6 space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="title"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Job Title" required>
                        <input type="text" name="company"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Company" required>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="location"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Location">
                        <input type="text" name="start_date"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Start Date (e.g. February 2025)" required>
                        <input type="text" name="end_date"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="End Date (or Present)">
                    </div>
                    <textarea name="bullets" rows="5"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none resize-none"
                        placeholder="One bullet point per line"></textarea>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                        <div>
                            <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                            <input type="number" name="order" value="0"
                                class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_visible" checked class="rounded">
                            <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                        </label>
                    </div>
                    <button type="submit"
                        class="bg-black text-white px-8 py-3 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
                        Add Experience
                    </button>
                </form>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════
             TECHNICAL SKILLS
             ═══════════════════════════════════════════════════════ --}}
        <section class="mb-12" x-data="{ open: true, showForm: false }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between text-left border-b border-black/5 pb-4 mb-6">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold">Technical Skills
                    <span class="text-gray-400 ml-2">({{ $skills->count() }} categories)</span>
                </h3>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-collapse>
                <div class="space-y-4 mb-6">
                    @foreach ($skills as $skill)
                        <div class="bg-white border border-black/5 rounded-sm p-6" x-data="{ editing: false }">
                            <div x-show="!editing">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm font-bold">{{ $skill->category }}</p>
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @foreach ($skill->skills as $tag)
                                                <span
                                                    class="text-[10px] bg-gray-100 px-3 py-1 rounded-full font-medium">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 ml-4 flex-shrink-0">
                                        @if (!$skill->is_visible)
                                            <span class="text-[9px] uppercase font-bold text-gray-400 tracking-widest">Hidden</span>
                                        @endif
                                        <span class="text-[9px] uppercase font-bold text-gray-300">{{ $skill->order }}</span>
                                        <button @click="editing = true"
                                            class="text-[9px] font-bold uppercase hover:underline">Edit</button>
                                        <form action="{{ route('admin.resume.skill.destroy', $skill->id) }}"
                                            method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-[9px] font-bold uppercase text-red-600 hover:underline"
                                                onclick="return confirm('Delete this skill category?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <form x-show="editing"
                                action="{{ route('admin.resume.skill.update', $skill->id) }}"
                                method="POST" class="space-y-4">
                                @csrf @method('PUT')
                                <input type="text" name="category" value="{{ $skill->category }}"
                                    class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                    placeholder="Category Name" required>
                                <textarea name="skills" rows="2"
                                    class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none resize-none"
                                    placeholder="Comma-separated skills (e.g. HTML5, CSS3, React)">{{ implode(', ', $skill->skills) }}</textarea>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                                    <div>
                                        <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                                        <input type="number" name="order" value="{{ $skill->order }}"
                                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                                    </div>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="is_visible" {{ $skill->is_visible ? 'checked' : '' }} class="rounded">
                                        <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                                    </label>
                                </div>
                                <div class="flex gap-3">
                                    <button type="submit"
                                        class="bg-black text-white px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">Update</button>
                                    <button type="button" @click="editing = false"
                                        class="px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] border border-black/10 hover:bg-gray-50 transition-all">Cancel</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>

                <button @click="showForm = !showForm"
                    class="text-[10px] font-bold uppercase tracking-[0.2em] hover:underline mb-4">
                    <span x-text="showForm ? '− Cancel' : '+ Add Skill Category'"></span>
                </button>

                <form x-show="showForm" action="{{ route('admin.resume.skill.store') }}" method="POST"
                    class="bg-white border border-black/5 rounded-sm p-6 space-y-4">
                    @csrf
                    <input type="text" name="category"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                        placeholder="Category Name (e.g. Languages, Frontend)" required>
                    <textarea name="skills" rows="2"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none resize-none"
                        placeholder="Comma-separated skills (e.g. HTML5, CSS3, React)" required></textarea>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                        <div>
                            <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                            <input type="number" name="order" value="0"
                                class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_visible" checked class="rounded">
                            <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                        </label>
                    </div>
                    <button type="submit"
                        class="bg-black text-white px-8 py-3 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
                        Add Skill Category
                    </button>
                </form>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════
             PROJECTS
             ═══════════════════════════════════════════════════════ --}}
        <section class="mb-12" x-data="{ open: true, showForm: false }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between text-left border-b border-black/5 pb-4 mb-6">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold">Projects
                    <span class="text-gray-400 ml-2">({{ $projects->count() }})</span>
                </h3>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-collapse>
                <div class="space-y-4 mb-6">
                    @foreach ($projects as $project)
                        <div class="bg-white border border-black/5 rounded-sm p-6" x-data="{ editing: false }">
                            <div x-show="!editing">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm font-bold">{{ $project->title }}
                                            @if ($project->subtitle)
                                                <span class="text-gray-400 font-normal">({{ $project->subtitle }})</span>
                                            @endif
                                        </p>
                                        @if ($project->technologies)
                                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1">{{ $project->technologies }}</p>
                                        @endif
                                        @if ($project->bullets)
                                            <ul class="mt-3 text-xs text-gray-600 list-disc pl-4 space-y-1">
                                                @foreach ($project->bullets as $bullet)
                                                    <li>{{ $bullet }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-3 ml-4 flex-shrink-0">
                                        @if (!$project->is_visible)
                                            <span class="text-[9px] uppercase font-bold text-gray-400 tracking-widest">Hidden</span>
                                        @endif
                                        <span class="text-[9px] uppercase font-bold text-gray-300">{{ $project->order }}</span>
                                        <button @click="editing = true"
                                            class="text-[9px] font-bold uppercase hover:underline">Edit</button>
                                        <form action="{{ route('admin.resume.project.destroy', $project->id) }}"
                                            method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-[9px] font-bold uppercase text-red-600 hover:underline"
                                                onclick="return confirm('Delete this project?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <form x-show="editing"
                                action="{{ route('admin.resume.project.update', $project->id) }}"
                                method="POST" class="space-y-4">
                                @csrf @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="title" value="{{ $project->title }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Project Title" required>
                                    <input type="text" name="subtitle" value="{{ $project->subtitle }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Subtitle (e.g. MCA - Major Project)">
                                </div>
                                <input type="text" name="technologies" value="{{ $project->technologies }}"
                                    class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                    placeholder="Technologies (e.g. HTML, CSS, JavaScript, PHP)">
                                <textarea name="bullets" rows="4"
                                    class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none resize-none"
                                    placeholder="One bullet point per line">{{ $project->bullets ? implode("\n", $project->bullets) : '' }}</textarea>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                                    <div>
                                        <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                                        <input type="number" name="order" value="{{ $project->order }}"
                                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                                    </div>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="is_visible" {{ $project->is_visible ? 'checked' : '' }} class="rounded">
                                        <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                                    </label>
                                </div>
                                <div class="flex gap-3">
                                    <button type="submit"
                                        class="bg-black text-white px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">Update</button>
                                    <button type="button" @click="editing = false"
                                        class="px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] border border-black/10 hover:bg-gray-50 transition-all">Cancel</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>

                <button @click="showForm = !showForm"
                    class="text-[10px] font-bold uppercase tracking-[0.2em] hover:underline mb-4">
                    <span x-text="showForm ? '− Cancel' : '+ Add Project'"></span>
                </button>

                <form x-show="showForm" action="{{ route('admin.resume.project.store') }}" method="POST"
                    class="bg-white border border-black/5 rounded-sm p-6 space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="title"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Project Title" required>
                        <input type="text" name="subtitle"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Subtitle (e.g. MCA - Major Project)">
                    </div>
                    <input type="text" name="technologies"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                        placeholder="Technologies (e.g. HTML, CSS, JavaScript, PHP)">
                    <textarea name="bullets" rows="4"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none resize-none"
                        placeholder="One bullet point per line"></textarea>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                        <div>
                            <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                            <input type="number" name="order" value="0"
                                class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_visible" checked class="rounded">
                            <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                        </label>
                    </div>
                    <button type="submit"
                        class="bg-black text-white px-8 py-3 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
                        Add Project
                    </button>
                </form>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════
             CERTIFICATES
             ═══════════════════════════════════════════════════════ --}}
        <section class="mb-12" x-data="{ open: true, showForm: false }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between text-left border-b border-black/5 pb-4 mb-6">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold">Certificates
                    <span class="text-gray-400 ml-2">({{ $certificates->count() }})</span>
                </h3>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-collapse>
                <div class="space-y-4 mb-6">
                    @foreach ($certificates as $cert)
                        <div class="bg-white border border-black/5 rounded-sm p-6" x-data="{ editing: false }">
                            <div x-show="!editing">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-bold">{{ $cert->title }}
                                            @if ($cert->issuer)
                                                <span class="text-gray-400 font-normal">— {{ $cert->issuer }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-3 ml-4 flex-shrink-0">
                                        @if (!$cert->is_visible)
                                            <span class="text-[9px] uppercase font-bold text-gray-400 tracking-widest">Hidden</span>
                                        @endif
                                        <button @click="editing = true"
                                            class="text-[9px] font-bold uppercase hover:underline">Edit</button>
                                        <form action="{{ route('admin.resume.certificate.destroy', $cert->id) }}"
                                            method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-[9px] font-bold uppercase text-red-600 hover:underline"
                                                onclick="return confirm('Delete?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <form x-show="editing"
                                action="{{ route('admin.resume.certificate.update', $cert->id) }}"
                                method="POST" class="space-y-4">
                                @csrf @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="title" value="{{ $cert->title }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Certificate Title" required>
                                    <input type="text" name="issuer" value="{{ $cert->issuer }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Issuer (e.g. Hackerrank)">
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                                    <div>
                                        <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                                        <input type="number" name="order" value="{{ $cert->order }}"
                                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                                    </div>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="is_visible" {{ $cert->is_visible ? 'checked' : '' }} class="rounded">
                                        <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                                    </label>
                                </div>
                                <div class="flex gap-3">
                                    <button type="submit"
                                        class="bg-black text-white px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">Update</button>
                                    <button type="button" @click="editing = false"
                                        class="px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] border border-black/10 hover:bg-gray-50 transition-all">Cancel</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>

                <button @click="showForm = !showForm"
                    class="text-[10px] font-bold uppercase tracking-[0.2em] hover:underline mb-4">
                    <span x-text="showForm ? '− Cancel' : '+ Add Certificate'"></span>
                </button>

                <form x-show="showForm" action="{{ route('admin.resume.certificate.store') }}" method="POST"
                    class="bg-white border border-black/5 rounded-sm p-6 space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="title"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Certificate Title" required>
                        <input type="text" name="issuer"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Issuer (e.g. Hackerrank)">
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                        <div>
                            <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                            <input type="number" name="order" value="0"
                                class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_visible" checked class="rounded">
                            <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                        </label>
                    </div>
                    <button type="submit"
                        class="bg-black text-white px-8 py-3 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
                        Add Certificate
                    </button>
                </form>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════
             TRAININGS
             ═══════════════════════════════════════════════════════ --}}
        <section class="mb-12" x-data="{ open: true, showForm: false }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between text-left border-b border-black/5 pb-4 mb-6">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold">Trainings
                    <span class="text-gray-400 ml-2">({{ $trainings->count() }})</span>
                </h3>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-collapse>
                <div class="space-y-4 mb-6">
                    @foreach ($trainings as $training)
                        <div class="bg-white border border-black/5 rounded-sm p-6" x-data="{ editing: false }">
                            <div x-show="!editing">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-sm font-bold">{{ $training->title }}</p>
                                        <p class="text-[10px] text-gray-500 uppercase tracking-widest">
                                            {{ $training->organization }}
                                            @if ($training->date_range)
                                                | {{ $training->date_range }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-3 ml-4 flex-shrink-0">
                                        @if (!$training->is_visible)
                                            <span class="text-[9px] uppercase font-bold text-gray-400 tracking-widest">Hidden</span>
                                        @endif
                                        <button @click="editing = true"
                                            class="text-[9px] font-bold uppercase hover:underline">Edit</button>
                                        <form action="{{ route('admin.resume.training.destroy', $training->id) }}"
                                            method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-[9px] font-bold uppercase text-red-600 hover:underline"
                                                onclick="return confirm('Delete?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <form x-show="editing"
                                action="{{ route('admin.resume.training.update', $training->id) }}"
                                method="POST" class="space-y-4">
                                @csrf @method('PUT')
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="title" value="{{ $training->title }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Training Title" required>
                                    <input type="text" name="organization"
                                        value="{{ $training->organization }}"
                                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                        placeholder="Organization" required>
                                </div>
                                <input type="text" name="date_range" value="{{ $training->date_range }}"
                                    class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                    placeholder="Date Range (e.g. March 2023 – July 2023)">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                                    <div>
                                        <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                                        <input type="number" name="order" value="{{ $training->order }}"
                                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                                    </div>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" name="is_visible" {{ $training->is_visible ? 'checked' : '' }} class="rounded">
                                        <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                                    </label>
                                </div>
                                <div class="flex gap-3">
                                    <button type="submit"
                                        class="bg-black text-white px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">Update</button>
                                    <button type="button" @click="editing = false"
                                        class="px-6 py-2 text-[10px] font-bold uppercase tracking-[0.2em] border border-black/10 hover:bg-gray-50 transition-all">Cancel</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>

                <button @click="showForm = !showForm"
                    class="text-[10px] font-bold uppercase tracking-[0.2em] hover:underline mb-4">
                    <span x-text="showForm ? '− Cancel' : '+ Add Training'"></span>
                </button>

                <form x-show="showForm" action="{{ route('admin.resume.training.store') }}" method="POST"
                    class="bg-white border border-black/5 rounded-sm p-6 space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="title"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Training Title" required>
                        <input type="text" name="organization"
                            class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                            placeholder="Organization" required>
                    </div>
                    <input type="text" name="date_range"
                        class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                        placeholder="Date Range (e.g. March 2023 – July 2023)">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-center">
                        <div>
                            <label class="text-[9px] uppercase tracking-widest font-bold text-gray-400">Order</label>
                            <input type="number" name="order" value="0"
                                class="w-full bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none">
                        </div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_visible" checked class="rounded">
                            <span class="text-[10px] uppercase tracking-widest font-bold">Visible</span>
                        </label>
                    </div>
                    <button type="submit"
                        class="bg-black text-white px-8 py-3 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
                        Add Training
                    </button>
                </form>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════
             PERSONAL STRENGTHS
             ═══════════════════════════════════════════════════════ --}}
        <section class="mb-12" x-data="{ open: true, showForm: false }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between text-left border-b border-black/5 pb-4 mb-6">
                <h3 class="text-[10px] uppercase tracking-[0.4em] font-bold">Personal Strengths
                    <span class="text-gray-400 ml-2">({{ $strengths->count() }})</span>
                </h3>
                <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="open" x-collapse>
                <div class="space-y-3 mb-6">
                    @foreach ($strengths as $strength)
                        <div class="bg-white border border-black/5 rounded-sm px-6 py-4" x-data="{ editing: false }">
                            <div x-show="!editing" class="flex items-center justify-between">
                                <p class="text-sm font-bold">{{ $strength->title }}</p>
                                <div class="flex items-center gap-3 ml-4 flex-shrink-0">
                                    @if (!$strength->is_visible)
                                        <span class="text-[9px] uppercase font-bold text-gray-400 tracking-widest">Hidden</span>
                                    @endif
                                    <button @click="editing = true"
                                        class="text-[9px] font-bold uppercase hover:underline">Edit</button>
                                    <form action="{{ route('admin.resume.strength.destroy', $strength->id) }}"
                                        method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-[9px] font-bold uppercase text-red-600 hover:underline"
                                            onclick="return confirm('Delete?')">Delete</button>
                                    </form>
                                </div>
                            </div>

                            <form x-show="editing"
                                action="{{ route('admin.resume.strength.update', $strength->id) }}"
                                method="POST" class="flex items-end gap-4">
                                @csrf @method('PUT')
                                <input type="text" name="title" value="{{ $strength->title }}"
                                    class="flex-1 bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                                    placeholder="Strength" required>
                                <input type="number" name="order" value="{{ $strength->order }}"
                                    class="w-16 bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none text-center"
                                    placeholder="#">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="is_visible" {{ $strength->is_visible ? 'checked' : '' }} class="rounded">
                                    <span class="text-[10px] uppercase font-bold">Visible</span>
                                </label>
                                <button type="submit"
                                    class="bg-black text-white px-4 py-2 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">Update</button>
                                <button type="button" @click="editing = false"
                                    class="px-4 py-2 text-[10px] font-bold uppercase border border-black/10 hover:bg-gray-50 transition-all">Cancel</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <button @click="showForm = !showForm"
                    class="text-[10px] font-bold uppercase tracking-[0.2em] hover:underline mb-4">
                    <span x-text="showForm ? '− Cancel' : '+ Add Strength'"></span>
                </button>

                <form x-show="showForm" action="{{ route('admin.resume.strength.store') }}" method="POST"
                    class="bg-white border border-black/5 rounded-sm p-6 flex items-end gap-4">
                    @csrf
                    <input type="text" name="title"
                        class="flex-1 bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none"
                        placeholder="Strength Name" required>
                    <input type="number" name="order" value="0"
                        class="w-16 bg-transparent border-b border-black/10 focus:border-black py-3 text-sm outline-none text-center"
                        placeholder="#">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_visible" checked class="rounded">
                        <span class="text-[10px] uppercase font-bold">Visible</span>
                    </label>
                    <button type="submit"
                        class="bg-black text-white px-6 py-3 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-gray-800 transition-all">
                        Add
                    </button>
                </form>
            </div>
        </section>
    </div>
@endsection
