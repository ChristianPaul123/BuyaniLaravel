<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamp = true;

    // Define order statuses as constants
    const STATUS_STANDBY = 1;
    const STATUS_TO_PAY = 2;
    const STATUS_TO_SHIP = 3;
    const STATUS_COMPLETED = 4;
    const STATUS_CANCELLED = 5;
    const OUT_FOR_DELIVERY = 6;
    const STATUS_ACHRIVED = 7;

    // Fillable attributes for the Order model
    protected $fillable = [
        'user_id',
        'total_amount',
        'overall_orderKG',
        'total_price',
        'order_type',
        'order_number',
        //'shipping_method',
        'order_status',
        'customer_name',
        'delivery_employee',
        'customer_phone',
        'customer_email',
        'customer_street',
        'customer_city',
        'customer_state',
        'customer_zip',
        'customer_country',
        'customer_barangay',
        'customer_house_number',
    ];



    public $timestamps = true; // Ensure timestamps are enabledz

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

    public function orderCancellation() {
        return $this->hasOne(OrderCancellation::class, 'order_id'); // 'order_id' is the foreign key in the order_cancellation table
    }

    public function getStatusLabelAttribute()
    {
        $statuses = [
            self::STATUS_STANDBY => 'To Standby',
            self::STATUS_TO_PAY => 'To Pay',
            self::STATUS_TO_SHIP => 'To Ship',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::OUT_FOR_DELIVERY => 'Out for Delivery',
            SELF:: STATUS_ACHRIVED
        ];

        return $statuses[$this->order_status] ?? 'Unknown';
    }

    public function OrderLogs()
    {
        return $this->hasMany(OrderLog::class);
    }

    public function rating()
    {
        return $this->hasOne(OrderRating::class, 'order_id');
    }
}
