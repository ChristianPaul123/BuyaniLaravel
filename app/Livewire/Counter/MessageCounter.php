<?php

namespace App\Livewire\Counter;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MessageCounter extends Component
{
    public $MessageCount = 0;
    public function mount()
    {
        $user = Auth::guard('user')->user();

        // if ($user) {
        //     $this->MessageCount =
        // }
    }

    public function render()
    {
        return view('livewire.counter.message-counter');
    }
}
