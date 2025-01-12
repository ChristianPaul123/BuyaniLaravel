<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderProcessMail;
use App\Mail\OrderDeclinedMail;
use App\Mail\OrderDeliveredMail;
use App\Models\OrderCancellation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            'ordersArchived' => Order::with(['user', 'payment'])->where('order_status', Order::STATUS_ARCHIVED)->get(),
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

    public function archived()
    {
        $ordersArchived = Order::where('order_status', Order::STATUS_ARCHIVED)->get();
        return view('admin.order.tabs.order-archived', compact('ordersArchived'));
    }


// ----------------------------------------------------------------
//viewing in the Admin Page

    public function viewOrder($id)
    {
        // Replace with actual data retrieval
        $order = Order::with('orderItems.product', 'payment', 'user')->findOrFail($id);

        return view('admin.order.order-view', compact('order'));
    }



    public function shipOrderProcess(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'employee_name' => 'required|string',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        $order->update([
            'delivery_employee' => $validated['employee_name'],
            'order_status' => Order::OUT_FOR_DELIVERY,
        ]);

        Mail::to($order->customer_email)->send(new OrderDeliveredMail($order, $order->orderItems));

        return redirect()->route('admin.orders.index')->with('success', 'Order is now out for delivery.');
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
        $order = Order::with('orderItems')->find($id);

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

        Mail::to($order->customer_email)->send(new OrderDeclinedMail($order, $order->orderItems));

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

        Mail::to($order->customer_email)->send(new OrderProcessMail($order, $order->orderItems));

        return redirect()->route('admin.orders.index',['tab' => 'order-standby'])->with('success', $message);
    }

    /**
     * Archive the specified order.
     *
     * This method updates the status of the order to 'archived' if the order is in 'completed' status.
     * If the order is not in 'completed' status, it redirects back with an error message.
     *
     * @param int $id The ID of the order to be archived.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function archiveOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->order_status != Order::STATUS_COMPLETED) {
            return redirect()->back()
                ->withErrors('Order cannot be archived as it is not in Completed status.');
        }

        $order->update([
            'order_status' => Order::STATUS_ARCHIVED,
        ]);

        return redirect()
            ->route('admin.orders.index',['tab' => 'order-completed'])
            ->with('success', 'Order has been archived.');
    }

}
