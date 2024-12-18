<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class SessionModal extends Component
{

    #[On('sessionMessage')]
    public function messageShow($message) {
        if ($message != null) {
            session()->flash('message', $message);

        }
    }

    #[On('sessionError')]
    public function messageError($error) {
        if ($error != null) {
            session()->flash('error', $error);

        }
    }

    #[On('sessionSuccess')]
    public function messageSuccess($success) {
        if ($success != null) {
            session()->flash('success', $success);

        }
    }
    public function render()
    {
        return view('livewire.session-modal', [
        ]);

    }
}
