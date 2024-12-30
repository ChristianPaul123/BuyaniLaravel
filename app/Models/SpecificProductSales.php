<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificProductSales extends Model
{

    public $timestamp = true;

    protected $fillable = [
        'product_specification_id',
        'product_sale_id',
        'order_quantity',
        'total_sales',
        'date',
    ];

    // Relationship with Product Specification
    public function productSpecification()
    {
        return $this->belongsTo(ProductSpecification::class);
    }
}
