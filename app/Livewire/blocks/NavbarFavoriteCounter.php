<?php

namespace App\Livewire\Component;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class NavbarFavoriteCounter extends Component
{

    public $favoritesCount = 0;

    public function mount()
    {
        $user = Auth::guard('user')->user();

        if ($user) {
            $this->favoritesCount = $user->favorites->count() ?? 0; // Count user's favorites
        }
    }

    #[On('toggleFavorites')]
    public function toggleFavorites()
    {

        $user = Auth::guard('user')->user();

        if ($user) {
            $this->favoritesCount = $user->favorites->count() ?? 0; // Count user's favorites
        }
    }
    public function render()
    {
        return view('livewire.component.navbar-favorite-counter');
    }
}
