<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSales extends Model
{

    public $timestamp = true;

    protected $fillable = [
        'product_id',
        'order_count',
        'total_sales',
        'date',
    ];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
