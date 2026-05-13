<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::first() ?? new Setting();

        return view('settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'barangay_name' => 'required|string|max:255',
            'logo_path' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
        ]);

        Setting::updateOrCreate(['id' => 1], $data);

        return redirect()->route('settings.edit')->with('success', 'Barangay settings saved successfully.');
    }
}
