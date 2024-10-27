<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRating extends Model
{
    use HasFactory;

    // Fillable attributes for the OrderRating model
    protected $fillable = [
        'order_id',
        'user_id',
        'comment',
        'reviewer_id',
        'delivery_rating',
    ];

    //Relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
