<?php

use App\Models\MedicalTests;
use App\Models\OPBill;
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
        Schema::create('medical_tests_o_p_bill', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OPBill::class)->onDelete('cascade');
            $table->foreignIdFor(MedicalTests::class)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_tests_o_p_bill');
    }
};
