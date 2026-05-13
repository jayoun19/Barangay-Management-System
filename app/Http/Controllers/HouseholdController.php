<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\Resident;
use Illuminate\Http\Request;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the households.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $households = Household::with(['head', 'members'])
            ->when($search, function ($query, $search) {
                return $query->where('household_number', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            })
            ->orderBy('household_number')
            ->paginate(12)
            ->withQueryString();

        return view('households.index', compact('households', 'search'));
    }

    /**
     * Show the form for creating a new household.
     */
    public function create()
    {
        $residents = Resident::orderBy('last_name')->get();

        return view('households.create', compact('residents'));
    }

    /**
     * Store a newly created household in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'head_id' => 'nullable|exists:residents,id',
            'address' => 'required|string',
            'members' => 'nullable|array',
            'members.*' => 'exists:residents,id',
        ]);

        // Ang household_number ay automatic na gagawin ng Model's booted method
        $household = Household::create($data);
        
        if ($request->has('members')) {
            $household->members()->sync($request->input('members', []));
        }

        return redirect()->route('households.index')->with('success', 'Household created with automated ID.');
    }

    /**
     * Show the form for editing the specified household.
     */
    public function edit(Household $household)
    {
        $residents = Resident::orderBy('last_name')->get();

        return view('households.edit', compact('household', 'residents'));
    }

    /**
     * Update the specified household in storage.
     */
    public function update(Request $request, Household $household)
    {
        $data = $request->validate([
            'head_id' => 'nullable|exists:residents,id',
            'address' => 'required|string',
            'members' => 'nullable|array',
            'members.*' => 'exists:residents,id',
        ]);

        $household->update($data);
        $household->members()->sync($request->input('members', []));

        return redirect()->route('households.index')->with('success', 'Household updated successfully.');
    }

    /**
     * Remove the specified household from storage.
     */
    public function destroy(Household $household)
    {
        $household->delete();

        return redirect()->route('households.index')->with('success', 'Household deleted successfully.');
    }
}