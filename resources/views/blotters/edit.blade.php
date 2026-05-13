<x-app-layout>
     @section('header_title', 'BLOTTERS')
    <x-slot name="header">Update Blotter Case</x-slot>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="{{ route('blotters.update', $blotter) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Case Number</label>
                    <input type="text" name="case_number" value="{{ old('case_number', $blotter->case_number) }}" readonly class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                        <option value="Open"{{ old('status', $blotter->status) == 'Open' ? ' selected' : '' }}>Open</option>
                        <option value="Ongoing"{{ old('status', $blotter->status) == 'Ongoing' ? ' selected' : '' }}>Ongoing</option>
                        <option value="Resolved"{{ old('status', $blotter->status) == 'Resolved' ? ' selected' : '' }}>Resolved</option>
                    </select>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Complainant</label>
                    <input type="text" name="complainant" value="{{ old('complainant', $blotter->complainant) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Respondent</label>
                    <input type="text" name="respondent" value="{{ old('respondent', $blotter->respondent) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Incident Details</label>
                    <textarea name="incident_details" rows="4" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>{{ old('incident_details', $blotter->incident_details) }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Incident Date</label>
                    <input type="date" name="incident_date" value="{{ old('incident_date', $blotter->incident_date->toDateString()) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('blotters.index') }}" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm text-slate-700">Back</a>
                <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Update Case</button>
            </div>
        </form>
    </div>
</x-app-layout>
