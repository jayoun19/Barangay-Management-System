<x-app-layout>
    @section('header_title', 'RESIDENTS')
    <x-slot name="header">Edit Resident</x-slot>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="{{ route('residents.update', $resident) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            <div class="grid gap-6 lg:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $resident->first_name) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $resident->last_name) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Age</label>
                    <input type="number" name="age" value="{{ old('age', $resident->age) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Gender</label>
                    <select name="gender" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>
                        <option value="Male"{{ old('gender', $resident->gender) == 'Male' ? ' selected' : '' }}>Male</option>
                        <option value="Female"{{ old('gender', $resident->gender) == 'Female' ? ' selected' : '' }}>Female</option>
                        <option value="Other"{{ old('gender', $resident->gender) == 'Other' ? ' selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Contact</label>
                    <input type="text" name="contact" value="{{ old('contact', $resident->contact) }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm">
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Address</label>
                    <textarea name="address" rows="4" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" required>{{ old('address', $resident->address) }}</textarea>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('residents.index') }}" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm text-slate-700">Back</a>
                <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white">Update Resident</button>
            </div>
        </form>
    </div>
</x-app-layout>
