<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ExampleModal extends Component
{

    public string $message;
    public $dirtyString = 'hahahaha';


    #[On('messageRecieved')]
    public function message($message = null) {
        $this->message = $message;
    }

    public function removeDirty() {
        $this->dirtyString = '';
    }

    #[On('testtest')]
    public function test() {
        dd('aaa');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.example-modal');
    }
}
