<x-app-layout>
    @section('header_title', 'BLOTTERS')
    <x-slot name="header">Report Blotter Case</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="rounded-[2rem] border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-8 shadow-sm transition-colors duration-200">
            <header class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white uppercase tracking-tight">New Case Entry</h2>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-1">Please fill out the incident details accurately.</p>
            </header>

            <form action="{{ route('blotters.store') }}" method="POST" class="space-y-6">
                @csrf
                
                {{-- Automated Case Number Info --}}
                <div class="rounded-2xl border border-blue-100 dark:border-blue-900/30 bg-blue-50/50 dark:bg-blue-900/20 px-6 py-4 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-xs font-bold text-blue-700 dark:text-blue-300 uppercase tracking-wide">
                            Case number will be generated automatically upon submission.
                        </p>
                    </div>
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    {{-- Status --}}
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Current Status</label>
                        <select name="status" class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none" required>
                            <option value="Open" {{ old('status') == 'Open' ? 'selected' : '' }}>Open</option>
                            <option value="Ongoing" {{ old('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="Resolved" {{ old('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>

                    {{-- Incident Date --}}
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Incident Date</label>
                        <input type="date" name="incident_date" value="{{ old('incident_date', now()->toDateString()) }}" 
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>[cite: 34]
                    </div>

                    {{-- Complainant --}}
                    <div class="lg:col-span-2 space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Complainant Name</label>
                        <input type="text" name="complainant" value="{{ old('complainant') }}" placeholder="Full Name of Complainant"
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>[cite: 34]
                    </div>

                    {{-- Respondent --}}
                    <div class="lg:col-span-2 space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Respondent Name</label>
                        <input type="text" name="respondent" value="{{ old('respondent') }}" placeholder="Full Name of Respondent (Optional)"
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none transition-all">[cite: 34]
                    </div>

                    {{-- Details --}}
                    <div class="lg:col-span-2 space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Incident Details</label>
                        <textarea name="incident_details" rows="5" placeholder="Narrative of the incident..."
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none resize-none transition-all" required>{{ old('incident_details') }}</textarea>[cite: 34]
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-6 flex flex-col-reverse sm:flex-row items-center gap-3 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('blotters.index') }}" 
                        class="w-full sm:w-auto text-center px-8 py-3.5 text-[11px] font-black uppercase tracking-widest text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="w-full sm:w-auto bg-slate-900 dark:bg-blue-600 text-white px-10 py-3.5 rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-lg shadow-slate-200 dark:shadow-none hover:bg-slate-800 dark:hover:bg-blue-500 active:scale-95 transition-all">
                        Submit Blotter Case
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>