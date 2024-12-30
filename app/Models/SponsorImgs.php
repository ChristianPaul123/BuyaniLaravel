<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorImgs extends Model
{

    public $timestamp = true;

    protected $fillable = [
        'img',
        'img_title',
        'admin_id',
    ];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }
}
