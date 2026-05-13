<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Resident;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $certificates = Certificate::with('resident')
            ->when($search, function ($query, $search) {
                return $query->where('type', 'like', "%{$search}%")
                    ->orWhereHas('resident', function ($query) use ($search) {
                        $query->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('issued_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $residents = Resident::orderBy('last_name')->get();

        return view('certificates.index', compact('certificates', 'residents', 'search'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'type' => 'required|in:Barangay Clearance,Indigency,Residency',
            'issued_at' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        Certificate::create($data);

        return redirect()->route('certificates.index')->with('success', 'Certificate generated successfully.');
    }

    public function show(Certificate $certificate)
    {
        return view('certificates.show', compact('certificate'));
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('certificates.index')->with('success', 'Certificate removed successfully.');
    }
}
