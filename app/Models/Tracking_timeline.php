<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking_timeline extends Model
{
    protected $fillable = [
        'tracking_id', 'status', 'location','','created_at', 'updated_at'
    ];
}
