<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandlordProfile extends Model
{
    protected $table = 'landlord_profile';

    protected $fillable = [
        'full_name',
        'address', 
        'contact_number',
        'email',
    ];
}