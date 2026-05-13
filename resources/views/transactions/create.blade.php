<x-app-layout>
    @section('header_title', 'ADD TRANSACTION')
    <x-slot name="header">Add Transaction</x-slot>

    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <form action="{{ route('transactions.store') }}" method="POST" class="space-y-8">
            @csrf
            <div class="grid gap-6 lg:grid-cols-2">
                {{-- Dynamic Type Input with Specific Barangay Categories --}}
                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">Transaction Category / Type</label>
                    <input list="transaction-types" name="type" value="{{ old('type') }}" 
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 focus:outline-none" 
                        placeholder="Search or type category..." required>
                    
                    <datalist id="transaction-types">
                        <option value="Clearances & Certificates">
                        <option value="Permits & Endorsements">
                        <option value="Blotter & Complaints">
                        <option value="Health & Social Services">
                        <option value="Household & Residency Records">
                        <option value="Financial Transactions">
                        <option value="Community Programs & Events">
                        <option value="Inventory & Asset Requests">
                        <option value="Certificates for Legal/Official Use">
                        <option value="Others / Miscellaneous">
                    </datalist>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">Amount (₱)</label>
                    <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" 
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 focus:outline-none" 
                        placeholder="0.00" required>
                </div>

                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-bold text-slate-700">Particulars / Description</label>
                    <input type="text" name="description" value="{{ old('description') }}" 
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 focus:outline-none" 
                        placeholder="Specific details (e.g., Payment for Business Permit - Juan Dela Cruz)" required>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-bold text-slate-700">Transaction Date</label>
                    <input type="date" name="transaction_date" value="{{ old('transaction_date', now()->toDateString()) }}" 
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:ring-2 focus:ring-slate-900 focus:outline-none" required>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('transactions.index') }}" class="rounded-2xl border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">Back</a>
                <button type="submit" class="rounded-2xl bg-slate-900 px-8 py-3 text-sm font-semibold text-white hover:bg-slate-800 transition-shadow shadow-lg shadow-slate-200">Save Transaction</button>
            </div>
        </form>
    </div>
</x-app-layout>