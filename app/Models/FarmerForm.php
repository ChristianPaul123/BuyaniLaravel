<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerForm extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'identification_card',
    'farmer_form',
    'id_verified',
    'form_verified',
    'verified_by'
    ];
}
