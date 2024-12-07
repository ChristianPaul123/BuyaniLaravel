<div class="chat-app">
    <!-- Sidebar -->
    <div class="chat-sidebar">
        <h4>Farmer Chats</h4>
        <div class="user-search">
            <input type="text" placeholder="Search user..." wire:model.debounce.300ms="search">
        </div>
        <div class="user-list">
            @foreach ($users as $user)
                <div
                    class="user-item {{ $selectedUser && $selectedUser->id === $user->id ? 'active' : '' }}"
                    wire:click="selectChat({{ $user->id }})"
                >
                    <img src="{{ $user->profile_pic ? asset($user->profile_pic) : 'https://via.placeholder.com/40' }}" alt="User Image">
                    <div class="details">
                        <div class="name">{{ $user->username }}</div>
                        <div class="last-message">
                            @if ($user->chat && $user->chat->messages->isNotEmpty())
                            @php
                                $lastMessage = $user->chat->messages->first();
                                $sender = $lastMessage->admin_id ? ($lastMessage->admin->username ?? 'Admin') : $user->username;
                            @endphp
                            <strong>{{ $sender }}:</strong> {{ Str::limit($lastMessage->message_info, 10) }}
                            <span style="font-size: 0.8rem;">
                                {{ $lastMessage->created_at->diffForHumans() }}
                            </span>
                            @else
                                No messages yet
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Main Chat -->
    <div class="main-chat">
        <div class="chat-header">
            Chat with {{ $selectedUser->username ?? 'Select a user' }}
        </div>
        <div class="message-box mb-3" id="chatBox" wire:poll.5s>
            @foreach ($messages as $message)
                @if ($message->user_id)
                    <!-- Left Side (User Message) -->
                    <div class="message left">
                        {{-- Display user profile image if available --}}
                        <img src="{{ $selectedUser->profile_pic ? asset($selectedUser->profile_pic) : 'https://via.placeholder.com/40' }}" class="user-image" alt="User Image">
                        <div class="text-container">
                            <div class="user small text-muted">{{ $selectedUser->username }}</div>
                            <div class="text">{{ $message->message_info }}</div>
                            <p class="time small text-muted" style="font-style: italic;">
                                {{ $message->created_at->format('h:i A') }}
                            </p>
                            <div class="timestamp">Sent: {{ $message->created_at->format('Y-m-d h:i A') }}</div>
                        </div>
                    </div>
                @else
                    <!-- Right Side (Admin Message) -->
                    <div class="message right admin-msg">
                        <div class="text-container">
                            @if ($message->admin_id === Auth::guard('admin')->id())
                                <!-- Message from logged-in admin -->
                                <div class="user small text-muted">You:</div>
                            @else
                                <!-- Message from another admin -->
                                <div class="user small text-muted">{{ $message->admin->username ?? 'Admin' }}</div>
                            @endif
                            <div class="text">{{ $message->message_info }}</div>
                            <p class="time small text-muted" style="font-style: italic;  margin-bottom: 0; text-align: right; display: block;">
                                {{ $message->created_at->format('h:i A') }}
                            </p>
                            <div class="timestamp">Sent: {{ $message->created_at->format('Y-m-d h:i A') }}</div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="input-area">
            <form wire:submit.prevent="sendMessage" id="messageForm">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type a message..." wire:model="messageInput" id="messageInput" required>
                    <button class="btn btn-send" type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
