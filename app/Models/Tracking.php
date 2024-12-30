<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    // Use the HasFactory trait to create factory instances for this model
    use HasFactory;

    public $timestamp = true;

    protected $fillable = [
        'order_number',
        'order_id',
        'admin_id',
        'user_id',
        'tracking_status',
        'tracking_time',
        'tracking_info',
    ];

    // Define a relationship with the Order model
    public function order() {
        return $this->belongsTo(Order::class); // 'order_id' is the foreign key in the orders table
    }

    public function admin() {
        return $this->belongsTo(Admin::class); // 'admin_id' is the foreign key in the admins table
    }

    public function user() {
        return $this->belongsTo(User::class); // 'user_id' is the foreign key in the users table
    }

    public function tracking_timelines() {
        return $this->belongsToMany(Tracking_timeline::class);
    }
}
