<x-app-layout>
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('calendar.index') }}" class="text-sm font-bold text-blue-600 hover:underline flex items-center gap-2">
                ← Back to Calendar
            </a>
            <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight mt-4">Add New Activity</h2>
            <p class="text-slate-500 font-medium">Schedule a new event for the barangay community</p>
        </div>

        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm">
            <form action="{{ route('calendar.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Activity Title</label>
                        <input type="text" name="title" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-4 text-sm focus:ring-4 focus:ring-blue-500/10 transition-all" placeholder="e.g. Brgy. General Assembly" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Date</label>
                        <input type="date" name="start_date" value="{{ request('date') }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-4 text-sm focus:ring-4 focus:ring-blue-500/10 transition-all" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Time</label>
                        <input type="time" name="time" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-4 text-sm focus:ring-4 focus:ring-blue-500/10 transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Location</label>
                        <input type="text" name="location" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-4 text-sm focus:ring-4 focus:ring-blue-500/10 transition-all" placeholder="e.g. Covered Court / Brgy Hall" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-4 text-sm focus:ring-4 focus:ring-blue-500/10 transition-all" placeholder="What is this activity about?"></textarea>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full rounded-2xl bg-slate-900 dark:bg-blue-600 px-6 py-4 text-sm font-black uppercase tracking-widest text-white shadow-xl shadow-slate-200 dark:shadow-none hover:bg-slate-800 dark:hover:bg-blue-500 hover:-translate-y-0.5 transition-all active:scale-95">
                        Save Activity
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>