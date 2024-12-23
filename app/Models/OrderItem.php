<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Use the HasFactory trait to create factory instances for this model
    use HasFactory;

    // Define the fillable attributes for this model
    protected $fillable = [
    'order_id',
    'productspecification_id',
    'quantity',
    'price',
    'overall_kg',
    ];

    // Define a relationship with the Order model
    public function order() {
        return $this->belongsTo(Order::class);
    }

    // Define a relationship with the Product Specificition model
    public function productspecification() {
        return $this->belongsTo(ProductSpecification::class);
    }
}
