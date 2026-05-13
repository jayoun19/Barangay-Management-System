<x-app-layout>
    @section('header_title', 'FINANCIAL TRANSACTIONS')

    <div class="space-y-8 pb-10">
        {{-- Header Section --}}
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between px-2">
            <div class="space-y-1">
                <h2 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Financial Ledger</h2>
                <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em]">Systematic record of barangay funds</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <form method="GET" action="{{ route('transactions.index') }}" class="relative group">
                    <input type="search" name="search" value="{{ $search }}" 
                        class="w-full sm:w-64 rounded-2xl border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 pl-11 pr-4 py-3 text-xs font-bold dark:text-white focus:ring-4 focus:ring-indigo-500/10 transition-all shadow-sm" 
                        placeholder="Search records...">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </span>
                </form>

                <a href="{{ route('transactions.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-6 py-3 text-[11px] font-black text-white uppercase tracking-widest shadow-xl shadow-indigo-500/20 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    Add Entry
                </a>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden transition-all">
            <div class="overflow-x-auto overflow-y-hidden">
                <table class="w-full text-left min-w-[1000px] border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Category</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Particulars / Description</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Amount</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center min-w-[150px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        @forelse($transactions as $transaction)
                            <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-800/20 transition-colors">
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <span class="text-xs font-black text-slate-900 dark:text-white">{{ $transaction->transaction_date->format('M d, Y') }}</span>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <span class="inline-flex px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-[9px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest border border-indigo-100 dark:border-indigo-800">
                                        {{ $transaction->type }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs font-bold text-slate-600 dark:text-slate-400 leading-relaxed max-w-sm">
                                        {{ $transaction->description }}
                                    </p>
                                </td>
                                <td class="px-8 py-6 text-right whitespace-nowrap">
                                    <span class="text-sm font-black text-slate-900 dark:text-white tracking-tight">
                                        ₱{{ number_format($transaction->amount, 2) }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('transactions.edit', $transaction) }}" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 17.207l-4 1 1-4 9.414-9.414z" /></svg>
                                        </a>
                                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Archive this record?')" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest italic">No transaction records identified in the system</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6 px-4">
            {{ $transactions->links() }}
        </div>
    </div>
</x-app-layout>