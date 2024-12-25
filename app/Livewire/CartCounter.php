<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCounter extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $user = Auth::guard('user')->user();

        if ($user) {
            if ($user) {
                $this->cartCount = $user->cart->cartItems->count() ?? 0; // Count items in the user's cart
            }
        }
    }


    public function getCartCount() {
        $user = Auth::guard('user')->user();

        if ($user) {
            if ($user) {
                $this->cartCount = $user->cart->cartItems->count() ?? 0; // Count items in the user's cart
            }
        }
    }
    public function render()
    {
        return view('livewire.cart-counter');
    }
}
