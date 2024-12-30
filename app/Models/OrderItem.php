<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Use the HasFactory trait to create factory instances for this model
    use HasFactory;

    public $timestamp = true;


    // Define the fillable attributes for this model
    protected $fillable = [
    'order_id',
    'product_specification_id',
    'product_id',
    'quantity',
    'price',
    'overall_kg',
    ];

    // Define a relationship with the Order model
    public function order() {
        return $this->belongsTo(Order::class);
    }

    // Define a relationship with the Product Specificition model
    public function productSpecification() {
        return $this->belongsTo(ProductSpecification::class);
    }

    // Define a relationship with the Product model
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
