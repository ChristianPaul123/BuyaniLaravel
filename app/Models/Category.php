<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamp = true;

    protected $fillable = [
    'category_name',
    'deactivated_date',
    'deactivated_status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }

    public function subcategories() {
        return $this->hasMany(SubCategory::class,'category_id');
    }


}
