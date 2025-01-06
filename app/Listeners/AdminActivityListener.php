<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Request;
use App\Models\AdminLog;
use App\Models\Admin;

class AdminActivityListener
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
    public function handle(object $event): void
    {
        // Ensure only Admin model triggers this listener
        if ($event->user instanceof Admin) {
            $action = $event instanceof Login ? 'logged in' : 'logged out';

            // Log the admin activity
            AdminLog::create([
                'admin_id' => $event->user->id,
                'action' => $action,
                'ip_address' => Request::ip(),
            ]);

            // Update admin status and last online
            $event->user->update([
                'status' => $action === 'logged in' ? 1 : 0, // Set 1 for logged in, 0 for logged out
                'last_online' => $action === 'logged out' ? now() : null, // Set last_online timestamp only on logout
            ]);
        }
    }
}
