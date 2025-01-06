<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{

    public $timestamp = true;

    protected $fillable = [
        'user_id',     // The ID of the user attempting to log in
        'phone_number', // The phone number of the user attempting to log in
        'email', // The email of the user attempting to log in
        'status',      // Whether the login was successful or failed
        'login_field', // The login field of the form was submitted
        'ip_address',  // The IP address from which the login attempt occurred
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
