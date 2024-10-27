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

    public function updateCartView()
{
    try {
    $cart = Cart::with('cartItems.product_specification.product')->where('user_id', auth()->guard()->user()->id)->first();
    $cartItems = $cart ? $cart->cartItems : [];

    return response()->json([
        'cartItems' => $cartItems,
        'totalWeight' => $cart->overall_cartKG ?? 0,
        'totalPrice' => $cart->total_price ?? 0,
    ]);
    } catch (\Exception $e) {
        // Handle unexpected exceptions: clear session and redirect to index
        Session::flush();
        return redirect()->route('user.index')->with('message', 'An error occurred. Please try again.');
    }
}


    public function showConsumerCheckout () {
        try {
        return view('user.cart.checkout');
        } catch (\Exception $e) {
            // Handle unexpected exceptions: clear session and redirect to index
            Session::flush();
            return redirect()->route('user.index')->with('message', 'An error occurred. Please try again.');
        }
    }

    public function addOrUpdateCartItem($cartItemId = null, $quantity, $productSpecId)
     {
        $cart = Cart::firstOrCreate(['user_id' => auth()->guard()->user()->id]);

        $cartItem = CartItem::updateOrCreate(
            [
                'id' => $cartItemId,
                'cart_id' => $cart->id,
                'product_specification_id' => $productSpecId
            ],
            [
                'quantity' => $quantity,
                'price' => ProductSpecification::find($productSpecId)->price * $quantity,
                'overall_kg' => ProductSpecification::find($productSpecId)->weight * $quantity,
                'product_status' => ProductSpecification::find($productSpecId)->product->product_status,
            ]
        );

        // Recalculate the cart totals based on updated CartItems
        $this->updateCartTotals($cart);

        return redirect()->route('user.cart.show');
    }

    public function updateCartItemAjax(Request $request, $cartitem) {
        $cartItem = CartItem::findOrFail($cartitem);
        $quantity = $request->input('quantity');

        $productSpec = ProductSpecification::find($cartItem->product_specification_id);

        if ($productSpec) {
            // Update the cart item
            $cartItem->update([
                'quantity' => $quantity,
                'price' => $productSpec->product_price * $quantity,
                'overall_kg' => $productSpec->product_kg * $quantity,
                'product_status' => $productSpec->product->product_status,
            ]);

            // Recalculate cart totals
            $this->updateCartTotals($cartItem->cart);

            return response()->json(['success' => true, 'message' => 'Cart item updated successfully. please reload the page']);
        }

        return response()->json(['success' => false, 'message' => 'Product specification not found.'], 404);
    }

    public function deleteCartItem($cartItemId) {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cart = $cartItem->cart;
        $cartItem->delete();

        // Update cart totals after deletion
        $this->updateCartTotals($cart);

        return redirect()->route('user.cart.show')->with('success', 'Item removed from cart');
    }

    protected function updateCartTotals(Cart $cart) {
        $cart->cart_total = $cart->cartItems->count();
        $cart->overall_cartKG = $cart->cartItems->sum('overall_kg');
        $cart->total_price = $cart->cartItems->sum('price');
        $cart->save();
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
