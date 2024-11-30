<div class="min-height">
<div class="chat-container">
    <section>
    <div class="message-box mb-3" id="chatBox">
        @foreach ($messages as $message)
            @if ($message->user_id)
                <!-- Left Side (User Message) -->
                <div class="message right">
                    {{-- <img src="{{ auth()->guard('user')->user()->profile_pic ? asset(auth()->guard('user')->user()->profile_pic) : asset('img/logo1.svg') }}" class="user-image" alt="User Image"> --}}
                    <div class="text-container">
                        <div class="user small text-muted">You:</div>
                        {{-- <div class="user small text-muted">{{ $message->user->username }}</div> --}}
                        <div class="text">{{ $message->message_info }}</div>
                        <div class="timestamp">Sent: {{ $message->created_at->format('Y-m-d h:i A') }}</div>
                    </div>
                </div>
            @else
                <!-- Right Side (Admin Message) -->
                <div class="message left admin-msg">
                    <div class="text-container">
                        <div class="user small text-muted">Admin</div>
                        <div class="text">{{ $message->message_info }}</div>
                        <div class="timestamp">Sent: {{ $message->created_at->format('Y-m-d h:i A') }}</div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Message Input -->
    <form wire:submit.prevent="sendMessage">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Message" wire:model="messageInput" required>
            <button class="btn btn-leaf-green" type="submit">Send</button>
        </div>
    </form>
    </section>
</div>
</div>
