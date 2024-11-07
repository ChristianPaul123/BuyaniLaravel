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
            return redirect()->route('user.index')->with('message', 'Please log in first');
        }


        $cart = Cart::where('user_id', auth()->guard('user')->user()->id)->first();

        // Fetch related CartItems with ProductSpecification and Product
        $cartItems = $cart ? $cart->cartItems()
        ->whereHas('product_specification.product')
        ->with(['product_specification.product'])
        ->get() : collect();

        return view('user.cart.show', ['cart' => $cart, 'cartItems' => $cartItems]);

    }



    // public function add(Request $request)
    // {
    //     // dd($request->all());
    //     $cart = Cart::where('user_id', auth()->guard()->user()->id)->where('product_id', $request->product_id)->first();
    //     if ($cart) {
    //         $cart->quantity += $request->quantity;
    //         $cart->save();
    //     } else {
    //         $cart = new Cart();
    //         $cart->user_id = auth()->guard()->user()->id;
    //         $cart->product_id = $request->product_id;
    //         $cart->quantity = $request->quantity;
    //         $cart->save();
    //     }
    // }


}
