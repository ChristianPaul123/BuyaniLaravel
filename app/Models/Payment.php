<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Use the HasFactory trait to create factory instances for this model
    use HasFactory;

    // Define the fillable attributes for this model
    protected $fillable = [
        'order_id',
        'payment_amount',
        'payment_method',
        //'payment_pic',
        'payment_status',
    ];

    // Define a relationship with the Order model
    public function order()
    {
        // Return the relationship between the Payment and Order models
        return $this->belongsTo(Order::class);
    }
}
