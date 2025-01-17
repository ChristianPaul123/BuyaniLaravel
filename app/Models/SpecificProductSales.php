<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecificProductSales extends Model
{

      //TO DO: implement and refine this model class and also the migration
    public $timestamp = true;

    protected $fillable = [
        'product_specification_id',
        'product_sale_id',
        'order_quantity',
        'total_sales',
        'date',
    ];

    // Relationship with Product Specification
// The foreign key is 'product_sale_id' in your DB table,
    // and the local key is 'id' in product_sales.
    public function productSales()
    {
        return $this->belongsTo(ProductSales::class, 'product_sale_id', 'id');
    }

    public function productSpecification()
    {
        return $this->belongsTo(ProductSpecification::class, 'product_specification_id', 'id');
    }
}
