<x-app-layout>
    @section('header_title', 'ANNOUNCEMENTS')
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb & Actions -->
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <a href="{{ route('announcements.index') }}" class="group inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                Back to Feed
            </a>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('announcements.edit', $announcement) }}" class="inline-flex items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700 px-5 py-2.5 text-xs font-black text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
                    Edit Content
                </a>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-6">
                <div class="overflow-hidden rounded-[2.5rem] border border-slate-100 dark:border-slate-700/50 bg-white dark:bg-slate-800 p-8 md:p-12 shadow-sm">
                    
                    @php
                        $categoryColors = [
                            'Emergency' => 'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-900/30 dark:text-rose-400 dark:border-rose-800',
                            'Meeting' => 'bg-indigo-50 text-indigo-600 border-indigo-100 dark:bg-indigo-900/30 dark:text-indigo-400 dark:border-indigo-800',
                            'Health' => 'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-400 dark:border-emerald-800',
                            'Event' => 'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-900/30 dark:text-amber-400 dark:border-amber-800',
                            'General' => 'bg-slate-50 text-slate-600 border-slate-100 dark:bg-slate-700 dark:text-slate-300 dark:border-slate-600'
                        ];
                        $colorClass = $categoryColors[$announcement->category] ?? $categoryColors['General'];
                    @endphp

                    <div class="space-y-6">
                        <span class="inline-flex items-center rounded-xl border {{ $colorClass }} px-4 py-1.5 text-xs font-black uppercase tracking-widest">
                            {{ $announcement->category }}
                        </span>

                        <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-[1.1]">
                            {{ $announcement->title }}
                        </h1>

                        <!-- Author & Date Section -->
                        <div class="flex items-center gap-4 py-6 border-y border-slate-50 dark:border-slate-700/50">
                            <div class="h-12 w-12 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center border-2 border-white dark:border-slate-800 shadow-sm">
                                <span class="text-lg font-black text-slate-500 dark:text-slate-400">
                                    {{ strtoupper(substr($announcement->user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="flex flex-col text-left">
                                <span class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest leading-none mb-1">Posted By</span>
                                <span class="text-base font-bold text-slate-900 dark:text-white leading-none">
                                    {{ $announcement->user->name }}
                                </span>
                            </div>
                            <div class="ml-auto text-right hidden sm:block">
                                <span class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest leading-none mb-1 block">Publish Date</span>
                                <span class="text-sm font-bold text-slate-600 dark:text-slate-400">{{ $announcement->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>

                        <div class="prose prose-slate dark:prose-invert max-w-none">
                            <p class="whitespace-pre-wrap text-lg leading-relaxed text-slate-700 dark:text-slate-300 font-medium italic">
                                {{ $announcement->content }}
                            </p>
                        </div>

                        @if($announcement->updated_at != $announcement->created_at)
                            <div class="pt-6 text-[10px] font-black text-slate-400 uppercase tracking-tighter">
                                Note: Information updated on {{ $announcement->updated_at->format('M d, Y \a\t g:i A') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Info Area -->
            <div class="space-y-6">
                <!-- Quick Details -->
                <div class="rounded-[2.5rem] border border-slate-100 dark:border-slate-700/50 bg-white dark:bg-slate-800 p-8 shadow-sm">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Archive Metadata</h3>
                    <dl class="space-y-6">
                        <div class="flex flex-col">
                            <dt class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Document ID</dt>
                            <dd class="text-sm font-bold text-slate-900 dark:text-white">ANN-{{ $announcement->id }}-{{ $announcement->created_at->format('Y') }}</dd>
                        </div>
                        <div class="flex flex-col">
                            <dt class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Time Log</dt>
                            <dd class="text-sm font-bold text-slate-900 dark:text-white">{{ $announcement->created_at->format('g:i A') }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Danger Zone -->
                <div class="rounded-[2.5rem] border border-rose-100 dark:border-rose-900/30 bg-rose-50/30 dark:bg-rose-900/10 p-8">
                    <h3 class="text-xs font-black text-rose-400 uppercase tracking-[0.2em] mb-4">Management</h3>
                    <form action="{{ route('announcements.destroy', $announcement) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full rounded-2xl bg-white dark:bg-slate-800 border border-rose-200 dark:border-rose-900/50 px-4 py-3.5 text-xs font-black text-rose-600 hover:bg-rose-600 hover:text-white transition-all active:scale-95 shadow-sm" onclick="return confirm('Permanent action: Delete this announcement?')">
                            Remove Publicly
                        </button>
                    </form>
                    <p class="mt-3 text-[10px] text-center text-rose-400 font-bold uppercase tracking-tight">Warning: This cannot be undone.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>