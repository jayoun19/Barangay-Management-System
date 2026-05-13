<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Populate birthdate for users na walang birthdate value
        // Default birthdate para sa existing users (e.g., 22 years old now)
        DB::table('users')
            ->whereNull('birthdate')
            ->update([
                'birthdate' => now()->subYears(22)->toDateString(),
                'age' => 22,
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Optional: revert back to null if needed
        DB::table('users')
            ->whereNotNull('birthdate')
            ->update([
                'birthdate' => null,
            ]);
    }
};
