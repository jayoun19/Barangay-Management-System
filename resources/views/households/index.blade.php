<x-app-layout>
     @section('header_title', 'HOUSEHOLDS')
    <x-slot name="header">Households</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" action="{{ route('households.index') }}" class="flex-1">
                <label class="relative block">
                    <span class="sr-only">Search</span>
                    <input type="search" name="search" value="{{ $search }}" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:border-slate-400 focus:outline-none" placeholder="Search households...">
                </label>
            </form>
            <a href="{{ route('households.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 dark:bg-slate-700 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 dark:hover:bg-slate-600 transition-colors">Add Household</a>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700 text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Household #</th>
                        <th class="px-6 py-4">Household Head</th>
                        <th class="px-6 py-4">Members</th>
                        <th class="px-6 py-4">Address</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($households as $household)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $household->household_number }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $household->head?->full_name ?? 'Unassigned' }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $household->members->count() }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $household->address }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('households.edit', $household) }}" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 17.207l-4 1 1-4 9.414-9.414z" /></svg>
                                    </a>
                                    <form action="{{ route('households.destroy', $household) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete household?')" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400">No households created yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="dark:text-slate-300">
            {{ $households->links() }}
        </div>
    </div>
</x-app-layout>