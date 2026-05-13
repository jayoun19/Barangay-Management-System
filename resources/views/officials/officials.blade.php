@section('header_title', 'OFFICIALS')

<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] p-8 border border-slate-200 dark:border-slate-800 shadow-sm transition-colors duration-300">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h3 class="text-xl font-bold text-slate-800 dark:text-white">Barangay Officials</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">Visual flowchart for council and SK leadership</p>
        </div>
        <span class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 dark:text-slate-500">Officials Portal</span>
    </div>

    <div class="grid gap-8 xl:grid-cols-2">
        {{-- Barangay Council Section --}}
        <div class="rounded-[2.5rem] border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/40 p-7">
            <div class="mb-6">
                <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.25em] mb-6 text-center">Barangay Council</p>
                
                {{-- Barangay Captain (Top) --}}
                <div class="rounded-[2rem] border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm text-center group hover:border-emerald-500 dark:hover:border-emerald-500 transition-all">
                    <div class="mx-auto mb-4 h-24 w-24 overflow-hidden rounded-[1.5rem] border-4 border-slate-50 dark:border-slate-700 shadow-md">
                        <img src="{{ asset('images/' . $barangayOfficials[0]['photo']) }}" class="h-full w-full object-cover">
                    </div>
                    <p class="font-bold text-slate-900 dark:text-white text-lg">{{ $barangayOfficials[0]['name'] }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">{{ $barangayOfficials[0]['role'] }}</p>
                </div>
                
                <div class="mt-6 flex justify-center">
                    <div class="h-10 w-px bg-slate-200 dark:bg-slate-700"></div>
                </div>
            </div>

            {{-- Barangay Kagawads --}}
            <div class="grid gap-4">
                @foreach($barangayOfficials as $index => $official)
                    @if($index > 0)
                        <div class="rounded-[1.75rem] border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 shadow-sm flex items-center gap-4 transition-all hover:translate-x-1 hover:shadow-md">
                            <div class="h-14 w-14 overflow-hidden rounded-2xl border-2 border-slate-50 dark:border-slate-700">
                                <img src="{{ asset('images/' . $official['photo']) }}" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-slate-100 text-sm">{{ $official['name'] }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ $official['role'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- SK Leadership Section --}}
        <div class="rounded-[2.5rem] border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/40 p-7">
            <div class="mb-6">
                <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.25em] mb-6 text-center">SK Leadership</p>
                
                {{-- SK Chairperson (Top) --}}
                <div class="rounded-[2rem] border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm text-center group hover:border-blue-500 dark:hover:border-blue-500 transition-all">
                    <div class="mx-auto mb-4 h-24 w-24 overflow-hidden rounded-[1.5rem] border-4 border-slate-50 dark:border-slate-700 shadow-md">
                        <img src="{{ asset('images/' . $skOfficials[0]['photo']) }}" class="h-full w-full object-cover">
                    </div>
                    <p class="font-bold text-slate-900 dark:text-white text-lg">{{ $skOfficials[0]['name'] }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">{{ $skOfficials[0]['role'] }}</p>
                </div>

                <div class="mt-6 flex justify-center">
                    <div class="h-10 w-px bg-slate-200 dark:bg-slate-700"></div>
                </div>
            </div>

            {{-- SK Kagawads --}}
            <div class="grid gap-4">
                @foreach($skOfficials as $index => $official)
                    @if($index > 0)
                        <div class="rounded-[1.75rem] border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 shadow-sm flex items-center gap-4 transition-all hover:translate-x-1 hover:shadow-md">
                            <div class="h-14 w-14 overflow-hidden rounded-2xl border-2 border-slate-50 dark:border-slate-700">
                                <img src="{{ asset('images/' . $official['photo']) }}" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 dark:text-slate-100 text-sm">{{ $official['name'] }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">{{ $official['role'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>