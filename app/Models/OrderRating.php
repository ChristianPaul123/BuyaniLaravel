<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRating extends Model
{
    use HasFactory;

    public $timestamp = true;

    // Fillable attributes for the OrderRating model
    protected $fillable = [
        'order_id',
        'user_id',
        'comment',
        'reviewed_by',
        'delivery_rating',
        'deactivated_date',
        'deactivated_status',
        'deactivated_by',
        'rating',
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
