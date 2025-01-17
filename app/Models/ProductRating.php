<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
        'deactivated_date',
        'deactivated_status',
        'deactivated_by',
        'created_at',
    ];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
