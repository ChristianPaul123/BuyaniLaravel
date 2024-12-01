<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerProduce extends Model
{

    protected $fillable = [
        'user_id',
        'produce_name',
        'produce_description',
        'produce_quantity',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
