<?php

use App\Models\Category;
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
        Schema::create('income_expenses', function (Blueprint $table) {
            $table->id();
            $table->boolean('type');
            $table->string('purpose');
            $table->string('amount')->default(0);
            $table->string('payment_note')->nullable();
            $table->string('refund')->nullable();
            $table->string('refund_note')->nullable();
            $table->integer('cashbookable_id')->nullable();
            $table->string('cashbookable_type')->nullable();
            $table->foreignIdFor(Category::class)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_expenses');
    }
};
