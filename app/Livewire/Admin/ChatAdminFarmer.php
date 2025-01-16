<?php

namespace App\Livewire\Admin;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use App\Models\Messages;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ChatAdminFarmer extends Component
{
    public $chatId;
    public $messages = [];
    public $messageInput;
    public $users;
    public $selectedUser;

    protected $rules = [
        'messageInput' => 'required|string|max:255',
    ];

    public function mount()
    {
        // Load all users with user_type = 2 (Farmers)
        $this->users = $this->getUsersWithLastMessage();

        // Auto-select the first user if available
        if ($this->users->isNotEmpty()) {
            $this->selectChat($this->users->first()->id);
        }
    }


    public function getUsersWithLastMessage()
    {
        $users = User::where('user_type', 2)
            ->with(['chat' => function ($query) {
                $query->with(['messages' => function ($q) {
                    $q->latest('created_at')->take(1);
                }]);
            }])
            ->get();

        // Append last message details to each user instance
        foreach ($users as $user) {
            if ($user->chat && $user->chat->messages->isNotEmpty()) {
                $lastMessage = $user->chat->messages->first();

                // Determine the sender name
                $sender = $lastMessage->admin_id
                    ? ($lastMessage->admin->username ?? 'Admin')
                    : $user->username;

                // Store these values so we can display them in the Blade
                $user->senderName = $sender;
                $user->lastMessageText = Str::limit($lastMessage->message_info, 10);
                $user->lastMessageTimeAgo = $lastMessage->created_at->diffForHumans();
            } else {
                // For users with no messages, set these to null
                $user->senderName = null;
                $user->lastMessageText = null;
                $user->lastMessageTimeAgo = null;
            }
        }

        return $users;
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

    public function sendMessage()
    {
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
            'message_info' => $sanitizedMessage,
            'is_deleted' => 0,
            'is_edited' => 0,
        ]);

        // Increment the message count for the user
        $chat = Chat::find($this->chatId);
        if ($chat) {
            $chat->increment('is_message_count');
        }

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

        return view('livewire.admin.chat-admin-farmer', [
            'messages' => $this->messages,
            'users' => $this->users,
        ]);
    }
}
