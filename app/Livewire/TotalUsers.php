<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class TotalUsers extends Component
{

    public $totalUsers;

    public function mount()
    {
        $this->totalUsers = User::count();
    }
    public function render()
    {
        return view('livewire.total-users');
    }
}
