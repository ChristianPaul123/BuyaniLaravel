<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingTimeline extends Model
{

    public $timestamp = true;

    protected $fillable = [
        'tracking_id',
        'status',
        'description',
        'location'
    ];

    public function tracking() {
        return $this->belongsTo(Tracking::class);
    }
}
