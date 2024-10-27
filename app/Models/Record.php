<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'product_id',
        'product_new_stocks',
        'product_old_stocks',
        'product_sold_stocks',
        'product_damage_stocks',
        'product_total_stocks',
        'transfer_date',
        'total_profit'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


}
