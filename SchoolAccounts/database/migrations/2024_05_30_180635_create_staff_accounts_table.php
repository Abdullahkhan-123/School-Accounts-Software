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
        Schema::create('staff_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Email');
            $table->string('Phone')->nullable();
            $table->string('Image')->nullable();
            $table->string('AccountType');
            $table->string('Salary');
            $table->string('Allowances')->default('0');
            $table->string('Deductions')->default('0');
            $table->string('CanAdd');
            $table->string('CanEdit');
            $table->string('CanDrop');
            $table->string('Password')->default('12345');
            $table->string('Status')->default('0');
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
        Schema::dropIfExists('staff_accounts');
    }
};
