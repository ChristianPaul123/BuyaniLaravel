<?php

namespace App\Livewire\Admin;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use App\Models\Messages;
use App\Livewire\Birdcount;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminChatConsumer extends Component
{
    public $chatId;
    public $messages = [];
    public $messageInput;
    public $users;
    public $selectedUser;
    // public $birdcount = 0;

    protected $rules = [
        'messageInput' => 'required|string|max:255',
    ];

    public function mount()
    {
        // Load all users with user_type = 1 (Consumers)
        $this->users = $this->getUsersWithLastMessage();

        // Auto-select the first user if available
        if ($this->users->isNotEmpty()) {
            $this->selectChat($this->users->first()->id);
        }
    }

    public function getUsersWithLastMessage()
    {
        // Fetch all users with their chat and latest message
        return User::where('user_type', 1) // Assuming `1` is for consumer
            ->with(['chat' => function ($query) {
                $query->with(['messages' => function ($query) {
                    $query->latest('created_at')->take(1); // Fetch the most recent message
                }]);
            }])
            ->get();
    }

    public function selectChat($userId)
    {
        $this->selectedUser = User::find($userId);

        // Find or create the chat room with this user
        $chat = Chat::firstOrCreate(
            ['user_id' => $userId, 'chat_status' => 1],
            ['created_at' => now(), 'updated_at' => now()]
        );

        $this->chatId = $chat->id;

        // Load messages for the selected chat
        $this->loadMessages();
    }

    // #[On('birdcount')]
    // public function testme($birdcount = null) {
    //     $this->birdcount = $birdcount + 100;
    //     $this->dispatch('birdcount', $birdcount)->to(Birdcount::class);
    // }

    public function sendMessage()
    {
        // Trim and sanitize the input
        $sanitizedMessage = trim(strip_tags($this->messageInput));

        // If the sanitized message is empty, disregard the action
        if (empty($sanitizedMessage)) {
            return; // Stop execution without doing anything
        }

        // Create a new message
        Messages::create([
            'chat_id' => $this->chatId,
            'user_id' => null,
            'admin_id' => Auth::guard('admin')->id(),
            'message_info' =>  $sanitizedMessage,
            'is_deleted' => 0,
            'is_edited' => 0,
        ]);

        // Reload messages and reset input
        $this->loadMessages();
        $this->reset(['messageInput']);
    }

    private function loadMessages()
    {
        $this->messages = Messages::where('chat_id', $this->chatId)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function render()
    {
        $this->loadMessages();

        return view('livewire.admin.admin-chat-consumer', [
            'messages' => $this->messages,
            'users' => $this->users,
        ]);
    }
}
