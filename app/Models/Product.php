<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_price',
        'product_pic',
        'product_details',
        'product_status',
        'product_kg',
        'category_id',
        'sub_category_id',
        'product_deactivated',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    // protected $hidden = [
    //     //
    // ];

}
