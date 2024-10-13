<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        // 'product_price',
        'product_pic',
        'product_details',
        'product_status',
        // 'product_kg',
        'category_id',
        'subcategory_id',
        'created_at',
        'updated_at',
        'product_deactivated',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function subcategory() {
        return $this->belongsTo(SubCategory::class);
    }

    public function productImages() {
        return $this->hasMany(ProductImg::class);
    }

    public function productSpecification() {
        return $this->hasMany(ProductSpecification::class);
    }

    public function productReviews() {
        return $this->hasMany(ProductRating::class);
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function favorite() {
        return $this->hasOne(Favorite::class);
    }

}
