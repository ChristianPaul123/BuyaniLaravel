<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'overall_orderKG',
        'total_price',
        'payment_status',
        'shipping_address',
        //'shipping_method',
        'order_status',
    ];
}
