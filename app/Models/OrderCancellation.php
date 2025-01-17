<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCancellation extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $fillable = [
        'order_id',
        'cancelled_by',
        'reason',
        'notes',
        'created_at',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
