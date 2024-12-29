<?php

namespace App\Livewire;

use Livewire\Component;

class ExampleModalButton extends Component
{

    public $dirtyString = 'hahahaha';

    public function showexampleModal()
    {
        $message = 'Modal message received';

        $this->dispatch('show-modal', ['modal' => 'exampleModal'])->to(ExampleModal::class);
        //dd($this->dispatch('show-modal', ['modal' => 'exampleModal'])->to(ExampleModal::class));
        $this->dispatch('messageRecieved', $message);
    }
    public function render()
    {
        return view('livewire.example-modal-button');
    }
}
