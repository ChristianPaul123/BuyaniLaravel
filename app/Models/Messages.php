<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    public $timestamp = true;

    protected $fillable = [
        'chat_id',
        'user_id',
        'admin_id',
        'message_info',
        'is_deleted',
        'is_edited',

    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function MessageReads() {
        return $this->hasMany(MessageReads::class, 'message_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    //This will retrieve all Message instances where read_at is NULL, indicating that they are unread.
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
