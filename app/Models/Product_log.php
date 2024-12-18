<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_log extends Model
{
    protected $fillable = [
        'product_id',
        'admin_id',
        'action',
        'changes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
