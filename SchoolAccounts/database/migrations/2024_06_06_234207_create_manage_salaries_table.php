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
        Schema::create('manage_salaries', function (Blueprint $table) {
            $table->id();
            $table->string('Date');
            $table->foreignId('EmployeeID')->constrained('staff_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ExpenseID')->constrained('utlity_expense_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('BankID')->constrained('bank_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->string('Salary');
            $table->string('Allowances');
            $table->string('NetSalary');
            $table->string('Deductions');
            $table->string('TotalSalary');
            $table->longText('Description');
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
        Schema::dropIfExists('manage_salaries');
    }
};
