<?php

use App\Models\LabInvoice;
use App\Models\MedicalTests;
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
        Schema::create('lab_invoice_medical_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LabInvoice::class)->onDelete('cascade');
            $table->foreignIdFor(MedicalTests::class)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_invoice_medical_tests');
    }
};
