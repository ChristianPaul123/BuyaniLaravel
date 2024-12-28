<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorImgs extends Model
{
    protected $fillable = [
        'img',
        'img_title',
        'admin_id',
        'created_at',
    ];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }
}
