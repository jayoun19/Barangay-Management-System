<x-app-layout>
    @section('header_title', 'ANNOUNCEMENTS')
    
    <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Public Feed</h2>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Broadcast updates and community news.</p>
        </div>
        <a href="{{ route('announcements.create') }}" class="group inline-flex items-center gap-2 rounded-2xl bg-indigo-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition-all active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Create Announcement
        </a>
    </div>

    <div class="grid gap-6">
        @forelse($announcements as $announcement)
            <div class="group relative overflow-hidden rounded-[2.5rem] border border-slate-100 dark:border-slate-700/50 bg-white dark:bg-slate-800 p-8 shadow-sm hover:shadow-xl hover:shadow-slate-200/50 dark:hover:shadow-none transition-all duration-300">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                    
                    <div class="flex-1 space-y-4">
                        <div class="flex items-center gap-3">
                            @php
                                $categoryColors = [
                                    'Emergency' => 'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-900/30 dark:text-rose-400 dark:border-rose-800',
                                    'Meeting' => 'bg-indigo-50 text-indigo-600 border-indigo-100 dark:bg-indigo-900/30 dark:text-indigo-400 dark:border-indigo-800',
                                    'Health' => 'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-900/30 dark:text-emerald-400 dark:border-emerald-800',
                                    'Event' => 'bg-amber-50 text-amber-600 border-amber-100 dark:bg-amber-900/30 dark:text-amber-400 dark:border-amber-800',
                                    'General' => 'bg-slate-50 text-slate-600 border-slate-100 dark:bg-slate-700 dark:text-slate-300 dark:border-slate-600'
                                ];
                                $colorClass = $categoryColors[$announcement->category] ?? $categoryColors['General'];
                            @endphp
                            
                            <span class="inline-flex items-center rounded-xl border {{ $colorClass }} px-3 py-1 text-[10px] font-black uppercase tracking-widest">
                                {{ $announcement->category }}
                            </span>
                            
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-tighter">
                                {{ $announcement->created_at->format('M d, Y • g:i A') }}
                            </span>
                        </div>

                        <div>
                            <a href="{{ route('announcements.show', $announcement) }}" class="text-2xl font-black text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors leading-tight block">
                                {{ $announcement->title }}
                            </a>
                            <p class="mt-3 text-slate-600 dark:text-slate-400 leading-relaxed line-clamp-2 font-medium">
                                {{ $announcement->content }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <div class="h-8 w-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center font-bold text-slate-500 text-xs shadow-inner">
                                {{ strtoupper(substr($announcement->user->name, 0, 1)) }}
                            </div>
                            <span class="text-xs font-bold text-slate-500 dark:text-slate-400">Posted by {{ $announcement->user->name }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 self-end lg:self-start">
                        <a href="{{ route('announcements.edit', $announcement) }}" class="inline-flex h-11 items-center justify-center rounded-xl bg-slate-50 dark:bg-slate-700/50 px-5 text-xs font-bold text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
                            Edit
                        </a>
                        <form id="delete-form-{{ $announcement->id }}" action="{{ route('announcements.destroy', $announcement) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" 
                                    onclick="confirmDelete('delete-form-{{ $announcement->id }}')"
                                    class="inline-flex h-11 items-center justify-center rounded-xl bg-rose-50 dark:bg-rose-900/20 px-5 text-xs font-bold text-rose-600 dark:text-rose-400 hover:bg-rose-100 dark:hover:bg-rose-900/40 transition-all">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-[2.5rem] border-2 border-dashed border-slate-200 dark:border-slate-700 p-20 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-50 dark:bg-slate-800">
                    <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 2v4a2 2 0 002 2h4"/></svg>
                </div>
                <h3 class="mt-4 text-lg font-bold text-slate-900 dark:text-white">No announcements found</h3>
                <p class="mt-1 text-sm text-slate-500">Be the first to share an update with the community.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $announcements->links() }}
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