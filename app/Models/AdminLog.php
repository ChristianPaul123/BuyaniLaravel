<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    public $timestamp = true;

    protected $fillable = [
        'admin_id',
        'action',
        'ip_address',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
