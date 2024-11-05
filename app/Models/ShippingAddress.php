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
        'zip_code',
        'user_id',
        'shipping_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // protected $hidden = [
    //     'user_id',
    // ];
}
