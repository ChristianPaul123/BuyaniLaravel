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
        'product_price',
        'product_kg',
        'admin_id',
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


    public function productSpecification_logs() {
        return $this->hasMany(ProductSpecification_log::class, 'productSpecification_logs');
    }
}
