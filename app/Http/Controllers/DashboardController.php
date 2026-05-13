<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Blotter;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\Household;
use App\Models\Resident;
use App\Models\Transaction;
use App\Models\Ordinance;
use App\Models\Setting;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // BASIC COUNTS
        $residentCount = Resident::count();
        $totalResidents = $residentCount; // Para sa {{ $totalResidents }} sa blade
        $householdCount = Household::count();
        $blotterCount = Blotter::count();
        $issuedCertificates = Certificate::count();
        $certificateCount = $issuedCertificates;
        $activeCases = Blotter::whereIn('status', ['Open', 'Ongoing'])->count();
        $clearanceCount = Certificate::where('type', 'Barangay Clearance')->count();

        // RESIDENT ANALYTICS (Para sa bagong Professional Cards)
        $maleCount = Resident::where('gender', 'Male')->count();
        $femaleCount = Resident::where('gender', 'Female')->count();
        $youthCount = Resident::whereBetween('age', [0, 17])->count();
        $seniorCount = Resident::where('age', '>=', 60)->count();

        // FINANCIALS
        $topTransactions = Transaction::select('type', DB::raw('SUM(amount) as total'))
            ->groupBy('type')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $transactionLabels = $topTransactions->pluck('type');
        $transactionData = $topTransactions->pluck('total');

        $income = Transaction::sum('amount'); 
        $expenses = 0; 
        $balance = $income - $expenses;

        // OTHER DATA
        $announcements = Announcement::latest()->take(3)->get();
        $currentYear = now()->year;
        $settings = Setting::first();
        $recentOrdinances = Ordinance::orderBy('enacted_date', 'desc')->take(3)->get();

        $recentActivities = [
            'New resident added to the community.',
            'Household assignment completed.',
            'New blotter incident recorded.',
            'Certificate generated for a resident.',
        ];

        $barangayOfficials = [
            ['name' => 'Juan Dela Cruz', 'role' => 'Barangay Captain', 'term' => '2024-2026', 'initials' => 'JD'],
            ['name' => 'Maria Santos', 'role' => 'Kagawad - Peace & Order', 'term' => '2024-2026', 'initials' => 'MS'],
            ['name' => 'Josefa Reyes', 'role' => 'Kagawad - Health & Welfare', 'term' => '2024-2026', 'initials' => 'JR'],
            ['name' => 'Ricardo Mendoza', 'role' => 'Kagawad - Infrastructure', 'term' => '2024-2026', 'initials' => 'RM'],
        ];

        $skOfficials = [
            ['name' => 'Mark Villanueva', 'role' => 'SK Chairperson', 'term' => '2024-2026', 'initials' => 'MV'],
            ['name' => 'Carlo Lopez', 'role' => 'SK Kagawad', 'term' => '2024-2026', 'initials' => 'CL'],
            ['name' => 'Christian Ortouse', 'role' => 'SK Kagawad', 'term' => '2024-2026', 'initials' => 'CO'],
            ['name' => 'Lisa Santos', 'role' => 'SK Kagawad', 'term' => '2024-2026', 'initials' => 'LS'],
        ];

        $calendarEvents = Event::all()->map(function ($event) {
            return [
                'title' => $event->title,
                'date' => $event->date,
                'location' => $event->location,
                'description' => $event->description,
            ];
        })->toArray();

        return view('dashboard', compact(
            'residentCount',
            'totalResidents',
            'maleCount',
            'femaleCount',
            'youthCount',
            'seniorCount',
            'householdCount',
            'blotterCount',
            'issuedCertificates',
            'certificateCount',
            'activeCases',
            'clearanceCount',
            'income',
            'expenses',
            'balance',
            'recentActivities',
            'barangayOfficials',
            'skOfficials',
            'calendarEvents',
            'currentYear',
            'settings',
            'recentOrdinances',
            'announcements',
            'transactionLabels',
            'transactionData'
        ));
    }
}