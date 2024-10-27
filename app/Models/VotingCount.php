<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'max_vote_count',
        'remaining_vote_count'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function decrementVoteCount() {
        // Decrement the remaining vote count by 1
        $this->remaining_vote_count -= 1;
        $this->save();
    }
}
