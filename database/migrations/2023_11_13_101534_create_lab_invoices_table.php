<?php

use App\Models\MedicalTests;
use App\Models\Patients;
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
        Schema::create('lab_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patients::class)->onDelete('cascade');
            $table->string('invoice_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_invoices');
    }
};
