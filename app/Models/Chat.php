<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable =  [
        'user_id',
        'chat_status',
        'timestamp',
    ];

    public function messages(){
        return $this->hasMany(Messages::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
