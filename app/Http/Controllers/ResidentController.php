<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $residents = Resident::when($search, function ($query, $search) {
            return $query->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('contact', 'like', "%{$search}%");
        })->orderBy('last_name')->paginate(12)->withQueryString();

        return view('residents.index', compact('residents', 'search'));
    }

    public function create()
    {
        return view('residents.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:Male,Female,Other',
            'contact' => 'nullable|string|max:100',
            'address' => 'required|string|max:65000',
        ]);

        Resident::create($data);

        return redirect()->route('residents.index')->with('success', 'Resident created successfully.');
    }

    public function edit(Resident $resident)
    {
        return view('residents.edit', compact('resident'));
    }

    public function update(Request $request, Resident $resident)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|in:Male,Female,Other',
            'contact' => 'nullable|string|max:100',
            'address' => 'required|string|max:65000',
        ]);

        $resident->update($data);

        return redirect()->route('residents.index')->with('success', 'Resident updated successfully.');
    }

    public function destroy(Resident $resident)
    {
        $resident->delete();

        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully.');
    }
}
