<?php

namespace App\Livewire\Components;

use Livewire\Component;

class UserNavCounters extends Component
{

    public $cartCount = 0;
    public $favoritesCount = 0;

    public function mount()
    {
        $user = auth()->guard('user');

        if ($user) {
            $this->cartCount = $user->cart->cartItems->count() ?? 0; // Count items in the user's cart
            $this->favoritesCount = $user->favorites->count() ?? 0; // Count user's favorites
        }
    }

    public function render()
    {
        return view('livewire.usernav-counters');
    }
}
