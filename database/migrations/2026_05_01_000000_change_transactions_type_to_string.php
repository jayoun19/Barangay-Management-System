<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions_tmp', function (Blueprint $table) {
            $table->id();
            $table->string('type', 255);
            $table->string('description');
            $table->decimal('amount', 12, 2);
            $table->date('transaction_date');
            $table->timestamps();
        });

        DB::statement('INSERT INTO transactions_tmp (id, type, description, amount, transaction_date, created_at, updated_at) SELECT id, type, description, amount, transaction_date, created_at, updated_at FROM transactions');

        Schema::drop('transactions');
        Schema::rename('transactions_tmp', 'transactions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('transactions_tmp', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Income', 'Expense']);
            $table->string('description');
            $table->decimal('amount', 12, 2);
            $table->date('transaction_date');
            $table->timestamps();
        });

        DB::statement('INSERT INTO transactions_tmp (id, type, description, amount, transaction_date, created_at, updated_at) SELECT id, type, description, amount, transaction_date, created_at, updated_at FROM transactions');

        Schema::drop('transactions');
        Schema::rename('transactions_tmp', 'transactions');
    }
};
