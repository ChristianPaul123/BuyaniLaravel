<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'specification_name',
        'specific_product_info',
        'product_price',
        'product_kg',
        'admin_id',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
