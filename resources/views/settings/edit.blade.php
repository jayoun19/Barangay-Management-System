<x-app-layout>
    @section('header_title', 'SETTINGS')
    <x-slot name="header">Barangay Settings</x-slot>

    <div class="rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition-colors">
        <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Barangay Name</label>
                    <input type="text" name="barangay_name" value="{{ old('barangay_name', $settings->barangay_name) }}" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:border-slate-400 focus:outline-none" required>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Address</label>
                    <textarea name="address" rows="3" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:border-slate-400 focus:outline-none">{{ old('address', $settings->address) }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Contact Email</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $settings->contact_email) }}" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:border-slate-400 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Contact Phone</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings->contact_phone) }}" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:border-slate-400 focus:outline-none">
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Logo URL</label>
                    <input type="text" name="logo_path" value="{{ old('logo_path', $settings->logo_path) }}" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:border-slate-400 focus:outline-none">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-2xl bg-slate-900 dark:bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-slate-800 dark:hover:bg-blue-700 transition-colors">Save Settings</button>
            </div>
        </form>
    </div>
</x-app-layout>