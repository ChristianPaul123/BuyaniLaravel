<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotedProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'suggest_product_id',
        'user_id',
        'is_voted',
    ];

    public function suggestProduct()
    {
        return $this->belongsTo(SuggestProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
