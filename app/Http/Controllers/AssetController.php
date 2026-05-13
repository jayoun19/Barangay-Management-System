<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $assets = Asset::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->orderBy('name')->paginate(12)->withQueryString();

        return view('assets.index', compact('assets', 'search'));
    }

    public function create()
    {
        return view('assets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|in:Available,In-use,Damaged',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Asset::create($data);

        return redirect()->route('assets.index')->with('success', 'Asset added successfully.');
    }

    public function edit(Asset $asset)
    {
        return view('assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|in:Available,In-use,Damaged',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $asset->update($data);

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset removed successfully.');
    }
}
