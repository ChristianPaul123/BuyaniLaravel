<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_number',
        'order_id',
        //'order_status',
        //'courier_id',
        'tracking_status',
        'tracking_info',

    ];
}
