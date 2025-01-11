@extends('layouts.app') <!-- Extend your main layout -->

@section('title', 'Chat System') <!-- Define the title for this page -->

@push('styles')
<style>
    .chat-container {
        max-width: 65rem;
        margin: auto;
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .message-box {
        overflow-y: auto;
        overflow-x: hidden;
        max-height: 400px;
        min-height: 400px;
        padding: 10px;
        background-color: #e9ecef;
        border-radius: 10px;
    }
    .message {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        position: relative;
    }
    .message.left {
        flex-direction: row;
    }
    .message.right {
        flex-direction: row-reverse;
    }
    .message img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 10px;
    }
    .text-container {
        max-width: 75%;
        padding: 10px;
        border-radius: 8px;
        position: relative;
    }

    .text-container .time {
        font-size: 0.8rem;
        font-style: italic;
        margin-top: 5px;
        color: #888; /* Light gray color for the time */
        text-align: right;
    }


    .text {
        background-color: #ffffff;
        padding: 10px 15px;
        border-radius: 20px;
        cursor: pointer;
        display: inline-block;
    }
    .message.left .text {
        background-color: #90d7f7; /* Light blue for admin messages */
        border-top-left-radius: 0;
        border-bottom-left-radius: 20px;
    }
    .message.right .text {
        /* background-color: #d4edda; */
        background-color: #90fa9c; /* Light green for user messages */
        border-top-right-radius: 0;
        border-bottom-right-radius: 20px;
    }
    .timestamp {
        opacity: 0;
        background-color: white;
        padding: 2px 5px;
        border-radius: 5px;
        font-size: 0.8rem;
        color: #6c757d;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        transition: opacity 0.3s ease-in-out;
    }
    .message.left .timestamp {
        right: -160px; /* Adjust for left messages */
    }
    .message.right .timestamp {
        left: -160px; /* Adjust for right messages */
    }
    .message.left:hover .timestamp,
    .message.right:hover .timestamp {
        transition-delay: 3s;
        opacity: 1;
    }
    .btn-leaf-green {
        background-color: #6CAF33;
        border: none;
    }
    .btn-leaf-green:hover {
        background-color: #5a9e2a;
    }

    .min-height {
        min-height: 100vh;
    }
</style>
@endpush

@section('content')
@include('user.includes.navbar-consumer')

<div class="main-content-wrapper h-100">
    <div class="h-100">
    <div class="m-auto h-100 d-flex align-items-center">
        <div class="container">
            <!-- Chat Header -->
            <div class="text-center mb-3">
                <h3 class="text-center" style="color: green;">Buy<span style="color: orange;">Ani</span> Support Chat</h3>
            </div>
            @livewire('user.user-chat-system',['chatID' => Auth::guard('user')->user()->id])
        </div>
    </div>
    </div>
</div>
@endsection


@section('scripts')
<script>

    // document.addEventListener('livewire:load', function () {
    //     // Automatically scroll to the bottom after each Livewire DOM update
    //     Livewire.hook('message.processed', (message, component) => {
    //         window.scrollToBottom();
    //     });

    //     // Scroll to the bottom when the page is first loaded
    //     window.scrollToBottom();
    // });

    document.addEventListener('DOMContentLoaded', function () {
        // Cache DOM elements
        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const chatBox = document.getElementById('chatBox');

        // Define scrollToBottom function
        window.scrollToBottom = function () {
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom
            }
        };

        // Automatically scroll to the bottom on initial load
        window.scrollToBottom();

        // Handle manual message sending via form submission
        if (messageForm) {
            messageForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const newMessageText = messageInput.value.trim();

                if (!newMessageText) {
                    alert('Message cannot be empty or contain only spaces.');
                    return; // Prevent form submission
                } else {
                    // Optionally create a temporary message in the chatbox
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'message right';
                    const currentTimestamp = new Intl.DateTimeFormat('en-US', {
                        dateStyle: 'short',
                        timeStyle: 'short',
                        timeZone: 'Asia/Manila' // Time zone for the Philippines
                    }).format(new Date());

                    messageDiv.innerHTML = `
                        <div class="text-container">
                            <div class="user small text-muted">You:</div>
                            <div class="text">${newMessageText}</div>
                            <div class="timestamp">Sent: ${currentTimestamp}</div>
                        </div>
                    `;

                    chatBox.appendChild(messageDiv); // Append the message
                    messageInput.value = ''; // Clear input field
                    window.scrollToBottom(); // Scroll to the bottom
                }
            });
        }
    });
</script>
@endsection
{{-- // document.addEventListener('livewire:load', function () {
    //     Livewire.hook('message.processed', () => {
    //         const chatBox = document.getElementById('chatBox');
    //         if (chatBox) {
    //             chatBox.scrollTop = chatBox.scrollHeight;
    //         }
    //     });
    // });

    // document.addEventListener('DOMContentLoaded', function () {
    //     // Cache DOM elements
    //     const messageForm = document.getElementById('messageForm');
    //     const messageInput = document.getElementById('messageInput');
    //     const chatBox = document.getElementById('chatBox');

    //     // Scroll to the bottom of the chat box
    //     window.scrollToBottom = function () {
    //         if (chatBox) {
    //             chatBox.scrollTop = chatBox.scrollHeight;
    //         }
    //     };

    //     // Automatically scroll on initial load
    //     scrollToBottom();

    //     // Listen to Livewire DOM updates
    //     Livewire.hook('message.processed', (message, component) => {
    //         scrollToBottom();
    //     });

    //     // Handle manual message sending via form submission
    //     if (messageForm) {
    //         messageForm.addEventListener('submit', function (e) {
    //             e.preventDefault();
    //             const newMessageText = messageInput.value.trim();
    //             if (!newMessageText) {
    //                 alert('Message cannot be empty or contain only spaces.');
    //                 return; // Prevent form submission
    //             } else {
    //                 const messageDiv = document.createElement('div');
    //                 messageDiv.className = 'message right'; // Adjust class if necessary
    //                 const currentTimestamp = new Date().toLocaleString();

    //                 messageDiv.innerHTML = `
    //                     <div class="text-container">
    //                         <div class="user small text-muted">You:</div>
    //                         <div class="text">${newMessageText}</div>
    //                         <div class="timestamp">Sent: ${currentTimestamp}</div>
    //                     </div>
    //                 `;

    //                 chatBox.appendChild(messageDiv); // Append the message to the chat box
    //                 messageInput.value = ''; // Clear the input field
    //                 scrollToBottom(); // Scroll to the bottom

    //             }
    //         });
    //     }
    // }); --}}

