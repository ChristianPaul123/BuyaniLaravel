<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Fillable attributes for the Order model
    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'total_amount',
        'overall_orderKG',
        'total_price',
        'order_type',
        //'shipping_method',
        'order_status',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_street',
        'customer_city',
        'customer_state',
        'customer_zip_code',
        'customer_country',
        'customer_house_number',
    ];

    // Define a relationship between the Order model and the User model
    public function user() {
        return $this->belongsTo(User::class, 'user_id'); // 'user_id' is the foreign key in the orders table
    }

    // Define a relationship between the Order model and the OrderItem model
    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'order_id'); // 'order_id' is the foreign key in the order_items table
    }

    public function orderRatings() {
        return $this->hasMany(OrderRating::class, 'order_id'); // 'order_id' is the foreign key in the order_ratings table
    }

    public function payment() {
        return $this->hasOne(Payment::class, 'order_id'); // 'order_id' is the foreign key in the payments table
    }

    public function trackings() {
        return $this->hasMany(Tracking::class, 'order_id'); // 'order_id' is the foreign key in the tracking table
    }


}
