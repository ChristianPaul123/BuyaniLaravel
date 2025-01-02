<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Ramsey\Uuid\Type\Integer;
use App\Livewire\Admin\AdminChatConsumer;

class Birdcount extends Component
{

    // public Int $birdcount = 0;
    // public string $birdcounttext = "null";

    // public function incrementCount() {
    //     $this->birdcount++;
    //     $this->dispatch('birdcount', $this->birdcount)->to(AdminChatConsumer::class);
    // }

    // #[On('birdcount')]
    // public function onBirdcount() {
    //      $this->birdcounttext = "birdcount";
    // }
    public function render()
    {
        return view('livewire.birdcount');
    }
}
