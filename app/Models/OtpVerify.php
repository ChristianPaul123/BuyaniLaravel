<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerify extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $fillable = [
        'email',
        'otp',
        'otp_expiry',
        'v_purpose',
        'is_verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
