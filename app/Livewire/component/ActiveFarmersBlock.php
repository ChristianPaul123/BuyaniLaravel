<?php

namespace App\Livewire\Component;

use App\Models\User;
use Livewire\Component;

class ActiveFarmersBlock extends Component
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
        return view('livewire.component.active-farmers-block');
    }
}
