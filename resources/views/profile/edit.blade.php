<x-app-layout>
    @section('header_title', 'RESIDENT PROFILE')

    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Main Profile Card --}}
            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-200 dark:border-slate-800 overflow-hidden">
                
                <div class="md:flex">
                    {{-- Left Sidebar: Avatar & Quick Info --}}
                    <div class="md:w-1/3 bg-slate-50/50 dark:bg-slate-800/30 p-10 border-r border-slate-100 dark:border-slate-800 flex flex-col items-center">
                        <div class="relative group">
                            <label for="profile_photo" class="cursor-pointer block">
                                <div class="h-40 w-40 rounded-full border-4 border-white dark:border-slate-700 shadow-2xl overflow-hidden bg-slate-200 dark:bg-slate-800 relative">
                                    <img id="preview" src="{{ $user->profile_photo_url }}" class="h-full w-full object-cover">
                                </div>
                            </label>
                        </div>
                        <div class="mt-4 text-center">
                            <label for="profile_photo" class="inline-flex items-center gap-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2 text-xs font-bold uppercase tracking-[0.25em] text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700 cursor-pointer">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Change Photo
                            </label>
                            {{-- Hidden file input kailangan ito para gumana ang upload --}}
                            <input type="file" id="profile_photo" name="profile_photo" class="hidden" onchange="previewImage(event)" form="profile-update-form">
                        </div>
                        
                        <div class="mt-6 text-center">
                            <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tight">{{ $user->name }}</h3>
                            <p class="text-xs font-bold text-blue-600 dark:text-blue-400 uppercase tracking-widest mt-1">Registered Resident</p>
                        </div>

                        <div class="w-full mt-8 space-y-4">
                            {{-- Email Display --}}
                            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Address</p>
                                <p class="text-xs font-bold text-slate-700 dark:text-slate-300 truncate">{{ $user->email }}</p>
                            </div>

                            
                        </div>
                    </div>

                    {{-- Right Content: Form --}}
                    <div class="md:w-2/3 p-10">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Secondary Sections: Security --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm">
                    @include('profile.partials.update-password-form')
                </div>
                <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>