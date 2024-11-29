<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function showOrders()
    {
        if (!Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }


    $user = Auth::guard('user')->user();

    return view('user.consumer.order.order-show', [
        'ordersToStandby' => $user->orders()->where('order_status', Order::STATUS_STANDBY)->get(),
        'ordersToPay' => $user->orders()->where('order_status', Order::STATUS_TO_PAY)->get(),
        'ordersToShip' => $user->orders()->where('order_status', Order::STATUS_TO_SHIP)->get(),
        'ordersCompleted' => $user->orders()->where('order_status', Order::STATUS_COMPLETED)->get(),
        'ordersCancelled' => $user->orders()->where('order_status', Order::STATUS_CANCELLED)->get(),
    ]);
    }
}
