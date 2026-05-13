<x-app-layout>
    @section('header_title', 'RESIDENTS')
    <x-slot name="header">Add New Resident</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="rounded-[2.5rem] border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 p-8 shadow-2xl shadow-slate-200/50 dark:shadow-none">
            <header class="mb-10">
                <h2 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Resident Registration</h2>
                <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mt-1">Fill in the details for the new resident profile</p>
            </header>

            <form action="{{ route('residents.store') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="grid gap-x-8 gap-y-6 lg:grid-cols-2">
                    <!-- First Name -->
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1 tracking-widest">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" 
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-800 px-5 py-3.5 text-xs font-bold text-slate-900 dark:text-slate-100 ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none" 
                            required placeholder="e.g. Juan">
                        <x-input-error :messages="$errors->get('first_name')" />
                    </div>

                    <!-- Last Name -->
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1 tracking-widest">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" 
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-800 px-5 py-3.5 text-xs font-bold text-slate-900 dark:text-slate-100 ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none" 
                            required placeholder="e.g. Dela Cruz">
                        <x-input-error :messages="$errors->get('last_name')" />
                    </div>

                    <!-- Age -->
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1 tracking-widest">Current Age</label>
                        <input type="number" name="age" value="{{ old('age') }}" 
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-800 px-5 py-3.5 text-xs font-bold text-slate-900 dark:text-slate-100 ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none" 
                            required placeholder="0">
                    </div>

                    <!-- Gender -->
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1 tracking-widest">Gender Orientation</label>
                        <select name="gender" 
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-800 px-5 py-3.5 text-xs font-bold text-slate-900 dark:text-slate-100 ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none" required>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Contact -->
                    <div class="lg:col-span-2 space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1 tracking-widest">Active Contact Number</label>
                        <input type="text" name="contact" value="{{ old('contact') }}" 
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-800 px-5 py-3.5 text-xs font-bold text-slate-900 dark:text-slate-100 ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none" 
                            placeholder="09xx-xxx-xxxx">
                    </div>

                    <!-- Address -->
                    <div class="lg:col-span-2 space-y-2">
                        <label class="block text-[10px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1 tracking-widest">Permanent Address</label>
                        <textarea name="address" rows="3" 
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-800 px-5 py-3.5 text-xs font-bold text-slate-900 dark:text-slate-100 ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none resize-none" 
                            required placeholder="House No., Street Name, Purok...">{{ old('address') }}</textarea>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-50 dark:border-slate-800">
                    <a href="{{ route('residents.index') }}" 
                        class="px-8 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                        Discard
                    </a>
                    <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-blue-500/25 transition-all active:scale-95">
                        Register Resident
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>