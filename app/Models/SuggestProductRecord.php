<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestProductRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'verified_by',
        'suggest_name',
        'suggest_description',
        'suggest_image',
        'total_vote_count',
        'transfer_date',
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
