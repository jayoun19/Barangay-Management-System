<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
    x-data="{
        darkMode: localStorage.getItem('darkMode') === 'true',
        init() {
            this.applyTheme();
        },
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            localStorage.setItem('darkMode', this.darkMode);
            this.applyTheme();
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
    <link rel="icon" type="image/png" href="{{ asset('images/nf.png') }}">
    
    <script>
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    </script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .login-bg {
            background-image: url('{{ asset("images/village.png") }}'); 
            background-size: cover;
            background-position: center;
        }
        .glass-effect {
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased transition-colors duration-300 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        
        {{-- LEFT SIDE --}}
        <div class="login-bg hidden w-1/2 lg:flex items-center justify-center relative">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/80 via-slate-900/60 to-transparent"></div> 
            <div class="relative z-10 w-full max-w-lg p-6">
                <div class="glass-effect rounded-[2.5rem] bg-white/10 border border-white/20 p-8 text-center shadow-2xl">
                    <h1 class="text-4xl font-black tracking-tighter text-white uppercase leading-none mb-2">
                        Barangay <span class="text-blue-400">KONOHA</span> <br>
                    </h1>
                    <p class="text-[10px] font-black tracking-[0.4em] text-blue-300 uppercase">Management System</p>
                </div>
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="flex w-full flex-col justify-center px-8 lg:w-1/2 lg:px-16 relative bg-white dark:bg-slate-900">
            
            <div class="absolute top-6 right-6 z-50">
                <button @click="toggleDarkMode()" class="icon-btn bg-slate-100 dark:bg-slate-800">
                    <svg x-show="!darkMode" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="darkMode" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
            </div>

            <div class="mx-auto w-full max-w-md">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>