<?php

use App\Models\Fees;
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
        Schema::create('fees_o_p_bill', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OPBill::class)->onDelete('cascade');
            $table->foreignIdFor(Fees::class)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_o_p_bill');
    }
};
