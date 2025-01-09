<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderCancellation;
use Illuminate\Support\Facades\Auth;

class OrderManagementController extends Controller
{

    public function showOrders()
    {
        return view('admin.order.order-index', [
            'ordersToStandby' => Order::with(['user', 'payment'])->where('order_status', Order::STATUS_STANDBY)->get(),
            'ordersToPay' => Order::with(['user', 'payment'])->where('order_status', Order::STATUS_TO_PAY)->get(),
            'ordersToShip' => Order::with(['user', 'payment'])->where('order_status', Order::STATUS_TO_SHIP)->get(),
            'ordersToDeliver' => Order::with(['user', 'payment'])->where('order_status', Order::OUT_FOR_DELIVERY)->get(),
            'ordersCompleted' => Order::with(['user', 'payment'])->where('order_status', Order::STATUS_COMPLETED)->get(),
            'ordersCancelled' => Order::with(['user', 'payment'])->where('order_status', Order::STATUS_CANCELLED)->get(),
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

    public function toDeliver()
    {
        $ordersToDeliver = Order::where('order_status', Order::OUT_FOR_DELIVERY)->get();
        return view('admin.order.tabs.order-deliver', compact('ordersToDeliver'));
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
        $order = Order::with('orderItems.product', 'payment', 'user')->findOrFail($id);

        return view('admin.order.order-view', compact('order'));
    }

    public function showSpecial()
    {
        return view('admin.order.order-special');
    }

    public function cancelOrder($id)
    {
        // Find the order
      // Retrieve the order and related data
    $order = Order::with(['user', 'orderItems.product', 'orderItems.productSpecification', 'payment', 'trackings'])
    ->findOrFail($id);
        // Redirect to the order-rejected page to allow admin to provide cancellation details
        return view('admin.order.order-rejected', compact('order'));
    }

    public function showCancelOrder($id)
    {
        // Find the order
      // Retrieve the order and related data
    $order = Order::with(['user', 'orderItems.product', 'orderItems.productSpecification', 'payment', 'trackings','orderCancellation'])
    ->findOrFail($id);
        // Redirect to the order-rejected page to allow admin to provide cancellation details
        return view('admin.order.order-view-rejected', compact('order'));
    }

    public function cancelOrderProcess( Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Create the OrderCancellation record
        OrderCancellation::create([
            'order_id' => $order->id,
            'cancelled_by' => Auth::guard('admin')->username ?? 'Unknown', // Capture the admin or user cancelling the order
            'reason' => $validated['reason'],
            'notes' => $validated['notes'],
        ]);

        // Update the order status to cancelled
        $order->update([
            'order_status' => Order::STATUS_CANCELLED,
        ]);

        return redirect()->route('admin.orders.index', $order->id)->with('success', 'Order has been successfully cancelled.');
    }


    public function acceptOrder($id)
    {
        $order = Order::with('payment')->findOrFail($id); // Load the payment relationship

        if ($order->order_status != Order::STATUS_STANDBY) {
            return redirect()->back()->withErrors('Order cannot be accepted as it is not in Standby status.');
        }

        // Determine the next status based on the payment method
        $nextStatus = ($order->payment && ($order->payment->payment_method === 'COD' || $order->payment->payment_method === 'Stripe'))? Order::STATUS_TO_SHIP : Order::STATUS_TO_PAY;

        $order->update([
            'order_status' => $nextStatus,
        ]);

        $message = $nextStatus === Order::STATUS_TO_SHIP
            ? 'Order has been accepted and moved to "To Ship" status (COD).'
            : 'Order has been accepted and moved to "To Pay" status.';

        return redirect()->route('admin.orders.index',['tab' => 'order-standby'])->with('success', $message);
    }

}
