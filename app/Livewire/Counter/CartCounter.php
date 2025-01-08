<?php

namespace App\Livewire\Counter;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class CartCounter extends Component
{

    public $cartCount = 0;

    public function mount()
    {
        $user = Auth::guard('user')->user();

        if ($user) {
            $this->cartCount = optional($user->cart)->cartItems ? $user->cart->cartItems->count() : 0;
        }
    }


    #[On('addedtoCart')]
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
        return view('livewire.counter.cart-counter');
    }
}
