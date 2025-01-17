<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    use HasFactory;
    protected $table = 'product_specifications'; // Explicitly set the table name

    public $timestamp = true;

    protected $fillable = [
        'product_id',
        'specification_name',
        'product_price',
        'product_kg',
        'admin_id',
        'deactivated_date',
        'deactivated_status',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class, 'cartItems');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'orderItems');
    }


    public function productSpecificationLogs() {
        return $this->hasMany(ProductSpecificationLog::class, 'productSpecificationLogs');
    }

    public function specificProductSales() {
        return $this->hasMany(SpecificProductSales::class, 'specificProductSales');
    }
}
