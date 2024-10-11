<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // Use the HasFactory trait to create factory instances for this model
    use HasFactory;

    // Define the fillable attributes for this model
    protected $fillable = [
        'username',
        'admin_id',
        'blog_title',
        'blog_pic',
        'removed_date',
    ];

    // Define a relationship with the Admin model
    public function admin()
    {
        // Return a belongsTo relationship with the Admin model
        return $this->belongsTo(Admin::class);
    }
}
