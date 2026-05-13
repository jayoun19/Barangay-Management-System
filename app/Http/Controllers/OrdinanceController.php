<?php

namespace App\Http\Controllers;

use App\Models\Ordinance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdinanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $ordinances = Ordinance::when($search, function ($query, $search) {
            return $query->where('ordinance_number', 'like', "%{$search}%")
                ->orWhere('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->orderBy('enacted_date', 'desc')->paginate(12)->withQueryString();

        return view('ordinances.index', compact('ordinances', 'search'));
    }

    public function create()
    {
        return view('ordinances.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'enacted_date' => 'required|date',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('document')) {
            $data['document_path'] = $request->file('document')->store('documents', 'public');
        }

        Ordinance::create($data);

        return redirect()->route('ordinances.index')->with('success', 'Ordinance added successfully with automated ID.');
    }

    public function edit(Ordinance $ordinance)
    {
        return view('ordinances.edit', compact('ordinance'));
    }

    public function update(Request $request, Ordinance $ordinance)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'enacted_date' => 'required|date',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('document')) {
            // Delete old document if new one is uploaded
            if ($ordinance->document_path) {
                Storage::disk('public')->delete($ordinance->document_path);
            }
            $data['document_path'] = $request->file('document')->store('documents', 'public');
        }

        $ordinance->update($data);

        return redirect()->route('ordinances.index')->with('success', 'Ordinance updated successfully.');
    }

    public function destroy(Ordinance $ordinance)
    {
        if ($ordinance->document_path) {
            Storage::disk('public')->delete($ordinance->document_path);
        }
        $ordinance->delete();

        return redirect()->route('ordinances.index')->with('success', 'Ordinance deleted successfully.');
    }
}