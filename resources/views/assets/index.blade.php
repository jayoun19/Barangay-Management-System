<x-app-layout>
    <x-slot name="header">Inventory & Assets</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <form method="GET" action="{{ route('assets.index') }}" class="flex-1">
                <label class="relative block">
                    <span class="sr-only">Search</span>
                    <input type="search" name="search" value="{{ $search }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none" placeholder="Search inventory...">
                </label>
            </form>
            <a href="{{ route('assets.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white hover:bg-slate-800">Add Asset</a>
        </div>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-slate-700">
                    <tr>
                        <th class="px-6 py-4">Item</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Quantity</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($assets as $asset)
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $asset->name }}</td>
                            <td class="px-6 py-4">{{ $asset->category }}</td>
                            <td class="px-6 py-4">{{ $asset->status }}</td>
                            <td class="px-6 py-4">{{ $asset->quantity }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('assets.edit', $asset) }}" class="rounded-full bg-slate-100 px-4 py-2 text-sm text-slate-700 hover:bg-slate-200">Edit</a>
                                <form action="{{ route('assets.destroy', $asset) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-full bg-rose-100 px-4 py-2 text-sm text-rose-700 hover:bg-rose-200" onclick="return confirm('Remove asset?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">No assets found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $assets->links() }}
        </div>
    </div>
</x-app-layout>
