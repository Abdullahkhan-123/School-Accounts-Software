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
        Schema::create('manage_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('Date');
            $table->string('Amount');
            $table->longText('Description');
            $table->foreignId('ExpenseID')->constrained('expence_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('BankID')->constrained('bank_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('AdminStatus')->default('0');
            $table->string('AcademyCode');
            $table->string('UniqueCode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_expenses');
    }
};
