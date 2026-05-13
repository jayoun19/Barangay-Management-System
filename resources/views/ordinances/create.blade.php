<x-app-layout>
    @section('header_title', 'ORDINANCES')
    <x-slot name="header">New Ordinance Entry</x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="rounded-[2rem] border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-8 shadow-sm transition-colors duration-200">
            <header class="mb-8">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white uppercase tracking-tight">Add Ordinance</h2>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-1">Official legislative record entry</p>
            </header>

            <form action="{{ route('ordinances.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="rounded-2xl border border-blue-100 dark:border-blue-900/30 bg-blue-50/50 dark:bg-blue-900/20 px-6 py-4">
                    <p class="text-xs font-bold text-blue-700 dark:text-blue-300 uppercase tracking-wide">
                        ℹ️ Ordinance number will be generated automatically upon submission.
                    </p>
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div class="lg:col-span-2 space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Ordinance Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter full title of the ordinance"
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none transition-all" required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Enacted Date</label>
                        <input type="date" name="enacted_date" value="{{ old('enacted_date', now()->toDateString()) }}" 
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none" required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Upload Document (PDF/DOC)</label>
                        <input type="file" name="document" 
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-2 text-xs font-semibold text-slate-500 ring-1 ring-slate-200 dark:ring-slate-700 outline-none">
                    </div>

                    <div class="lg:col-span-2 space-y-2">
                        <label class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase ml-1">Full Description</label>
                        <textarea name="description" rows="5" placeholder="Detailed narrative of the ordinance..."
                            class="w-full rounded-2xl border-none bg-slate-50 dark:bg-slate-900/50 px-5 py-3.5 text-sm font-semibold text-slate-900 dark:text-white ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none resize-none transition-all" required>{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="pt-6 flex flex-col-reverse sm:flex-row items-center gap-3 border-t border-slate-100 dark:border-slate-700/50">
                    <a href="{{ route('ordinances.index') }}" class="w-full sm:w-auto text-center px-8 py-3.5 text-[11px] font-black uppercase text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">Cancel</a>
                    <button type="submit" class="w-full sm:w-auto bg-slate-900 dark:bg-blue-600 text-white px-10 py-3.5 rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-lg hover:bg-slate-800 dark:hover:bg-blue-500 transition-all">Save Ordinance</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>