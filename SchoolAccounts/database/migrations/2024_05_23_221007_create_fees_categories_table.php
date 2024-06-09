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
        Schema::create('fees_categories', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->string('PaymentType');
            $table->string('Amount');
            $table->longText('Description');
            $table->text('Date');
            $table->foreignId('ClassID')->constrained('s_classes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('fees_categories');
    }
};
