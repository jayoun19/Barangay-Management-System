<x-app-layout>
     @section('header_title', 'CERTIFICATES')
    <x-slot name="header">Certificates</x-slot>

    <div class="space-y-6">
        {{-- Generate Certificate Section --}}
        <div class="rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition-colors">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Generate Certificate</h2>
            <form action="{{ route('certificates.store') }}" method="POST" class="mt-6 grid gap-6 lg:grid-cols-2">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Resident</label>
                    <select name="resident_id" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100" required>
                        <option value="">Choose resident</option>
                        @foreach($residents as $resident)
                            <option value="{{ $resident->id }}">{{ $resident->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Certificate Type</label>
                    <select name="type" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100" required>
                        <option value="Barangay Clearance">Barangay Clearance</option>
                        <option value="Indigency">Indigency</option>
                        <option value="Residency">Residency</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Issue Date</label>
                    <input type="date" name="issued_at" value="{{ old('issued_at', now()->toDateString()) }}" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100" required>
                </div>
                <div class="lg:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700 dark:text-slate-300">Remarks</label>
                    <textarea name="remarks" rows="3" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100">{{ old('remarks') }}</textarea>
                </div>
                <div class="lg:col-span-2 flex items-center gap-3">
                    <button type="submit" class="rounded-2xl bg-slate-900 dark:bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 dark:hover:bg-blue-700 transition-colors">Create Certificate</button>
                </div>
            </form>
        </div>

        {{-- Certificate List Table --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm transition-colors">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700 text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Resident</th>
                        <th class="px-6 py-4">Issued At</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($certificates as $certificate)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4 text-slate-900 dark:text-white font-medium">{{ $certificate->type }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $certificate->resident->full_name }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $certificate->issued_at->format('M d, Y') }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('certificates.show', $certificate) }}" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <form action="{{ route('certificates.destroy', $certificate) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete certificate?')" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400">No certificates generated yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="dark:text-slate-300">
            {{ $certificates->links() }}
        </div>
    </div>
</x-app-layout>