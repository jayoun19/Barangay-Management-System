<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
    x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true',
        sidebarOpen: localStorage.getItem('sidebarOpen') === null ? true : localStorage.getItem('sidebarOpen') === 'true',
        init() {
            this.applyTheme();
        },
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
            this.applyTheme();
        },
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            localStorage.setItem('sidebarOpen', this.sidebarOpen);
        },
        applyTheme() {
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }" 
    x-init="init()"
    :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.jpg') }}">
    
    {{-- Anti-Flicker Script para sa Dark Mode at Sidebar Persistence --}}
    <script>
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }
        if (localStorage.getItem('sidebarOpen') === 'false') {
            document.documentElement.classList.add('sidebar-collapsed');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .sidebar-transition { transition: transform 0.2s ease-in-out, width 0.2s ease-in-out; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#f8fafc] dark:bg-slate-900 text-slate-900 dark:text-slate-100 font-sans antialiased transition-colors duration-300">
    
    <div class="min-h-screen flex overflow-hidden">
        
        {{-- Mobile Overlay --}}
        <div class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm lg:hidden" 
             x-show="sidebarOpen" 
             @click="toggleSidebar()" 
             x-cloak 
             x-transition.opacity></div>

        {{-- Sidebar Section --}}
        <aside 
            class="sidebar-transition fixed inset-y-0 left-0 z-50 w-72 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 lg:static lg:translate-x-0 flex flex-col h-screen"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:hidden'">
            
            <div class="flex-1 overflow-y-auto p-6 no-scrollbar">
                @include('layouts.sidebar')
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden h-screen">
            
            {{-- Header Section --}}
            <header class="z-30 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-700 sticky top-0">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex h-20 items-center justify-between">
                        
                        <div class="flex items-center gap-4">
                            <button @click="toggleSidebar()" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all shadow-sm" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                            
                            <h2 class="text-xl font-bold text-slate-800 hidden md:block dark:text-slate-100">
                                @yield('header_title', 'Barangay Dashboard')
                            </h2>
                        </div>

                        <div class="flex items-center gap-2 md:gap-5">
                            {{-- Notifications --}}
                            <div x-data="{ notificationsOpen: false }" class="relative">
                                <button @click="notificationsOpen = !notificationsOpen" class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:text-emerald-500 hover:border-emerald-200 transition-all shadow-sm relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </button>

                                <div x-show="notificationsOpen" 
                                     x-cloak
                                     @click.outside="notificationsOpen = false" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="absolute right-0 z-50 mt-2 w-80 rounded-3xl border border-slate-200 bg-white shadow-2xl dark:bg-slate-900 dark:border-slate-700">
                                    <div class="p-4 text-left">
                                        <p class="text-sm font-semibold text-slate-900 dark:text-white mb-4">Notifications</p>
                                        <div class="space-y-3">
                                            <div class="block rounded-2xl bg-slate-50 dark:bg-slate-800 p-3">
                                                <p class="text-sm font-semibold text-slate-900 dark:text-slate-100">System Ready</p>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">Dynamic profile image successfully integrated[cite: 35].</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Theme Toggle --}}
                            <button @click="toggleDarkMode()" class="p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:text-amber-500 transition-all shadow-sm">
                                <svg x-show="!darkMode" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                                <svg x-show="darkMode" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </button>

                            <div class="h-8 w-px bg-slate-200 dark:bg-slate-700"></div>

                            {{-- Dynamic User Profile Section --}}
                            <div class="flex items-center gap-3 pl-2">
                                <div class="h-11 w-11 overflow-hidden rounded-xl border-2 border-white dark:border-slate-700 shadow-md ring-1 ring-slate-200 dark:ring-slate-800">
                                    <img src="{{ Auth::user()->profile_photo_url }}" 
                                         alt="{{ Auth::user()->name }}" 
                                         class="h-full w-full object-cover" />
                                </div>
                                <div class="text-right hidden sm:block">
                                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                        {{ Auth::user()->name ?? 'Administrator' }}
                                    </p>
                                    <p class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">
                                        Admin Status
                                    </p>
                                </div>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-xl text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Scrollable Area --}}
            <main class="flex-1 overflow-y-auto p-6 lg:p-10 no-scrollbar">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>