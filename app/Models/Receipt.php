<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Receipt extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tenant_id', 'billing_month', 'base_rent', 
        'meralco_total_bill', 'meralco_main_kwh', 
        'tenant_kuntador_kwh', 'maynilad_total_bill'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * 1. Dynamic Attribute for Month Formatting
     * Converts "2026-05" from input type="month" into "May 2026" for your dashboard table.
     */
    protected function month(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->billing_month)->format('F Y'),
        );
    }

    /**
     * 2. Dynamic Attribute for Utilities Total
     * Automatically returns ($this->utilities_total) in your Blade views
     */
    protected function utilitiesTotal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->meralco_bill + $this->maynilad_bill,
        );
    }

    /**
     * 3. Dynamic Attribute for Grand Total
     * Automatically returns ($this->total) in your Blade views
     */
    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->base_rent + $this->utilities_total,
        );
    }

    /**
     * 4. Tenant's share of Meralco bill
     * Formula: (tenant's kWh / main meter kWh) × total Meralco bill
     */
    protected function meralcoBill(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->meralco_main_kwh > 0
                ? ($this->tenant_kuntador_kwh / $this->meralco_main_kwh) * $this->meralco_total_bill
                : 0,
        );
    }

    /**
     * 5. Maynilad bill (passed through directly)
     * No sub-metering for water, so the tenant pays the full amount entered
     */
    protected function mayniladBill(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->maynilad_total_bill,
        );
    }
}