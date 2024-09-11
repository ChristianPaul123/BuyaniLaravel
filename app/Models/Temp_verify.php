<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_verify extends Model
{
    protected $fillable = [
        'username',
        'email',
        'password',
        'otp',
        'otp_expiry',
        'v_purpose',
        'count'
    ];
}
