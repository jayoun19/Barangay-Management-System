<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blotters', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->string('complainant');
            $table->string('respondent')->nullable();
            $table->text('incident_details');
            $table->enum('status', ['Open', 'Ongoing', 'Resolved'])->default('Open');
            $table->date('incident_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blotters');
    }
};