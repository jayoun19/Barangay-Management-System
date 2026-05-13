<x-app-layout>
    @section('header_title', 'ORDINANCES')
    <x-slot name="header">Edit Ordinance</x-slot>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="{{ route('ordinances.update', $ordinance) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Ordinance Number</label>
                    <input type="text" name="ordinance_number" value="{{ old('ordinance_number', $ordinance->ordinance_number) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Enacted Date</label>
                    <input type="date" name="enacted_date" value="{{ old('enacted_date', $ordinance->enacted_date->toDateString()) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Title</label>
                    <input type="text" name="title" value="{{ old('title', $ordinance->title) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" rows="4" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>{{ old('description', $ordinance->description) }}</textarea>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Replace Document</label>
                    <input type="file" name="document" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                    @if($ordinance->document_path)
                        <p class="mt-2 text-sm text-slate-500">Current file uploaded.</p>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('ordinances.index') }}" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm text-slate-700">Back</a>
                <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Update Ordinance</button>
            </div>
        </form>
    </div>
</x-app-layout>
