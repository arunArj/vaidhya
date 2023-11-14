<?php

use App\Models\Doctors;
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
        Schema::create('book_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patients::class)->onDelete('cascade');
            $table->foreignIdFor(Doctors::class)->onDelete('cascade');
            $table->string('invoice_no');
            $table->string('fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_appointments');
    }
};
