<?php

namespace App\Observers;
use App\Models\Order;
use App\Models\Order_Log;
use Illuminate\Support\Facades\Auth;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order)
    {
        Order_Log::create([
            'order_id' => $order->id,
            'user_id' => Auth::guard('user')->id() ?? null,
            'action' => 'created',
            'changes' => null //
        ]);
    }

    public function updated(Order $order)
    {
        // Determine what changed
        $changes = [];
        foreach ($order->getChanges() as $field => $newValue) {
            if ($field !== 'updated_at') {
                $originalValue = $order->getOriginal($field);
                $changes[$field] = [
                    'old' => $originalValue,
                    'new' => $newValue,
                ];
            }
        }

        if (!empty($changes)) {
            Order_Log::create([
                'order_id' => $order->id,
                'user_id' => Auth::guard('user')->id() ?? null,
                'action' => 'updated',
                'changes' => json_encode($changes),
            ]);
        }
    }

    public function deleted(Order $order)
    {
        Order_Log::create([
            'order_id' => $order->id,
            'user_id' => Auth::guard('user')->id() ?? null,
            'action' => 'deleted',
            'changes' => null
        ]);
    }
    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
