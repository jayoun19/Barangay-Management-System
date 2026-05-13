<section>
    <header class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Personal Information</h2>
            <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mt-1">General Details & Residency</p>
        </div>
        <div class="hidden md:block h-px flex-1 bg-gradient-to-r from-transparent via-slate-200 dark:via-slate-800 to-transparent mx-8"></div>
    </header>

    <form id="profile-update-form" method="post" action="{{ route('profile.update') }}" class="space-y-8" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            
            {{-- Full Name --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Full Name
                </label>
                <x-text-input id="name" name="name" type="text" class="w-full rounded-2xl bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700 text-xs font-bold focus:ring-indigo-500/20 transition-all" :value="old('name', $user->name)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- Birthdate --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Birthdate
                </label>
                <div class="relative">
                    <x-text-input id="birthdate" name="birthdate" type="text" class="w-full rounded-2xl bg-slate-100 dark:bg-slate-900/80 border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-400 cursor-not-allowed" :value="old('birthdate', $user->birthdate ? $user->birthdate->format('Y-m-d') : '')" readonly />
                </div>
            </div>

            {{-- Gender --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Gender
                </label>
                <div class="relative">
                    <x-text-input id="gender" name="gender" type="text" class="w-full rounded-2xl bg-slate-100 dark:bg-slate-900/80 border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-400 cursor-not-allowed" :value="old('gender', $user->gender)" readonly />
                </div>
            </div>

            {{-- Civil Status --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Civil Status
                </label>
                <div class="relative">
                    <x-text-input id="civil_status" name="civil_status" type="text" class="w-full rounded-2xl bg-slate-100 dark:bg-slate-900/80 border-slate-200 dark:border-slate-800 text-xs font-bold text-slate-400 cursor-not-allowed" :value="old('civil_status', $user->civil_status)" readonly />
                </div>
            </div>

            {{-- Phone Number --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Phone Number
                </label>
                <x-text-input id="phone" name="phone" type="text" class="w-full rounded-2xl bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700 text-xs font-bold focus:ring-indigo-500/20 transition-all" :value="old('phone', $user->phone)" required />
            </div>

            {{-- Purok --}}
            <div class="space-y-1.5">
                <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Purok
                </label>
                <x-text-input id="purok" name="purok" type="text" class="w-full rounded-2xl bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700 text-xs font-bold focus:ring-indigo-500/20 transition-all" :value="old('purok', $user->purok)" />
            </div>

            {{-- Full Home Address --}}
            <div class="md:col-span-2 space-y-1.5">
                <label class="flex items-center gap-2 text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Full Home Address
                </label>
                <x-text-input id="address" name="address" type="text" class="w-full rounded-2xl bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700 text-xs font-bold focus:ring-indigo-500/20 transition-all" :value="old('address', $user->address)" required />
            </div>
        </div>

        {{-- Footer Actions --}}
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-slate-100 dark:border-slate-800/50">
            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest">Profile Saved</span>
                </div>
            @endif

            <button type="submit" class="group relative inline-flex items-center justify-center gap-3 rounded-2xl bg-indigo-600 px-10 py-4 text-[11px] font-black text-white uppercase tracking-[0.2em] shadow-xl shadow-indigo-500/25 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95">
                Save Changes
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </form>
</section>