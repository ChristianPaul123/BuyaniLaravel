<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        // 'product_status',
        'product_new_stocks',
        'product_old_stocks',
        'product_sold_stocks',
        'product_damage_stocks',
        'product_total_stocks',
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
