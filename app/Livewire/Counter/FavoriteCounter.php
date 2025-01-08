<?php

namespace App\Livewire\Counter;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class FavoriteCounter extends Component
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
            $this->favoritesCount = optional($user->favorites)->count() ?? 0; // Safely count user's favorites
        }
    }
    public function render()
    {
        return view('livewire.counter.favorite-counter');
    }
}
