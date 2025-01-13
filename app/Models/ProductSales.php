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
        // If product_sales table has column 'product_id'
        // and products table has primary key 'id',
        // the default is fine. Or you can be explicit:
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function SpecificProductSales() {
        return $this->hasMany(ProductSales::class);
    }

}
