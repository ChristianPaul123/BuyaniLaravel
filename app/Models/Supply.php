<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'supply_date',
        'supply_quantity_kg'
    ];

    public function product() {
      return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
      }
}
