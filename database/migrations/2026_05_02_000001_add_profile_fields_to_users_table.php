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
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'birthdate')) {
                $table->date('birthdate')->nullable();
            }
            if (! Schema::hasColumn('users', 'age')) {
                $table->integer('age')->nullable();
            }
            if (! Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable();
            }
            if (! Schema::hasColumn('users', 'civil_status')) {
                $table->string('civil_status')->nullable();
            }
            if (! Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable();
            }
            if (! Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable();
            }
            if (! Schema::hasColumn('users', 'purok')) {
                $table->string('purok')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'birthdate',
                'age',
                'gender',
                'civil_status',
                'phone',
                'address',
                'purok',
            ]);
        });
    }
};
