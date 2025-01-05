<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Inventory;
use App\Models\ProductSpecification;

class UserCart extends Component
{

    public $cartItems;
    public $cart;
    public $selectedItems = [];
    public $selectAll = false;
    public $totalSelectedPrice = 0;
    public $totalWeightselected = 0;
    public $maxLimit = 25;
    public $manageOrder = [];


    public function mount($cart)
    {
        $this->cart = $cart;
        $this->loadCartItems();

        foreach ($this->cartItems as $item) {
            $this->manageOrder[$item->id] = 0;
        }
    }

    public function updateQuantity($cartItemId, $action)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $productSpec = ProductSpecification::find($cartItem->product_specification_id);
        $inventory = Inventory::where('product_id', $productSpec->product_id)->first();
        $maxLimit = $this->maxLimit;
        $inputQuantity = $this->manageOrder[$cartItemId];

        $newQuantity = $action === 'increment' ? $cartItem->overall_kg + $inputQuantity : $cartItem->overall_kg - $inputQuantity;

        if ($newQuantity < 1) {
            $this->removeCartItem($cartItemId);
            return;
        }

        if($newQuantity <= $inventory->product_total_stock) {
            $cartItem->update([
                'quantity' => $newQuantity,
                'price' => $productSpec->product_price * $newQuantity,
                'overall_kg' => $productSpec->product_kg * $newQuantity,
                'product_status' => $productSpec->product->product_status,
            ]);

            $this->updateCartTotals();
            $this->loadCartItems();
            $this->updatedSelectedItems();

            $this->manageOrder[$cartItemId] = 0;

            session()->flash('message', 'Cart item updated successfully');
        } else {
            session()->flash('error', 'Sorry, you can only buy max ' . $inventory->product_total_stock . ' in one checkout.');
        }
    }

    public function removeCartItem($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        $this->updateCartTotals();
        $this->loadCartItems();

        session()->flash('message', 'Item removed from cart');
    }

    protected function updateCartTotals()
    {

    $this->cart->load('cartItems');

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
    protected function loadCartItems()
    {
        $this->cartItems = CartItem::where('cart_id', $this->cart->id)
            ->with('product_specification.product')
            ->get();
    }

    public function toggleSelectAll()
    {

        $this->selectAll = !$this->selectAll;
        $this->totalWeightselected = 0;

        if ($this->selectAll) {
            $this->selectedItems = $this->cartItems->pluck('id')->toArray();

            foreach ($this->selectedItems as $itemId) {
                $item = CartItem::find($itemId);
                if ($item) {
                    $this->totalWeightselected += $item->overall_kg;
                }
            }

            if ($this->totalWeightselected > $this->maxLimit) {
                $this->selectAll = false;
                $this->totalWeightselected = 0;
                $this->selectedItems = [];
                session()->flash('error', 'Total weight exceeds the limit of ' . $this->maxLimit . ' kg');
                return;
            }
        } else {
            $this->selectedItems = [];
        }

        $this->updatedSelectedItems();

    }

    public function updatedSelectedItems()
    {
        $this->totalSelectedPrice = 0;
        $this->totalWeightselected = 0;

        foreach ($this->selectedItems as $itemId) {
            $item = CartItem::find($itemId);
            if ($item) {
                $this->totalSelectedPrice += $item->price;
                $this->totalWeightselected += $item->overall_kg;
            }
        }
    }

    public function selectItem($cartItemId)
    {
        $item = CartItem::find($cartItemId);

        if (!$item) {
            session()->flash('error', 'Item not found.');
            return;
        }

        if (in_array($cartItemId, $this->selectedItems)) {
            $this->selectedItems = array_diff($this->selectedItems, [$cartItemId]);
        } else {
            $newTotalWeight = $this->totalWeightselected + $item->overall_kg;
            if ($newTotalWeight > $this->maxLimit) {
                session()->flash('error', 'Adding this item exceeds the weight limit of ' . $this->maxLimit . ' kg.');
                return; // Do not add the item
            }

            $this->selectedItems[] = $cartItemId;
        }

        // Recalculate total weight and price
        $this->totalSelectedPrice = 0;
        $this->totalWeightselected = 0;

        foreach ($this->selectedItems as $itemId) {
            $selectedItem = CartItem::find($itemId);
            if ($selectedItem) {
                $this->totalSelectedPrice += $selectedItem->price;
                $this->totalWeightselected += $selectedItem->overall_kg;
            }
        }

        $this->updateSelectAllState();
        $this->updatedSelectedItems();
    }

    // Check if all items are selected, and update "Select All" state accordingly
    public function updateSelectAllState()
    {
        $this->selectAll = count($this->selectedItems) === $this->cartItems->count();
    }

    public function render()
    {
        return view('livewire.user-cart');
    }
}
