<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'billing_month',
        'base_rent',
        'meralco_total_bill',
        'meralco_rate_per_kwh',   // ← new
        'tenant_prev_reading',    // ← new
        'tenant_curr_reading',    // ← new
        'maynilad_total_bill',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Formats "2026-05" → "May 2026" for display
     */
    protected function month(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->billing_month)->format('F Y'),
        );
    }

    /**
     * How many kWh the tenant actually used this month.
     * Formula: current sub-meter reading - previous sub-meter reading
     */
    protected function tenantKwhUsed(): Attribute
    {
        return Attribute::make(
            get: fn () => max(0, $this->tenant_curr_reading - $this->tenant_prev_reading),
        );
    }

    /**
     * Tenant's Meralco share.
     * Formula: kWh used × rate per kWh
     * e.g. 45 kWh × ₱12.50 = ₱562.50
     */
    protected function meralcoBill(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->tenant_kwh_used * $this->meralco_rate_per_kwh,
        );
    }

    /**
     * Maynilad bill split in half between landlord and tenant
     */
    protected function mayniladBill(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->maynilad_total_bill / 2,
        );
    }

    /**
     * Total utilities: Meralco share + Maynilad share
     */
    protected function utilitiesTotal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->meralco_bill + $this->maynilad_bill,
        );
    }

    /**
     * Grand total the tenant owes this month
     */
    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->base_rent + $this->utilities_total,
        );
    }
}