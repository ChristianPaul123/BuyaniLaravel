<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderCancellation;
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

    public function showOrderDetails($id)
    {
        if (!Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }

        $user = Auth::guard('user')->user();

        // Fetch the order along with its relationships
        $order = $user->orders()
            ->where('id', $id)
            ->with(['orderItems.product', 'payment'])
            ->first();

        if (!$order) {
            return redirect()->route('user.orders.index')->with('error', 'Order not found.');
        }

        return view('user.consumer.order.order-view', compact('order'));
    }

    public function cancelOrder($id) {
        if (!Auth::guard('user')->check()) {
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in to access this page');
        }

        $user = Auth::guard('user')->user();

        $order = $user->orders()->where('id', $id)->first();
        if (!$order) {
            return redirect()->route('user.consumer.orders')->with('error', 'Order not found');
        }

        return view('user.consumer.order.order-cancel', compact('order'));
    }

    public function cancelOrderSubmit(Request $request, $id) {
        if (!Auth::guard('user')->check()) {
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in to access this page');
        }

        $user = Auth::guard('user')->user();

        $order = $user->orders()->where('id', $id)->first();
        if (!$order) {
            return redirect()->route('user.consumer.order')->with('error', 'Order not found');
        }

        // Validate the reason for cancellation
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        // Create an OrderCancellation entry
        OrderCancellation::create([
            'order_id' => $order->id,
            'cancelled_by' => 'user',
            'reason' => $request->reason,
        ]);

        // Update the order status to Cancelled
        $order->update([
            'order_status' => Order::STATUS_CANCELLED,
        ]);

        return redirect()->route('user.consumer.order')->with('message', 'Order has been successfully cancelled');
    }

}
