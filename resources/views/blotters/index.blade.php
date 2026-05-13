<x-app-layout>
     @section('header_title', 'BLOTTERS')
    <x-slot name="header">Blotter Cases</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" action="{{ route('blotters.index') }}" class="flex-1">
                <label class="relative block">
                    <span class="sr-only">Search</span>
                    <input type="search" name="search" value="{{ $search }}" class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 focus:border-slate-400 focus:outline-none" placeholder="Search cases...">
                </label>
            </form>
            <a href="{{ route('blotters.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 dark:bg-slate-700 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800 dark:hover:bg-slate-600 transition-colors">Add Case</a>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm transition-colors">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700 text-left text-sm">
                <thead class="bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300">
                    <tr>
                        <th class="px-6 py-4">Case Number</th>
                        <th class="px-6 py-4">Complainant</th>
                        <th class="px-6 py-4">Respondent</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($blotters as $case)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">{{ $case->case_number }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $case->complainant }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $case->respondent ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 text-xs font-bold uppercase">
                                    {{ $case->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-300">{{ $case->incident_date->format('M d, Y') }}</td>
                            <td class="px-8 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('blotters.edit', $case) }}" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 17.207l-4 1 1-4 9.414-9.414z" /></svg>
                                    </a>
                                    <form action="{{ route('blotters.destroy', $case) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Remove case?')" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500 dark:text-slate-400">No blotter cases found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="dark:text-slate-300">
            {{ $blotters->links() }}
        </div>
    </div>
    <!-- SweetAlert2 Library & Logic -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Success Toast Configuration
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#ffffff',
                color: '#0f172a',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            // Trigger Toast if session has success
            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}",
                    customClass: {
                        popup: 'rounded-3xl border border-slate-100 shadow-xl font-bold'
                    }
                });
            @endif
        });

        // Delete Confirmation Logic
        function confirmDelete(formId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This announcement will be archived permanently.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'rounded-xl bg-rose-600 px-6 py-3 text-sm font-bold text-white shadow-lg hover:bg-rose-700 transition-all mr-3 cursor-pointer',
                    cancelButton: 'rounded-xl bg-slate-100 dark:bg-slate-700 px-6 py-3 text-sm font-bold text-slate-600 dark:text-slate-200 hover:bg-slate-200 transition-all cursor-pointer',
                    popup: 'rounded-[2.5rem] dark:bg-slate-800 dark:text-white border-none shadow-2xl'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
</x-app-layout>