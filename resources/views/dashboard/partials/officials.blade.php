<div class="bg-white rounded-[2.5rem] p-8 border border-slate-200 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-bold text-slate-800">Barangay Officials</h3>
            <p class="text-sm text-slate-500">Leadership and council members</p>
        </div>
        <span class="text-xs uppercase tracking-[0.3em] text-slate-400">Officials</span>
    </div>

    <div class="space-y-4">
        @foreach($officials as $official)
            <div class="flex items-center justify-between gap-4 p-4 rounded-3xl bg-slate-50 border border-slate-100">
                <div>
                    <p class="font-semibold text-slate-900">{{ $official['name'] }}</p>
                    <p class="text-sm text-slate-500">{{ $official['role'] }}</p>
                </div>
                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-bold text-blue-700">{{ $official['term'] }}</span>
            </div>
        @endforeach
    </div>
</div>
