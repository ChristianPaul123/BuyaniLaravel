<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Fillable attributes for the Order model
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

    // Define a relationship between the Order model and the User model
    public function user() {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' is the foreign key in the orders table
    }
}
