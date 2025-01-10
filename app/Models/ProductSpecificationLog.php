<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecificationLog extends Model
{

    public $timestamp = true;

    protected $fillable = [
        'product_specification_id',
        'admin_id',
        'action',
        'changes',
    ];

    public function productSpecification()
    {
        return $this->belongsTo(ProductSpecification::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
