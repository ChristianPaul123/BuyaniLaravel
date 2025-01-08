<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderCancellation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\OrderRating;

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
        'ordersCompleted' => $user->orders()->where('order_status', Order::STATUS_COMPLETED)->with('rating')->get(),
        'ordersCancelled' => $user->orders()->where('order_status', Order::STATUS_CANCELLED)->get(),
        'ordersToDeliver' => $user->orders()->where('order_status', Order::OUT_FOR_DELIVERY)->get(),
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
            ->with(['orderItems.product', 'payment', 'rating'])
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

    public function confirmOrderReceived(Request $request) {
        if (!Auth::guard('user')->check()) {
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in to access this page');
        }
    
        $user = Auth::guard('user')->user();
        $order = $user->orders()->where('id', $request->order_id)->first();
    
        if (!$order) {
            return redirect()->route('user.consumer.order')->with('error', 'Order not found');
        }
    
        $order->update([
            'order_status' => Order::STATUS_COMPLETED,
        ]);
    
        return redirect()->route('user.consumer.order')->with('message', 'Order has been successfully marked as completed');
    }

    public function rateOrder($id)
    {
        if (!Auth::guard('user')->check()) {
            return redirect()->route('user.index')->with('message', 'Please log in to access this page');
        }

        $user = Auth::guard('user')->user();
        $order = $user->orders()->where('id', $id)->first();

        if (!$order) {
            return redirect()->route('user.consumer.order')->with('error', 'Order not found');
        }

        return view('user.consumer.order.order-rate', [
            'order' => $order,
        ]);
    }

    public function storeOrderRating(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'delivery_rating' => 'required|integer|min:1|max:5',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $user = Auth::guard('user')->user();

        OrderRating::create([
            'order_id' => $request->order_id,
            'user_id' => $user->id,
            'delivery_rating' => $request->delivery_rating,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('user.consumer.order')->with('message', 'Thank you for your feedback!');
    }
    

}
