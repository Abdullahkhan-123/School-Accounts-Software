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
        Schema::create('admit_students', function (Blueprint $table) {
            $table->id();
            $table->string('SName');
            $table->string('SGender');
            $table->string('SDOB');
            $table->string('SImage');

            $table->string('FName');
            $table->string('FCard');
            $table->string('FEmail');
            $table->string('FPhone');
            $table->string('MPhone');
            $table->string('Religion');
            $table->longText('HomeAddress');

            $table->string('MonthlyFee');
            $table->string('IsDiscountedStudent');
            $table->string('WelcomeSmsAlert');
            $table->string('GererateAdmissionFee');

            $table->foreignId('ClassID')->constrained('s_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('AdmissionDate');
            $table->string('StudentType')->default('1');

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
        Schema::dropIfExists('admit_students');
    }
};
