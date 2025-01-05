<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageReads extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'admin_id',
        'user_id',
        'is_read',
    ];

    public function message() {
      return  $this->belongsTo(Messages::class);
    }

    public function user() {
      return  $this->belongsTo(User::class);
    }

    public function admin() {
      return  $this->belongsTo(Admin::class);
    }
}
