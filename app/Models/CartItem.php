<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    // Use the HasFactory trait to create factory instances for this model
    use HasFactory;

    // Define the fillable attributes for this model
    protected $fillable = [
        'cart_id',
        'product_specification_id',
        'quantity',
        'price',
        'overall_kg',
        'product_status'
    ];

    // Define a relationship with the Cart model
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Define a relationship with the Product Specification model
    public function product_specification()
    {
        return $this->belongsTo(ProductSpecification::class);
    }
}
