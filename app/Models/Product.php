<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamp = true;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_pic',
        'product_details',
        'product_status',
        'category_id',
        'subcategory_id',
        'is_featured,',
        'deactivated_date',
        'deactivated_status',
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

    public function productRatings() {
        return $this->hasMany(ProductRating::class);
    }

    public function productSpecification() {
        return $this->hasMany(ProductSpecification::class);
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

    public function inventory() {
        return $this->hasOne(Inventory::class, 'product_id');
    }

    public function productImgs() {
        return $this->hasMany(Product::class, 'product_id');
    }

    public function getStatusLabelAttribute()
    {
        $statuses = [
            1 => 'Available',
            2 => 'Out of Stock',
            3 => 'Not Available',
        ];

        return $statuses[$this->product_status] ?? 'Unknown Status';
    }

    public function Product_Logs() {
        $this->hasMany(ProductLog::class);
    }

}
