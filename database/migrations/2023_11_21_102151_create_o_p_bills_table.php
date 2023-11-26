<?php

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
        Schema::create('o_p_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Patients::class)->onDelete('cascade');
            $table->string("ip_number");
            $table->string("do_admission");
            $table->string("do_discharge");
            $table->string("gst_no");
            $table->string("room_no");
            $table->string("bill_no");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_p_bills');
    }
};
