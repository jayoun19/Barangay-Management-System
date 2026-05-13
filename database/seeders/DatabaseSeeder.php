<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Blotter;
use App\Models\Certificate;
use App\Models\Household;
use App\Models\Ordinance;
use App\Models\Resident;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Barangay Admin',
                'password' => bcrypt('password'),
            ]
        );

        $residentData = [
            ['first_name' => 'Juan', 'last_name' => 'Dela Cruz', 'age' => 30, 'gender' => 'Male', 'contact' => '09171234567', 'address' => '123 Main St, Barangay Centro'],
            ['first_name' => 'Maria', 'last_name' => 'Santos', 'age' => 27, 'gender' => 'Female', 'contact' => '09171234568', 'address' => '456 Elm St, Barangay Norte'],
            ['first_name' => 'Pedro', 'last_name' => 'Reyes', 'age' => 45, 'gender' => 'Male', 'contact' => '09171234569', 'address' => '789 Oak Ave, Barangay Sur'],
        ];

        $residents = collect($residentData)->map(function ($data) {
            return Resident::updateOrCreate(
                ['first_name' => $data['first_name'], 'last_name' => $data['last_name']],
                $data
            );
        });

        $household = Household::updateOrCreate(
            ['household_number' => 'HH-1001'],
            [
                'head_id' => $residents[0]->id,
                'address' => '123 Main St, Barangay Centro',
            ]
        );
        $household->members()->sync([$residents[0]->id, $residents[1]->id]);

        Certificate::updateOrCreate(
            ['resident_id' => $residents[0]->id, 'type' => 'Barangay Clearance'],
            [
                'issued_at' => now()->subDays(2),
                'remarks' => 'For employment purposes',
            ]
        );

        Transaction::updateOrCreate(
            ['type' => 'Income', 'description' => 'Community tax collection'],
            [
                'amount' => 5000,
                'transaction_date' => now()->subDays(4),
            ]
        );
        Transaction::updateOrCreate(
            ['type' => 'Expense', 'description' => 'Office supplies purchase'],
            [
                'amount' => 1500,
                'transaction_date' => now()->subDays(2),
            ]
        );

        Blotter::updateOrCreate(
            ['case_number' => 'B-1001'],
            [
                'complainant' => 'Juan Dela Cruz',
                'respondent' => 'Unknown',
                'incident_details' => 'Noise complaint during community event.',
                'status' => 'Open',
                'incident_date' => now()->subDays(1),
            ]
        );

        Ordinance::updateOrCreate(
            ['ordinance_number' => 'ORD-2026-001'],
            [
                'title' => 'Anti-Littering Ordinance',
                'description' => 'Prohibits littering in public areas and designates penalties.',
                'enacted_date' => now()->subWeeks(2),
            ]
        );

        Asset::updateOrCreate(
            ['name' => 'Office Chair'],
            [
                'category' => 'Furniture',
                'status' => 'Available',
                'quantity' => 12,
                'description' => 'Stackable chairs for community meetings.',
            ]
        );

        Announcement::updateOrCreate(
            ['title' => 'Barangay Assembly Today'],
            [
                'content' => 'May barangay assembly sa multi-purpose hall ngayong hapon.',
                'category' => 'Meeting',
                'user_id' => 1,
            ]
        );

        Announcement::updateOrCreate(
            ['title' => 'Health Check-up'],
            [
                'content' => 'Libreng health check-up para sa lahat ng residente bukas sa barangay clinic.',
                'category' => 'Health',
                'user_id' => 1,
            ]
        );

        Announcement::updateOrCreate(
            ['title' => 'Flood Advisory'],
            [
                'content' => 'Maghanda sa posibleng pagbaha dahil sa malakas na ulan sa susunod na araw.',
                'category' => 'Emergency',
                'user_id' => 1,
            ]
        );

        Setting::updateOrCreate(
            ['id' => 1],
            [
                'barangay_name' => 'Barangay San Roque',
                'address' => 'Barangay San Roque, City Center',
                'contact_email' => 'info@sanroque.gov.ph',
                'contact_phone' => '09181234567',
            ]
        );
    }
}
