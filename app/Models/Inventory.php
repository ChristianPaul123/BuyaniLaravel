<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    public $timestamp = true;

    protected $fillable = [
        'product_id',
        'product_new_stock',
        'product_old_stock',
        'product_total_stock',
        'total_profit',
        'product_sold_stock',
        'product_damage_stock',
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function records(){
        return $this->hasMany(record::class);
    }


}
