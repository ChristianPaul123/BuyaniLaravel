<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // dd($request->all());
        $cart = Cart::where('user_id', auth()->guard()->user()->id)->where('product_id', $request->product_id)->first();
        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            $cart = new Cart();
            $cart->user_id = auth()->guard()->user()->id;
            $cart->product_id = $request->product_id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }
}
}
