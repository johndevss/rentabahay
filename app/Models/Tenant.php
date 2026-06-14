<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['name', 'is_active'];

    // A Tenant can have many historical receipts over time
    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}

