<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_log extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'action',
        'changes',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
