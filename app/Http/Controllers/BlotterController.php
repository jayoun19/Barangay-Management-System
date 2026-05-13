<?php

namespace App\Http\Controllers;

use App\Models\Blotter;
use Illuminate\Http\Request;

class BlotterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $blotters = Blotter::when($search, function ($query, $search) {
            return $query->where('case_number', 'like', "%{$search}%")
                ->orWhere('complainant', 'like', "%{$search}%")
                ->orWhere('respondent', 'like', "%{$search}%")
                ->orWhere('incident_details', 'like', "%{$search}%");
        })->orderBy('incident_date', 'desc')->paginate(12)->withQueryString();

        return view('blotters.index', compact('blotters', 'search'));
    }

    public function create()
    {
        return view('blotters.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'complainant' => 'required|string|max:255',
            'respondent' => 'nullable|string|max:255',
            'incident_details' => 'required|string',
            'status' => 'required|in:Open,Ongoing,Resolved',
            'incident_date' => 'required|date',
        ]);

        Blotter::create($data);

        return redirect()->route('blotters.index')->with('success', 'Blotter case recorded successfully.');
    }

    public function edit(Blotter $blotter)
    {
        return view('blotters.edit', compact('blotter'));
    }

    public function update(Request $request, Blotter $blotter)
    {
        $data = $request->validate([
            'case_number' => 'required|string|max:255|unique:blotters,case_number,' . $blotter->id,
            'complainant' => 'required|string|max:255',
            'respondent' => 'nullable|string|max:255',
            'incident_details' => 'required|string',
            'status' => 'required|in:Open,Ongoing,Resolved',
            'incident_date' => 'required|date',
        ]);

        $blotter->update($data);

        return redirect()->route('blotters.index')->with('success', 'Blotter case updated successfully.');
    }

    public function destroy(Blotter $blotter)
    {
        $blotter->delete();

        return redirect()->route('blotters.index')->with('success', 'Blotter case removed successfully.');
    }
}
