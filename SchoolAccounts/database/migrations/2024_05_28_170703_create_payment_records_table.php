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
        Schema::create('payment_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('PaymentID')->constrained('fees_categories')->onDelete('cascade')->onUpdate('cascade');        
            $table->foreignId('StudentID')->constrained('admit_students')->onDelete('cascade')->onUpdate('cascade');
            $table->string('PaymentMethod');
            $table->foreignId('BankID')->nullable()->constrained('bank_accounts')->onDelete('cascade')->onUpdate('cascade');            
            $table->string('AmtPaid');
            $table->string('Balance');
            $table->string('Paid')->default('0');
            $table->string('Year');
            $table->string('FeeMonth');
            $table->string('FeeMonthName');
            $table->string('FeeAssignDate');
            $table->string('FeeExpDate');
            $table->integer('IsLate')->default('0');
            $table->integer('PaidStatus')->default('0');
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
        Schema::dropIfExists('payment_records');
    }
};
