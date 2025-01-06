<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class CartController extends Controller
{

    public function showConsumerCart()
    {

        if (!Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }

        $cart = Cart::where('user_id', auth()->guard('user')->user()->id)->first();

        $cartItems = $cart ? $cart->cartItems()
        ->whereHas('product_specification.product')
        ->with(['product_specification.product'])
        ->get() : collect();

        return view('user.consumer.cart.show', ['cart' => $cart, 'cartItems' => $cartItems, 'stripeKey' => env('STRIPE_KEY')]);
    }

    public function showConsumerCheckout(Request $request, $cartId)
    {
        $cart = Cart::with('cartItems.product_specification.product')->findOrFail($cartId);

        $selectedItems = $request->query('selectedItems', []);

        $filteredCartItems = $cart->cartItems->filter(function ($item) use ($selectedItems) {
            return empty($selectedItems) || in_array($item->id, $selectedItems);
        });

        $shippingAddresses = Auth::guard('user')->user()->shippingAddresses;

        if (empty($selectedItems)) {
            return redirect()->route('user.consumer.product.cart')->with('message', 'No items have been selected for checkout.');
        }

        $user = Auth::guard('user')->user();

        return view('user.consumer.cart.checkout', [
            'cart' => $cart,
            'shippingAddresses' => $shippingAddresses,
            'cartItems' => $filteredCartItems, // Use filtered cart items
            'selectedItems' => $selectedItems, // Pass selected items to the view
            'stripeKey' => env('STRIPE_KEY'),
        ]);
    }

}
