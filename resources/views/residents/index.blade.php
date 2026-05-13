<x-app-layout>
    @section('header_title', 'RESIDENTS')
    <x-slot name="header">Residents Directory</x-slot>

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="space-y-6">
        <!-- Search & Actions -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" action="{{ route('residents.index') }}" class="w-full max-w-md">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="search" name="search" value="{{ $search }}" 
                        class="w-full rounded-2xl border-none bg-white dark:bg-slate-800 pl-11 pr-4 py-3 text-xs font-bold text-slate-900 dark:text-slate-100 shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 focus:ring-2 focus:ring-blue-500 transition-all outline-none" 
                        placeholder="Search residents by name or address...">
                </div>
            </form>
            <a href="{{ route('residents.create') }}" 
                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 dark:bg-blue-600 px-6 py-3 text-[10px] font-black uppercase tracking-widest text-white hover:bg-slate-800 dark:hover:bg-blue-500 shadow-lg shadow-slate-200 dark:shadow-none transition-all active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                Add Resident
            </a>
        </div>

        <!-- Table Container -->
        <div class="overflow-hidden rounded-[2rem] border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-xl shadow-slate-100/50 dark:shadow-none">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/50">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">Resident Name</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">Age/Gender</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">Contact Info</th>
                            <th class="px-6 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em]">Home Address</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.15em] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        @forelse($residents as $resident)
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center font-black text-slate-500 text-xs">
                                        {{ substr($resident->first_name, 0, 1) }}{{ substr($resident->last_name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $resident->full_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $resident->age }} yrs old</span>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">{{ $resident->gender }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-sm font-medium text-slate-600 dark:text-slate-400">
                                {{ $resident->contact ?? '---' }}
                            </td>
                            <td class="px-6 py-5 text-xs font-medium text-slate-600 dark:text-slate-400">
                                <span class="line-clamp-1 max-w-[200px]">{{ $resident->address }}</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('residents.edit', $resident) }}" class="p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    <form action="{{ route('residents.destroy', $resident) }}" method="POST" class="inline delete-form">
                                        @csrf @method('DELETE')
                                        <button type="button" class="delete-btn p-2 rounded-xl bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-rose-600 dark:hover:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-tight">No Residents Found</h3>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $residents->links() }}
        </div>
    </div>

    <!-- Success Pop-up Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Success Toast
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

            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}",
                    customClass: {
                        popup: 'rounded-3xl border border-slate-100 shadow-xl font-bold'
                    }
                });
            @endif

            // Delete Confirmation (Optional but Professional)
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This resident record will be archived.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2563eb', // Blue-600
                        cancelButtonColor: '#f43f5e', // Rose-500
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        background: '#ffffff',
                        color: '#0f172a',
                        customClass: {
                            popup: 'rounded-[2.5rem] p-8',
                            confirmButton: 'rounded-xl px-6 py-3 text-[10px] font-black uppercase tracking-widest',
                            cancelButton: 'rounded-xl px-6 py-3 text-[10px] font-black uppercase tracking-widest'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>