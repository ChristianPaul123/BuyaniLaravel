<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerProduce extends Model
{
    public $timestamp = true;

    protected $fillable = [
        'user_id',
        'produce_name',
        'produce_description',
        'produce_image',
        'suggested_price',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
