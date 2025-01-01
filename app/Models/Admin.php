<?php

namespace App\Models;

use App\Models\Messages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

      // Define Admin statuses as constants
      const Owner = 1;
      const Assistant = 2;
      const Employee = 3;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_type',
        'profile_pic',
        'status',
        'last_online',
        'deactivated_date',
        'deactivated_status',
        'admin_payment',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function blogs() {
        return $this->HasMany(Blog::class);
    }

    public function messages() {
        return $this->HasMany(Messages::class);
    }

    public function suggestRecord() {
        return $this->HasMany(SuggestProductRecord::class);
    }

    public function getAdminTypeLabelAttribute()
    {
        $adminTypes = [
            self::Owner => 'Owner',
            self::Assistant => 'Assistant',
            self::Employee => 'Employee',
        ];

        return $adminTypes[$this->admin_type] ?? 'Unknown';
    }


}
