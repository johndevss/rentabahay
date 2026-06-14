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
        // database/migrations/xxxx_xx_xx_create_receipts_table.php
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            
            // This connects the receipt to a specific tenant id row
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            
            $table->string('billing_month'); 
            $table->decimal('base_rent', 10, 2);
            $table->decimal('meralco_total_bill', 10, 2);
            $table->decimal('meralco_main_kwh', 10, 2);
            $table->decimal('tenant_kuntador_kwh', 10, 2);
            $table->decimal('maynilad_total_bill', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};