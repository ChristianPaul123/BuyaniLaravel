<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    // Use the HasFactory trait to create factory instances for this model
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'order_id',
        //'order_status',
        //'courier_id',
        'tracking_status',
        'tracking_time',
        'tracking_info',

    ];

    // Define a relationship with the Order model
    public function order() {
        return $this->belongsTo(Order::class); // 'order_id' is the foreign key in the orders table
    }
}
