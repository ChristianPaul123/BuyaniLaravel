<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{

    public function showOrders()
    {
        return view('admin.order.order-index', [
            'ordersToStandby' => Order::where('order_status', Order::STATUS_STANDBY)->get(),
            'ordersToPay' => Order::where('order_status', Order::STATUS_TO_PAY)->get(),
            'ordersToShip' => Order::where('order_status', Order::STATUS_TO_SHIP)->get(),
            'ordersCompleted' => Order::where('order_status', Order::STATUS_COMPLETED)->get(),
            'ordersCancelled' => Order::where('order_status', Order::STATUS_CANCELLED)->get(),
        ]);
    }

    public function toStandby()
    {
        $ordersToStandby = Order::where('order_status', Order::STATUS_STANDBY)->get();
        return view('admin.order.tabs.order-standby', compact('ordersToStandby'));
    }

    public function toPay()
    {
        $ordersToPay = Order::where('order_status', Order::STATUS_TO_PAY)->get();
        return view('admin.order.tabs.order-pay', compact('ordersToPay'));
    }

    public function toShip()
    {
        $ordersToShip = Order::where('order_status', Order::STATUS_TO_SHIP)->get();
        return view('admin.order.tabs.order-ship', compact('ordersToShip'));
    }

    public function completed()
    {
        $ordersCompleted = Order::where('order_status', Order::STATUS_COMPLETED)->get();
        return view('admin.order.tabs.order-completed', compact('ordersCompleted'));
    }

    public function cancelled()
    {
        $ordersCancelled = Order::where('order_status', Order::STATUS_CANCELLED)->get();
        return view('admin.order.tabs.order-cancelled', compact('ordersCancelled'));
    }


// ----------------------------------------------------------------
//viewing in the Admin Page

    public function viewOrder($id)
    {
        // Replace with actual data retrieval
        $order = Order::with('orderItems', 'payment', 'user')->findOrFail($id);

        return view('admin.order.order-special', compact('order'));
    }

    public function showSpecial()
    {
        return view('admin.order.order-special');
    }

    public function cancelOrder($id)
    {
        // Find the order
        $order = Order::with('orderItems', 'payment', 'user')->findOrFail($id);

        // Redirect to the order-rejected page to allow admin to provide cancellation details
        return view('admin.order.order-rejected', compact('order'));
    }


    public function acceptOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['order_status' => Order::STATUS_COMPLETED]);

        return redirect()->route('admin.orders.view', $id)->with('message', 'Order accepted successfully.');
    }

}
