<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Resident Registration</h2>
        <div class="flex items-center gap-2 mt-1">
            <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
            <p class="text-[10px] font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest">Portal Membership</p>
        </div>
    </div>

    {{-- Success Message Alert --}}
    @if (session('status'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-4 p-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 rounded-2xl flex items-center gap-3">
            <div class="bg-emerald-500 rounded-full p-1">
                <svg class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor font-black"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7" /></svg>
            </div>
            <p class="text-xs font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-tight">Registration Successful! You can now sign in.</p>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4" autocomplete="off">
        @csrf

        {{-- Section 1: Personal Details --}}
        <div class="group bg-white dark:bg-slate-800/50 p-5 rounded-[2rem] border border-slate-200 dark:border-slate-700/50 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center gap-2 mb-4">
                <div class="h-5 w-5 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <span class="text-[10px] font-black text-blue-600">01</span>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Personal Details</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase mb-1.5 ml-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all" placeholder="Juan Dela Cruz" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase mb-1.5 ml-1">Birthdate</label>
                    <input type="date" name="birthdate" value="{{ old('birthdate') }}" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20" required />
                    <x-input-error :messages="$errors->get('birthdate')" class="mt-1" />
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase mb-1.5 ml-1">Age</label>
                    <input type="number" name="age" value="{{ old('age') }}" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20" required />
                    <x-input-error :messages="$errors->get('age')" class="mt-1" />
                </div>
                
                <div class="grid grid-cols-3 col-span-1 md:col-span-4 gap-3 mt-1">
                    <select name="gender" class="rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20" required>
                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <select name="civil_status" class="rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20" required>
                        <option value="" disabled {{ old('civil_status') ? '' : 'selected' }}>Status</option>
                        <option value="Single" {{ old('civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Widowed" {{ old('civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                    <div class="w-full">
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" class="rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20 w-full" required />
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>
                </div>
                <div class="grid grid-cols-3 col-span-1 md:col-span-4 gap-3 mt-1">
                    <div class="col-span-2">
                        <x-input-error :messages="$errors->get('gender')" class="mt-1" />
                    </div>
                    <div class="col-span-1">
                        <x-input-error :messages="$errors->get('civil_status')" class="mt-1" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Residency --}}
        <div class="bg-white dark:bg-slate-800/50 p-5 rounded-[2rem] border border-slate-200 dark:border-slate-700/50 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center gap-2 mb-4">
                <div class="h-5 w-5 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <span class="text-[10px] font-black text-blue-600">02</span>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Residency</p>
            </div>
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-3">
                    <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase mb-1.5 ml-1">Street Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="House No. / Street Name" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20" required />
                    <x-input-error :messages="$errors->get('address')" class="mt-1" />
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase mb-1.5 ml-1">Purok</label>
                    <input type="text" name="purok" value="{{ old('purok') }}" placeholder="Ex. 1" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20" />
                    <x-input-error :messages="$errors->get('purok')" class="mt-1" />
                </div>
            </div>
        </div>

        {{-- Section 3: Credentials --}}
        <div class="bg-white dark:bg-slate-800/50 p-5 rounded-[2rem] border border-slate-200 dark:border-slate-700/50 shadow-sm transition-all hover:shadow-md">
             <div class="flex items-center gap-2 mb-4">
                <div class="h-5 w-5 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <span class="text-[10px] font-black text-blue-600">03</span>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Security</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>
                <input type="password" name="password" placeholder="Create Password" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20" required />
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900 dark:text-white py-2 text-xs focus:ring-2 focus:ring-blue-500/20" required />
            </div>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-4">
            <p class="text-[10px] text-slate-500 font-medium">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline transition-all">Sign In Here</a></p>
            <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 px-10 py-3 rounded-2xl text-[10px] font-black uppercase text-white shadow-lg shadow-blue-500/20 transform transition-all active:scale-95">
                Complete Registration
            </button>
        </div>
    </form>
</x-guest-layout>