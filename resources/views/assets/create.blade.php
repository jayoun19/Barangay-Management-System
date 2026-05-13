<x-app-layout>
    <x-slot name="header">Add Asset</x-slot>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="{{ route('assets.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Item Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                        <option value="Available"{{ old('status') == 'Available' ? ' selected' : '' }}>Available</option>
                        <option value="In-use"{{ old('status') == 'In-use' ? ' selected' : '' }}>In-use</option>
                        <option value="Damaged"{{ old('status') == 'Damaged' ? ' selected' : '' }}>Damaged</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity', 1) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" min="0" required>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" rows="4" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('assets.index') }}" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm text-slate-700">Back</a>
                <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Save Asset</button>
            </div>
        </form>
    </div>
</x-app-layout>
