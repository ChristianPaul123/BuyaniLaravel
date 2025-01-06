<div class="chat-app">
    <!-- Sidebar -->
    <div class="chat-sidebar">
        <h4>Consumer Chats</h4>
        <div class="user-search">
            {{-- <input type="text" placeholder="Search user..." wire:model.debounce.300ms="search"> --}}
        </div>
        <div class="user-list" wire:ignore>
            @foreach ($users as $user)

                <div wire:key="{{ $user->id }}"
                    class="user-item {{ $selectedUser && $selectedUser->id === $user->id ? 'active' : '' }}"
                    wire:click="selectChat({{ $user->id }})">
                    <img src="{{ $user->profile_pic ? asset($user->profile_pic) : 'https://via.placeholder.com/40' }}" alt="User Image">
                    <div class="details">
                        <div class="name">{{ $user->username }}</div>
                            <div class="last-message">
                                @if ($user->lastMessageText)
                                    <strong>{{ $user->senderName }}:</strong>
                                    {{ $user->lastMessageText }}
                                    <span style="font-size: 0.8rem;">
                                        {{ $user->lastMessageTimeAgo }}
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
        <div class="message-box mb-3" id="chatBoxCon" wire:poll>
            @forelse ($messages as $message)
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
            @empty
                <div class="no-messages d-flex align-items-center justify-content-center" style="height: 100%; width: 100%;">No messages found.</div>
            @endforelse
        </div>
        <div class="input-area">
            <form wire:submit.prevent="sendMessage" id="messageFormCon">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type a message..." wire:model.lazy="messageInput" id="messageInputCon" required>
                    <button class="btn btn-send" type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:initialized', function () {
        // Cache DOM elements
        const messageForm = document.getElementById('messageFormCon');
        const messageInput = document.getElementById('messageInputCon');
        const chatBox = document.getElementById('chatBoxCon');

        // Scroll to the bottom of the chat box
        window.scrollToBottom = function () {
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        };

        // Automatically scroll to the bottom on initial load
        scrollToBottom();

        // Listen to Livewire DOM updates
        Livewire.hook('message.processed', (message, component) => {
            scrollToBottom();
        });

        // Handle manual message sending via form submission
        if (messageForm) {
            messageForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Trim spaces and validate input
                const newMessageText = messageInput.value.trim();
                if (!newMessageText) {
                    alert('Message cannot be empty or contain only spaces.');
                    return; // Prevent form submission
                } else {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message right'; // Adjust class dynamically for user or admin

                    // Determine whether the user is admin or regular user
                    const sender = messageInput.dataset.sender || 'User';
                    const currentTimestamp = new Date().toLocaleString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                    });

                    // Construct the message bubble
                    messageDiv.innerHTML = `
                        <div class="text-container">
                            <div class="user small text-muted">You (${sender}):</div>
                            <div class="text">${newMessageText}</div>
                            <div class="timestamp">${currentTimestamp}</div>
                        </div>
                    `;

                    chatBox.appendChild(messageDiv); // Append the message to the chat box
                    messageInput.value = ''; // Clear the input field
                    scrollToBottom(); // Scroll to the bottom
                }
            });
        }
    });
</script>
@endscript
