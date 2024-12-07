<?php

namespace App\Livewire;

use App\Models\Chat;
use Livewire\Component;
use App\Models\Messages;
use Illuminate\Support\Facades\Auth;

class ChatUserSystem extends Component
{
    public $chatId;
    public $messages;
    public $messageInput;

    protected $rules = [
        'messageInput' => 'required|string|max:255',
    ];

    public function mount($chatId = null)
    {
        // Ensure the user is authenticated as a 'user'
        $user = Auth::guard('user')->user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        // Determine if a chat session already exists
        if (!$chatId) {
            $chat = Chat::firstOrCreate(
                ['user_id' => $user->id, 'chat_status' => 1],
                ['created_at' => now(), 'updated_at' => now()]
            );
            $this->chatId = $chat->id;
        } else {
            $this->chatId = $chatId;
        }

        // Load all messages for the chat
        $this->loadMessages();
    }

    public function sendMessage()
    {
        $sanitizedMessage = trim(strip_tags($this->messageInput));

        // If the sanitized message is empty, disregard the action
        if (empty($sanitizedMessage)) {
            return; // Stop execution without doing anything
        }

        // Save the new message
        Messages::create([
            'chat_id' => $this->chatId,
            'user_id' => Auth::guard('user')->id(), // Always associate the authenticated user
            'admin_id' => null, // Always null for this customer service model
            'message_info' => $sanitizedMessage,
            'is_deleted' => 0,
            'is_edited' => 0,
        ]);

        // Reload messages and reset the input field
        $this->loadMessages();
        $this->reset(['messageInput']);

        //Emit an event to scroll the chatbox to the bottom
        //$this->emit('messageSent');
    }

    private function loadMessages()
    {
        $this->messages = Messages::where('chat_id', $this->chatId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
         // Reload messages dynamically
         $this->loadMessages();

        return view('livewire.chat-user-system', [
            'messages' => $this->messages,
        ]);
    }
}
