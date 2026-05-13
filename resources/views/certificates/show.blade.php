<x-app-layout>
    @section('header_title', 'CERTIFICATE PREVIEW')

    <div class="py-12 bg-slate-50 dark:bg-slate-950 min-h-screen print:bg-white print:py-0 transition-colors duration-300">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Action Buttons (Hidden when printing) --}}
            <div class="mb-10 flex justify-between items-center print:hidden px-4 sm:px-0">
                <a href="{{ route('certificates.index') }}" class="inline-flex items-center gap-2 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] hover:text-indigo-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to List
                </a>
                <button onclick="window.print()" class="inline-flex items-center gap-3 rounded-2xl bg-slate-900 dark:bg-indigo-600 px-8 py-3.5 text-[11px] font-black text-white uppercase tracking-[0.2em] shadow-xl shadow-indigo-500/25 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Print Document
                </button>
            </div>

            {{-- The Certificate Paper --}}
            {{-- In-adjust ang padding (p-16 to p-24) para hindi dikit sa gilid ang text --}}
            <div class="bg-white dark:bg-slate-900 shadow-2xl rounded-[3rem] border border-slate-200 dark:border-slate-800 p-16 sm:p-24 relative overflow-hidden print:shadow-none print:border-0 print:p-12 print:rounded-none transition-all">
                
                {{-- Decorative Frame (Internal) --}}
                <div class="absolute inset-8 border border-slate-100 dark:border-slate-800 rounded-[2rem] pointer-events-none print:hidden"></div>

                {{-- Header Section --}}
                <div class="text-center space-y-2 mb-20 relative">
                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.5em]">Republic of the Philippines</p>
                    <div class="space-y-1">
                        <h3 class="text-xl font-black text-slate-800 dark:text-white uppercase tracking-tight">Province of Land Nation</h3>
                        <h4 class="text-md font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide">Municipality of Hidden Leaf Village</h4>
                        <h5 class="text-sm font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-[0.2em] pt-3">Barangay Konoha</h5>
                    </div>
                    
                    <div class="flex items-center justify-center gap-8 mt-8">
                        <div class="h-px w-20 bg-gradient-to-r from-transparent to-slate-200 dark:to-slate-700"></div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em]">Office of the Barangay Chairman</p>
                        <div class="h-px w-20 bg-gradient-to-l from-transparent to-slate-200 dark:to-slate-700"></div>
                    </div>
                </div>

                {{-- Certificate Title --}}
                <div class="text-center mb-24">
                    <div class="inline-block relative">
                        <h1 class="text-5xl sm:text-7xl font-black text-slate-900 dark:text-white uppercase tracking-[0.10em] py-4 px-12">
                            {{ $certificate->type }}
                        </h1>
                        <div class="absolute bottom-0 left-0 w-full h-1.5 bg-slate-900 dark:bg-slate-700"></div>
                        <div class="absolute -bottom-2.5 left-1/2 -translate-x-1/2 w-3/4 h-0.5 bg-slate-400 dark:bg-slate-600"></div>
                    </div>
                </div>

                {{-- Body Content (Nagdagdag ng px-10 para hindi sagad sa gilid) --}}
                <div class="space-y-12 text-slate-700 dark:text-slate-300 leading-[2] text-lg max-w-3xl mx-auto px-4 sm:px-10 relative">
                    <p class="font-black text-slate-400 uppercase tracking-[0.2em] text-[11px] mb-12">To whom it may concern:</p>
                    
                    <p class="indent-16 text-justify">
                        This is to certify that <span class="font-black text-slate-900 dark:text-white border-b-2 border-indigo-500/50 pb-0.5">{{ $certificate->resident->full_name }}</span>, 
                        of legal age, <span class="font-bold text-slate-800 dark:text-slate-200 uppercase text-xs tracking-wider">{{ $certificate->resident->gender }}</span>, and a bona fide resident of 
                        <span class="font-bold text-slate-800 dark:text-slate-200">{{ $certificate->resident->address }}</span>, is known to this office to be a person of good moral character.
                    </p>

                    <p class="indent-16 text-justify">
                        According to our records, the above-named person has no derogatory record or any pending criminal case filed in this office as of this date.
                    </p>

                    @if($certificate->remarks)
                        <div class="my-12 p-10 rounded-[2rem] bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 italic text-slate-600 dark:text-slate-400 text-center text-lg leading-relaxed shadow-inner">
                            <span class="not-italic font-black text-slate-300 block mb-2 text-xs uppercase tracking-widest">Purpose/Remarks</span>
                            "{{ $certificate->remarks }}"
                        </div>
                    @endif

                    <p class="indent-16 text-justify">
                        This certification is issued upon the request of the aforementioned person for <span class="font-black text-slate-900 dark:text-white italic">whatever legal purposes</span> it may serve.
                    </p>

                    <p class="pt-10 text-right sm:text-left">
                        Issued this <span class="font-black text-slate-900 dark:text-white">{{ $certificate->issued_at->format('jS') }}</span> day of 
                        <span class="font-black text-slate-900 dark:text-white">{{ $certificate->issued_at->format('F, Y') }}</span>.
                    </p>
                </div>

                {{-- Footer: Signatures and Seal --}}
                <div class="mt-40 flex flex-col sm:flex-row items-center sm:items-end justify-between gap-16 px-10">
                    {{-- Official Seal Placeholder --}}
                    <div class="flex items-center justify-center w-40 h-40 rounded-full border-[6px] border-double border-slate-100 dark:border-slate-800 p-6">
                        <div class="text-center">
                            <p class="text-[7px] font-black text-slate-300 dark:text-slate-600 uppercase tracking-tighter leading-none mb-1 text-center">Official Seal</p>
                            <div class="w-10 h-0.5 bg-slate-100 dark:bg-slate-800 mx-auto"></div>
                        </div>
                    </div>

                    {{-- Signature Area --}}
                    <div class="text-center min-w-[300px]">
                        <div class="mb-3">
                            {{-- Space for actual signature --}}
                            <div class="h-20"></div> 
                            <p class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-tight">Hon. Naruto Uzumaki</p>
                        </div>
                        <div class="h-px w-full bg-slate-900 dark:bg-slate-400 mb-2"></div>
                        <p class="text-[11px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-[0.3em]">Barangay Chairman</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        @media print {
            body { background: white !important; }
            .dark { color-scheme: light !important; }
            .bg-white, .dark\:bg-slate-900 { background: white !important; }
            .text-slate-700, .dark\:text-slate-300, .text-slate-600 { color: #334155 !important; }
            .text-slate-900, .dark\:text-white { color: black !important; }
            .print\:hidden { display: none !important; }
            .print\:shadow-none { box-shadow: none !important; }
            .print\:p-12 { padding: 3rem !important; }
            .print\:border-0 { border: 0 !important; }
            @page {
                size: A4 portrait;
                margin: 0; /* Control margin via padding in HTML for better preview sync */
            }
        }
    </style>
</x-app-layout>