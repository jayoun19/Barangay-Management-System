<div class="flex flex-col h-full" x-data="{ 
    saveScroll() { 
        const sidebar = document.getElementById('sidebar-nav');
        if (sidebar) localStorage.setItem('sidebar-scroll', sidebar.scrollTop);
    },
    restoreScroll() {
        const sidebar = document.getElementById('sidebar-nav');
        const scrollPos = localStorage.getItem('sidebar-scroll');
        if (sidebar && scrollPos) sidebar.scrollTop = scrollPos;
    }
}" x-init="$nextTick(() => restoreScroll())">
    {{-- Brand Logo Section --}}
    <div class="flex items-center gap-4 px-4 py-3 rounded-3xl border border-slate-200/80 dark:border-slate-700/80 bg-white dark:bg-slate-800 transition-colors duration-300">
        <div class="h-14 w-14 rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 flex items-center justify-center">
            <img src="{{ asset('images/icon.jpg') }}" alt="Baranggay North Fairview logo" class="h-10 w-10 object-contain" />
        </div>
        <div>
            <p class="text-[10px] uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400 font-bold mb-1">Barangay Management System</p>
        </div>
    </div>

    {{-- Idinagdag ang ID na 'sidebar-nav' para sa scroll tracking --}}
    <nav id="sidebar-nav" class="mt-8 flex-1 space-y-8 overflow-y-auto no-scrollbar pb-10" style="scroll-behavior: auto;">
        
        {{-- MAIN SECTION --}}
        <div>
            <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4">Main</p>
            <div class="space-y-1">
                @php
                    $mainItems = [
                        ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'announcements.index', 'label' => 'Announcements', 'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z'],
                        ['route' => 'profile.edit', 'label' => 'Profile', 'icon' => 'M16 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm-8 0c1.657 0 3-1.343 3-3S9.657 5 8 5 5 6.343 5 8s1.343 3 3 3zm-3 2c0 2.667 2.667 4 6 4s6-1.333 6-4v-1H5v1z'],
                        ['route' => 'officials.index', 'label' => 'Officials', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['route' => 'calendar.index', 'label' => 'Calendar', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['route' => 'typhoons.index', 'label' => 'Typhoon Monitoring', 'icon' => 'M3 10h18M12 3v18M4 5l4 4-4 4M20 5l-4 4 4 4'],
                    ];
                @endphp

                @foreach($mainItems as $item)
                    <a href="{{ route($item['route']) }}" @click="saveScroll()" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2 dark:focus:ring-slate-600 {{ request()->routeIs($item['route']) ? 'bg-slate-900 dark:bg-slate-600 text-white shadow-lg' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs($item['route']) ? 'text-blue-400' : 'text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-100' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" /></svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- RECORDS SECTION --}}
        <div>
            <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4">Records</p>
            <div class="space-y-1">
                @php
                    $recordItems = [
                        ['route' => 'residents.index', 'label' => 'Residents', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                        ['route' => 'households.index', 'label' => 'Households', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ['route' => 'certificates.index', 'label' => 'Certificates', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ];
                @endphp

                @foreach($recordItems as $item)
                    <a href="{{ route($item['route']) }}" @click="saveScroll()" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2 dark:focus:ring-slate-600 {{ request()->routeIs($item['route']) ? 'bg-slate-900 dark:bg-slate-600 text-white shadow-lg' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs($item['route']) ? 'text-blue-400' : 'text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-100' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" /></svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- SERVICES SECTION --}}
        <div>
            <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4">Services & Legal</p>
            <div class="space-y-1">
                @php
                    $serviceItems = [
                        ['route' => 'blotters.index', 'label' => 'Blotters', 'icon' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z'],
                        ['route' => 'transactions.index', 'label' => 'Transactions', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['route' => 'ordinances.index', 'label' => 'Ordinances', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                    ];
                @endphp

                @foreach($serviceItems as $item)
                    <a href="{{ route($item['route']) }}" @click="saveScroll()" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2 dark:focus:ring-slate-600 {{ request()->routeIs($item['route']) ? 'bg-slate-900 dark:bg-slate-600 text-white shadow-lg' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ request()->routeIs($item['route']) ? 'text-blue-400' : 'text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-100' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}" /></svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- SYSTEM SECTION --}}
        <div>
            <p class="px-4 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-4">System</p>
            <div class="space-y-1">
                <a href="{{ route('settings.edit') }}" @click="saveScroll()" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-2 dark:focus:ring-slate-600 {{ request()->routeIs('settings.*') ? 'bg-slate-900 dark:bg-slate-600 text-white shadow-lg' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-100" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /></svg>
                    Settings
                </a>
            </div>
        </div>
    </nav>
</div>