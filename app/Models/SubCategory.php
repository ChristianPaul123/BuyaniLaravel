<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $fillable = [
        'sub_category_name',
        'category_id',
        'deactivated_date',
        'deactivated_status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'subcategory_id');
    }

    // public function scopeFilter($query, array $filters)
    // {
    //     $query->when($filters['search'] ?? false, function ($query, $search) {
    //         return $query->where(function ($query) use ($search) {
    //             $query->where('sub_category_name', 'like', '%' . $search . '%')
    //                 ->orWhere('category_id', 'like', '%' . $search . '%');
    //         });
    //     });
    // }

}
