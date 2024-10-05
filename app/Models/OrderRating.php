<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'feedback',
        'review_by',
        'customer_rating',
    ];

    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
