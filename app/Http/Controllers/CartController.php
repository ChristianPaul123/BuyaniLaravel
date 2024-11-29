<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function showConsumerCart() {

        if (!Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }


        $cart = Cart::where('user_id', auth()->guard('user')->user()->id)->first();

        // Fetch related CartItems with ProductSpecification and Product
        $cartItems = $cart ? $cart->cartItems()
        ->whereHas('product_specification.product')
        ->with(['product_specification.product'])
        ->get() : collect();

        return view('user.consumer.cart.show', ['cart' => $cart, 'cartItems' => $cartItems]);

    }

    public function showConsumerCheckout()
{
    $cart =Auth::guard('user')->user()->cart;
    $shippingAddresses = Auth::guard('user')->user()->shippingAddresses;
    $cartItems = $cart->cartItems()->with('product_specification.product')->get();
    return view('user.consumer.cart.checkout', compact('cart','shippingAddresses', 'cartItems'));
}



}
