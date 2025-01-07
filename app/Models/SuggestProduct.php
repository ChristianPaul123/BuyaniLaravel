<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestProduct extends Model
{
    use HasFactory;

    public $timestamp = true;


    protected $fillable = [
        'user_id',
        'verified_by',
        'suggest_name',
        'suggest_description',
        'suggest_image',
        'total_vote_count',
        'is_accepted',
        'deactivated_date',
        'deactivated_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function votedProducts()
    {
        return $this->hasMany(VotedProducts::class);
    }




}
