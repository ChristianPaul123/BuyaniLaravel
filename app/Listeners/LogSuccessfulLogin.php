<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use App\Models\User_log;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $loginMethod = isset($event->credentials['phone_number']) ? 'phone_number' : 'email';

        User_log::create([
            'user_id' => $event->user->id,
            'phone_number' => $loginMethod === 'phone_number' ? $event->user->phone_number : null,
            'email' => $loginMethod === 'email' ? $event->user->email : null,
            'login_field' => $loginMethod, // Store the login method
            'status' => 'success',
            'ip_address' => Request::ip(),
        ]);
    }
}