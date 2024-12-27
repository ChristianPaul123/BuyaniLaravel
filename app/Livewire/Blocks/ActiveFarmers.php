<?php

namespace App\Livewire\Blocks;

use Livewire\Component;
use Illuminate\Foundation\Auth\User;

class ActiveFarmers extends Component
{
    public $activeFarmers;

    public function mount()
    {
        $this->activeFarmers = User::where('status', true)
        ->where('user_type', 2)
        ->count();
    }

    public function render()
    {
        return view('livewire.blocks.active-farmers');
    }
}
