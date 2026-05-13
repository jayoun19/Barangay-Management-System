<x-app-layout>
    @section('header_title', 'ORDINANCES')
    <x-slot name="header">Barangay Ordinances</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" action="{{ route('ordinances.index') }}" class="w-full max-w-md">
                <input type="search" name="search" value="{{ $search }}" 
                    class="w-full rounded-[1.25rem] border-none bg-white dark:bg-slate-800 pl-5 py-3.5 text-xs font-bold ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 outline-none" 
                    placeholder="Search by Title or Number...">
            </form>
            <a href="{{ route('ordinances.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 dark:bg-blue-600 px-6 py-3.5 text-[10px] font-black uppercase tracking-widest text-white hover:opacity-90 transition-all">
                Add Ordinance
            </a>
        </div>

        <div class="overflow-hidden rounded-[2rem] border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xl shadow-slate-100/50 dark:shadow-none">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">ID Number</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Title</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        @forelse($ordinances as $ordinance)
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="px-8 py-5 text-sm font-black text-blue-600 dark:text-blue-400">{{ $ordinance->ordinance_number }}</td>
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-900 dark:text-white line-clamp-1">{{ $ordinance->title }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase">Enacted: {{ $ordinance->enacted_date->format('M d, Y') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($ordinance->document_path)
                                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 text-[10px] font-black uppercase">Documented</span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400 text-[10px] font-black uppercase">Text Only</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('ordinances.edit', $ordinance) }}" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 17.207l-4 1 1-4 9.414-9.414z" /></svg>
                                    </a>
                                    <form action="{{ route('ordinances.destroy', $ordinance) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete ordinance?')" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="px-8 py-10 text-center text-slate-400 text-[10px] font-black uppercase tracking-widest">No Ordinances Recorded</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">{{ $ordinances->links() }}</div>
    </div>
</x-app-layout>