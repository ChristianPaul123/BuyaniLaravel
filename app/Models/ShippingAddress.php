<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'house_number',
        'street',
        'city',
        'state',
        'country',
        'user_id',
    ];


    // protected $hidden = [
    //     'user_id',
    // ];
}
