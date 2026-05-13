<x-app-layout>
     @section('header_title', 'HOUSEHOLDS')
    <x-slot name="header">Edit Household</x-slot>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="{{ route('households.update', $household) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Household Number</label>
                    <input type="text" name="household_number" value="{{ old('household_number', $household->household_number) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Household Head</label>
                    <select name="head_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                        <option value="">Select head</option>
                        @foreach($residents as $resident)
                            <option value="{{ $resident->id }}"{{ old('head_id', $household->head_id) == $resident->id ? ' selected' : '' }}>{{ $resident->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Household Address</label>
                    <textarea name="address" rows="3" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>{{ old('address', $household->address) }}</textarea>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Members</label>
                    <select name="members[]" multiple class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                        @foreach($residents as $resident)
                            <option value="{{ $resident->id }}"{{ in_array($resident->id, old('members', $household->members->pluck('id')->toArray())) ? ' selected' : '' }}>{{ $resident->full_name }}</option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-xs text-slate-500">Hold CTRL or CMD to select multiple residents.</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('households.index') }}" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm text-slate-700">Back</a>
                <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Update Household</button>
            </div>
        </form>
    </div>
</x-app-layout>
