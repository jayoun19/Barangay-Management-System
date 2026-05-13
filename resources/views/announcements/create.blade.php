<x-app-layout>
    @section('header_title', 'ANNOUNCEMENTS')
    
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Compose Announcement</h2>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Fill out the details below to broadcast a new update.</p>
        </div>

        <!-- Form Card -->
        <div class="relative overflow-hidden rounded-[2.5rem] border border-slate-100 dark:border-slate-700/50 bg-white dark:bg-slate-800 p-8 md:p-10 shadow-xl shadow-slate-200/50 dark:shadow-none">
            <!-- Subtle Decorative Element -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/5 rounded-full blur-3xl"></div>

            <form action="{{ route('announcements.store') }}" method="POST" class="relative space-y-8">
                @csrf

                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Title Field -->
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Announcement Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                            class="w-full rounded-2xl border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-5 py-4 text-sm font-bold text-slate-900 dark:text-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-400" 
                            placeholder="e.g., Upcoming Community Assembly" required>
                        @error('title')
                            <p class="mt-2 text-xs font-bold text-rose-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Field -->
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Classification</label>
                        <div class="relative">
                            <select name="category" class="w-full appearance-none rounded-2xl border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-5 py-4 text-sm font-bold text-slate-900 dark:text-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all" required>
                                <option value="" disabled selected>Select a category</option>
                                <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General Update</option>
                                <option value="Meeting" {{ old('category') == 'Meeting' ? 'selected' : '' }}>Community Meeting</option>
                                <option value="Health" {{ old('category') == 'Health' ? 'selected' : '' }}>Health Advisory</option>
                                <option value="Emergency" {{ old('category') == 'Emergency' ? 'selected' : '' }}>Emergency Alert</option>
                                <option value="Event" {{ old('category') == 'Event' ? 'selected' : '' }}>Local Event</option>
                            </select>
                        </div>
                        @error('category')
                            <p class="mt-2 text-xs font-bold text-rose-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Field -->
                    <div class="md:col-span-2">
                        <label class="block text-[11px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2 ml-1">Message Content</label>
                        <textarea name="content" rows="6" 
                            class="w-full rounded-3xl border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-5 py-4 text-sm font-medium text-slate-700 dark:text-slate-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-400 leading-relaxed" 
                            placeholder="Write your detailed announcement here..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-2 text-xs font-bold text-rose-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col-reverse sm:flex-row gap-3 pt-4">
                    <a href="{{ route('announcements.index') }}" 
                        class="inline-flex items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-700 px-8 py-4 text-sm font-black text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all active:scale-95">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="flex-1 inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-8 py-4 text-sm font-black text-white shadow-lg shadow-indigo-500/25 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Publish Announcement
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>