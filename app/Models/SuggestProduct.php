<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'verified_by',
        'suggest_name',
        'suggest_description',
        'suggest_image',
        'total_vote_count',
        'is_accepted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


}
