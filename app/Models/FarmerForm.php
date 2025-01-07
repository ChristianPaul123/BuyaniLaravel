<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerForm extends Model
{
    public $timestamp = true;

    protected $fillable = [
    'user_id',
    'identification_card_front',
    'identification_card_back',
    'response',
    'farmer_form',
    'id_verified',
    'form_verified',
    'verified_by'
    ];

    public function user() {
        // Return a belongsTo relationship with the User model
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        // Return a belongsTo relationship with the Admin model
        return $this->belongsTo(Admin::class);
    }
}
