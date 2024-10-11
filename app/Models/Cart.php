<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Use the HasFactory trait to create factory instances for this model
    use HasFactory;

    // Define the fillable attributes for this model
    protected $fillable = [
        'user_id',
        'cart_total',
        'overall_cartKG',
        'total_price',
    ];

    // Define a relationship with the User model
    public function user()
    {
        // Return the relationship between the Cart and User models
        return $this->belongsTo(User::class);
    }

    // Define a relationship with the CartItem model
    public function cartItems()
    {
        // Return the relationship between the Cart and CartItem models
        return $this->hasMany(CartItem::class);
    }
}
