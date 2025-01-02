<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Failed;
use App\Models\User_log;
use Illuminate\Support\Facades\Request;

class LogFailedLogin
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
    public function handle(Failed $event)
    {
            // Ensure the user is an instance of the 'User' model
        if (! $event->user instanceof \App\Models\User) {
            return;
        }

        $loginMethod = isset($event->credentials['phone_number']) ? 'phone_number' : (isset($event->credentials['email']) ? 'email' : 'unknown');

        User_log::create([
            'user_id' => $event->user->id ?? null,
            'phone_number' => $event->credentials['phone_number'] ?? null,
            'email' => $event->credentials['email'] ?? null,
            'login_field' => $loginMethod, // Store the login method
            'status' => 'failed',
            'ip_address' => Request::ip(),
        ]);
    }
}
