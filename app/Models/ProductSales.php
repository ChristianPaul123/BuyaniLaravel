<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSales extends Model
{

    //TO DO: implement and refine this model class and also the migration
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

    public function SpecificProductSales() {
        return $this->hasMany(ProductSales::class);
    }

}
