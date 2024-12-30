<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking_timeline extends Model
{

    public $timestamp = true;

    protected $fillable = [
        'tracking_id',
        'status',
        'description',
        'location'
    ];
}
