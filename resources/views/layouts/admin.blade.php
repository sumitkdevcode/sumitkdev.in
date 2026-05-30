<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - {{ config('app.name', 'Sumit Kumar') }}</title>
    <link rel="icon" type="image/webp" href="{{ asset('images/favicon.webp') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/spa.css', 'resources/js/app.js', 'resources/js/spa.js'])

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 175px;
            background: white;
            border-right: 1px solid #e5e7eb;
            z-index: 50;
            transition: transform 0.3s ease-in-out;
            overflow-y: auto;
        }

        .sidebar-link {
            display: block;
            padding: 16px 24px;
            font-size: 14px;
            font-weight: 400;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sidebar-link:hover {
            background-color: #f9fafb;
            color: #111827;
        }

        .sidebar-link.active {
            background-color: #f3f4f6;
            color: #111827;
            font-weight: 500;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 175px;
            min-height: 100vh;
            background: #f3f4f6;
            transition: margin-left 0.3s ease-in-out;
        }

        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100 antialiased" x-data="{ mobileMenuOpen: false }">
    <!-- SPA Loading Overlay -->
    <div id="spa-loading"></div>

    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside :class="mobileMenuOpen ? 'mobile-open' : ''" class="sidebar custom-scrollbar">

            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}" class="text-lg font-bold text-gray-900">Admin Panel</a>
            </div>

            <nav class="py-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.portfolio.index') }}"
                    class="sidebar-link {{ request()->is('admin/portfolio*') ? 'active' : '' }}">
                    Portfolio Items
                </a>

                <a href="{{ route('admin.blog.index') }}"
                    class="sidebar-link {{ request()->is('admin/blog*') ? 'active' : '' }}">
                    Blog Posts
                </a>

                <a href="{{ route('admin.media.index') }}"
                    class="sidebar-link {{ request()->is('admin/media*') ? 'active' : '' }}">
                    Media Library
                </a>

                <a href="{{ route('admin.contacts.index') }}"
                    class="sidebar-link {{ request()->is('admin/contacts*') ? 'active' : '' }}">
                    Contact Inquiries
                </a>

                <div class="mt-4 pt-4">
                    <a href="{{ route('admin.settings.index') }}"
                        class="sidebar-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        Site Settings
                    </a>
                    <a href="{{ route('admin.seo.index') }}"
                        class="sidebar-link {{ request()->is('admin/seo*') ? 'active' : '' }}">
                        SEO Settings
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="sidebar-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        Manage Admins
                    </a>
                    <a href="{{ route('admin.social-links.index') }}"
                        class="sidebar-link {{ request()->is('admin/social-links*') ? 'active' : '' }}">
                        Social Links
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Mobile Overlay -->
        <div x-cloak x-show="mobileMenuOpen" @click="mobileMenuOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden">
        </div>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-4">
                        <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="lg:hidden p-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <h1 class="text-xl font-bold text-gray-900">@yield('header', 'Dashboard')</h1>
                    </div>

                    <div class="flex items-center gap-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-black text-white px-5 py-2 text-sm font-medium hover:bg-gray-800 transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-6 lg:p-8">
                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission:</h3>
                                <ul class="mt-2 list-disc list-inside text-xs text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div id="spa-content" class="max-w-7xl">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        // Global CKEditor configuration for Classic Editor
        window.CKEditorConfig = {
            toolbar: [
                'undo', 'redo',
                '|',
                'heading',
                '|',
                'bold', 'italic', 'link',
                '|',
                'bulletedList', 'numberedList',
                '|',
                'blockQuote', 'insertTable',
                '|',
                'outdent', 'indent'
            ],
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                ]
            }
        };

        // Helper function to initialize CKEditor on any element
        window.initCKEditor = function (elementId) {
            const element = document.querySelector('#' + elementId);
            if (!element) return Promise.reject('Element not found');

            return ClassicEditor
                .create(element, window.CKEditorConfig)
                .then(editor => {
                    console.log('CKEditor initialized successfully on #' + elementId);
                    return editor;
                })
                .catch(error => {
                    console.error('CKEditor initialization error:', error);
                    throw error;
                });
        };
    </script>
    @stack('scripts')
</body>

</html>