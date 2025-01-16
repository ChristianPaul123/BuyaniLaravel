<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\OrderRating;
use App\Models\ProductSales;
use Illuminate\Http\Request;
use App\Mail\OrderDeclinedMail;
use App\Mail\OrderCancelledMail;
use App\Mail\OrderCompletedMail;
use App\Models\OrderCancellation;
use App\Models\SpecificProductSales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        'ordersCompleted' => $user->orders()->whereIn('order_status', [Order::STATUS_COMPLETED, Order::STATUS_ARCHIVED])->with('rating')->get(),
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

        $order = $user->orders()->where('id', $id)->with('orderItems')->first();
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

        Mail::to($order->customer_email)->send(new OrderCancelledMail($order, $order->orderItems));

        return redirect()->route('user.consumer.order')->with('message', 'Order has been successfully cancelled');
    }

    //MAIN CONTENT FOR THE PRODUCT SALES AND PRODUCT SPECIFICATIONS SALES
    public function confirmOrderReceived(Request $request)
    {
        if (!Auth::guard('user')->check()) {
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in to access this page');
        }

        $user = Auth::guard('user')->user();
        $order = $user->orders()->where('id', $request->order_id)->first();

        if (!$order) {
            return redirect()->route('user.consumer.order')->with('error', 'Order not found');
        }

        // Update the order status
        $order->update([
            'order_status' => Order::STATUS_COMPLETED,
        ]);

        // Deduct the ordered quantity from the inventory
        // ALSO: Increase product_sold_stock and total_profit
        foreach ($order->orderItems as $item) {
            $inventory = Inventory::where('product_id', $item->product_id)->first();

            if ($inventory) {
                // Calculate how much to deduct and add
                $orderedKgOrUnits = $item->overall_kg;
                // or use $item->quantity if you prefer the "pieces" or "units" measure

                $totalSaleAmount = $item->price;

                $inventory->update([
                    // Subtract from current stock
                    'product_total_stock' => max(0, $inventory->product_total_stock - $orderedKgOrUnits),

                    // Add to sold stock
                    'product_sold_stock'  => $inventory->product_sold_stock + $orderedKgOrUnits,

                    // Accumulate total profit
                    'total_profit'        => $inventory->total_profit + $totalSaleAmount,
                ]);
            }

            // ------------------------------------------------------------------
        // 1) Add logic to record product sales and specific product sales
        // ------------------------------------------------------------------

        // Example: use today's date or you can use $order->created_at->format('Y-m-d')
        // depending on how you want to track the sales date.
        $salesDate = Carbon::now()->format('Y-m-d');

        foreach ($order->orderItems as $item) {
            // ----------------------------------------------------
            // A) Update/create the ProductSales entry
            // ----------------------------------------------------
            $productSales = ProductSales::where('product_id', $item->product_id)
                                        ->where('date', $salesDate)
                                        ->first();

            if (!$productSales) {
                // Create a new record for this product and date
                $productSales = ProductSales::create([
                    'product_id'  => $item->product_id,
                    'order_count' => 1, // first order item for this product on this date
                    'total_sales' => ($item->price * $item->quantity),
                    'date'        => $salesDate,
                ]);
            } else {
                // Update existing record
                $productSales->order_count += 1;
                $productSales->total_sales += ($item->price * $item->quantity);
                $productSales->save();
            }
        }

            // ----------------------------------------------------
            // B) Update/create the SpecificProductSales entry
            // ----------------------------------------------------
            $specificProductSales = SpecificProductSales::where('product_specification_id', $item->product_specification_id)
                                                    ->where('product_sale_id', $productSales->id) // Link to the productSales record
                                                    ->where('date', $salesDate)
                                                    ->first();

            if (!$specificProductSales) {
                // Create a new record for this product specification and date
                $specificProductSales = SpecificProductSales::create([
                    'product_specification_id' => $item->product_specification_id,
                    'product_sale_id'         => $productSales->id, // link to ProductSales
                    'order_quantity'          => $item->quantity,
                    'total_sales'             => ($item->price * $item->quantity),
                    'date'                    => $salesDate,
                ]);
            } else {
                // Update existing record
                $specificProductSales->order_quantity += $item->quantity;
                $specificProductSales->total_sales    += ($item->price * $item->quantity);
                $specificProductSales->save();
            }
        }


        Mail::to($order->customer_email)->send(new OrderCompletedMail($order, $order->orderItems));

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
