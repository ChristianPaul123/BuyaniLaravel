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
        //'shipping_method',
        'order_status',
        'shipping_address',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_street',
        'customer_city',
        'customer_state',
        'customer_zip_code',
        'customer_country',
        'customer_house_number',
    ];
}
