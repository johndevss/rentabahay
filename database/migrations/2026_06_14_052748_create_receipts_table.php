<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            
            $table->string('billing_month');
            $table->decimal('base_rent', 10, 2);

            // Meralco sub-meter fields
            $table->decimal('meralco_total_bill', 10, 2);   // kept for reference/record
            $table->decimal('meralco_rate_per_kwh', 8, 4);  // e.g. 12.1234 PHP/kWh — from Meralco receipt
            $table->decimal('tenant_prev_reading', 10, 2);  // sub-meter reading last month
            $table->decimal('tenant_curr_reading', 10, 2);  // sub-meter reading this month

            // Maynilad
            $table->decimal('maynilad_total_bill', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};