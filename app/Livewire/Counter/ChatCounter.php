<?php

namespace App\Livewire\Counter;

use App\Models\Chat;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ChatCounter extends Component
{

    public $unreadMessagesCount = 0;
    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->unreadMessagesCount = Chat::where('user_id', Auth::guard('user')->id())
            ->sum('is_message_count');
    }
    public function render()
    {
        return view('livewire.counter.chat-counter');
    }
}
