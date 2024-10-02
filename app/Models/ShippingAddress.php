<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'house_number',
        'street',
        'city',
        'state',
        'country',
        'zip_code',
        //'address_pic',
    ];
}
