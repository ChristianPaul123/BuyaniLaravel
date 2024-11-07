<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\ProductSpecification;

class UserCart extends Component
{

    public $cartItems;
    public $cart;

    public function mount($cart)
    {
        $this->cart = $cart;
        $this->loadCartItems(); // Use a separate method to load items for easier reusability
    }


    // The "action" variable expects a value like 'increment' or 'decrement'.
    public function updateQuantity($cartItemId, $action)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $productSpec = ProductSpecification::find($cartItem->product_specification_id);

        // Adjust quantity based on action
        $newQuantity = $action === 'increment' ? $cartItem->quantity + 1 : $cartItem->quantity - 1;

        if ($newQuantity < 1) {
            $this->removeCartItem($cartItemId); // Remove item if quantity is set below 1
            return;
        }

        // Calculate total weight including the current update
        $totalWeight = $this->calculateTotalWeight($cartItem, $newQuantity);

        // Ensure weight does not exceed the 25kg limit
        if ($productSpec && $totalWeight <= 25) {
            $cartItem->update([
                'quantity' => $newQuantity,
                'price' => $productSpec->product_price * $newQuantity,
                'overall_kg' => $productSpec->product_kg * $newQuantity,
                'product_status' => $productSpec->product->product_status,
            ]);

            $this->updateCartTotals();
            $this->loadCartItems();  // Reload cart items immediately to reflect changes

            session()->flash('message', 'Cart item updated successfully');
        } else {
            session()->flash('error', 'Only 25 kg per customer is available');
        }
    }

    public function removeCartItem($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        $this->updateCartTotals();
        $this->loadCartItems();  // Reload cart items to reflect removal

        session()->flash('message', 'Item removed from cart');
    }

    protected function updateCartTotals()
    {
       // Reload cart items to ensure we have the latest quantities
    $this->cart->load('cartItems');

    // Calculate totals from the latest cart items collection
    $this->cart->cart_total = $this->cart->cartItems->sum('quantity');
    $this->cart->overall_cartKG = $this->cart->cartItems->sum('overall_kg');
    $this->cart->total_price = $this->cart->cartItems->sum('price');

    // Save and reload the cart itself to reflect these updates immediately
    $this->cart->save();
    $this->cart = Cart::with('cartItems')->find($this->cart->id);
    }

    protected function calculateTotalWeight($cartItem, $newQuantity)
    {
        return $this->cart->cartItems
            ->where('id', '!=', $cartItem->id)  // Exclude the current item
            ->sum(fn ($item) => $item->overall_kg)
            + $cartItem->product_specification->product_kg * $newQuantity;
    }
    // "fn" keyword is used in PHP to create an arrow function,
    // which is a shorter syntax for anonymous functions,
    // It provides a clean way to write inline, one-line functions, often making
    // the code easier to read when you have simple operations, especially in array
    // and collection operations.

    // This method will reload cart items from the database for accurate and immediate data
    protected function loadCartItems()
    {
        $this->cartItems = CartItem::where('cart_id', $this->cart->id)
            ->with('product_specification.product')
            ->get();
    }

    public function render()
    {
        return view('livewire.user-cart');
    }
}
