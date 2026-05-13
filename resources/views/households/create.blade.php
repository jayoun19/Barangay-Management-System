<x-app-layout>
    @section('header_title', 'HOUSEHOLDS')
    <x-slot name="header">Register New Household</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="rounded-[2rem] border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-8 shadow-sm transition-colors duration-200">
            <header class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white uppercase tracking-tight">Household Entry</h2>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-1">Assign head and members to a household.</p>
            </header>

            <form action="{{ route('households.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="rounded-2xl border border-indigo-100 dark:border-indigo-900/30 bg-indigo-50/50 dark:bg-indigo-900/20 px-6 py-4">
                    <p class="text-xs font-bold text-indigo-700 dark:text-indigo-300 uppercase tracking-wide">
                        ℹ️ Household Number will be generated automatically upon saving.
                    </p>
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="lg:col-span-1 space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Household Head</label>
                        <select name="head_id" class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="">Select Household Head</option>
                            @foreach($residents as $resident)
                                <option value="{{ $resident->id }}"{{ old('head_id') == $resident->id ? ' selected' : '' }}>{{ $resident->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lg:col-span-2 space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Full Address</label>
                        <textarea name="address" rows="3" placeholder="Block, Lot, Street, Barangay..."
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none resize-none transition-all" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="lg:col-span-2 space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Household Members</label>
                        <select name="members[]" multiple class="w-full h-48 rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            @foreach($residents as $resident)
                                <option value="{{ $resident->id }}"{{ in_array($resident->id, old('members', [])) ? ' selected' : '' }}>{{ $resident->full_name }}</option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-[10px] font-bold text-slate-400 uppercase px-2 italic text-right">Hold CTRL (Windows) or CMD (Mac) to select multiple</p>
                    </div>
                </div>

                <div class="pt-6 flex flex-col-reverse sm:flex-row items-center gap-3 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('households.index') }}" class="w-full sm:w-auto text-center px-8 py-3.5 text-[11px] font-black uppercase text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">Cancel</a>
                    <button type="submit" class="w-full sm:w-auto bg-slate-900 dark:bg-indigo-600 text-white px-10 py-3.5 rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-lg hover:opacity-90 transition-all">Save Household</button>
                </div>
            </form>
        </div>
    </div>
    
</x-app-layout>