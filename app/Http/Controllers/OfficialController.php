<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficialController extends Controller
{
    public function index()
    {
        $barangayOfficials = [
            ['name' => 'Naruto Uzumaki', 'role' => 'Barangay Captain', 'term' => '2024-2026', 'photo' => 'naruto.png'],
            ['name' => 'Minato Namikaze', 'role' => 'Kagawad - Peace & Order', 'term' => '2024-2026', 'photo' => 'minato.png'],
            ['name' => 'Sakura Haruno', 'role' => 'Kagawad - Health & Welfare', 'term' => '2024-2026', 'photo' => 'Sakura.png'],
            ['name' => 'Kakashi Hatake', 'role' => 'Kagawad - Infrastructure', 'term' => '2024-2026', 'photo' => 'kakashi.png'],
        ];

        $skOfficials = [
            ['name' => 'Sasuke Uchiha', 'role' => 'SK Chairperson', 'term' => '2024-2026', 'photo' => 'sasuke.png'],
            ['name' => 'Madara Uchiha', 'role' => 'SK Kagawad', 'term' => '2024-2026', 'photo' => 'madara.png'],
            ['name' => 'Obito Uchiha', 'role' => 'SK Kagawad', 'term' => '2024-2026', 'photo' => 'obito.png'],
            ['name' => 'Shisui Uchiha', 'role' => 'SK Kagawad', 'term' => '2024-2026', 'photo' => 'shisui.png'],
        ];

        return view('officials.index', compact('barangayOfficials', 'skOfficials'));
    }
}