@extends('layouts.admin-app')

@section('title', 'Admin | Customization')

@push('styles')
<style>
        .chat-app {
            display: flex;
            height: 70vh;
            flex-direction: row;
        }

        /* Sidebar Styles */
        .chat-sidebar {
            width: 25%;
            max-width: 250px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .chat-sidebar h4 {
            padding: 15px;
            background-color: #212529;
            margin: 0;
            text-align: center;
        }

        .user-search {
            padding: 10px;
            background-color: #212529;
            border-bottom: 1px solid #495057;
        }

        .user-search input {
            width: 100%;
            border-radius: 20px;
            border: 1px solid #495057;
            padding: 5px 10px;
            background-color: #495057;
            color: white;
        }

        .user-list {
            flex-grow: 1;
        }

        .user-item {
            padding: 10px 15px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border-bottom: 1px solid #495057;
        }

        .user-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-item:hover {
            background-color: #495057;
        }

        .user-item .details {
            flex-grow: 1;
        }

        .user-item .name {
            font-size: 0.9rem;
            font-weight: bold;
        }

        .user-item .last-message {
            font-size: 0.8rem;
            color: #ced4da;
        }

        /* Main Chat Area Styles */
        .main-chat {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
        }

        .chat-header {
            padding: 10px 15px;
            background-color: #69a540; /* Blue header */
            color: white;
            text-align: center;
            font-size: 1.1rem;
        }

        .message-box {
            flex-grow: 1;
            overflow-y: auto;
            padding: 15px;
            background-color: #e9ecef;
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
            margin: 0 10px;
        }

        .text-container {
            max-width: 75%;
        }

        .text {
            background-color: #ffffff;
            padding: 10px 15px;
            border-radius: 20px;
        }

        .message.left .text {
            background-color: #90fa9c; /* Light green for user messages */
            border-top-left-radius: 0;
            border-bottom-left-radius: 20px;
        }

        .message.right .text {
            background-color: #90d7f7; /* Light blue for admin messages */
            border-top-right-radius: 0;
            border-bottom-right-radius: 20px;
        }


        .timestamp {
            opacity: 0;
            transition: opacity 0.3s ease-in-out, visibility 0.3s;
            visibility: hidden;
            background-color: #ffffff;
            padding: 2px 5px;
            border-radius: 5px;
            font-size: 0.8rem;
            color: #6c757d;
            position: absolute;
            bottom: -20px;
        }

        .details .last-message {
            color: #ffffff;
            font-size: 12px;
            margin-top: 3px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .details .last-message strong {
            color: #69cb23; /* Darker color for the sender */
            font-weight: bold;
        }

        .details .last-message span {
            color: #ffffff;
            font-size: 10px;
            margin-left: 5px;
            white-space: nowrap;
        }

        .message:hover .timestamp {
            visibility: visible;
            opacity: 1;
            transition-delay: 3s;
        }

        .input-area {
            padding: 10px;
            border-top: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .input-group input {
            border-radius: 20px;
        }

        .btn-send {
            background-color: #6CAF33;
            color: white;
        }

        .btn-send:hover {
            background-color: #5a9e2a;
        }

        .main-section {
        min-height: 90vh;
        max-height: 90vh;
        }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .chat-app {
            flex-direction: column;
        }

        .chat-sidebar {
            width: 100%;
            max-width: none;
            border-bottom: 1px solid #495057;
            height: auto;
            order: 1;
        }

        .user-list {
            flex-grow: 1;
            overflow-y: auto;
        }

        .main-chat {
            flex-grow: 1;
            order: 2;
        }

        .message-box {
            margin-top: 20px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Chat System</h1>
            </div>
            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs" id="adminchatTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="chatconsumer-tab" data-bs-toggle="tab" data-bs-target="#chatconsumer" href="#chatconsumer" role="tab">All Consumers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="chatfarmer-tab" data-bs-toggle="tab" data-bs-target="#chatfarmer" href="#chatfarmer" role="tab">All Farmers</a>
                </li>
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="adminchatTabsContent">
                {{-- Admins Chat Consumer Tab --}}
                <div class="tab-pane fade show active" id="chatconsumer" role="tabpanel" aria-labelledby="chatconsumer-tab">
                    @livewire('chat-admin-consumer')
                </div>

                {{-- Admins Chat Farmer Tab --}}
                <div class="tab-pane fade" id="chatfarmer" role="tabpanel" aria-labelledby="chatfarmer-tab">
                    @livewire('chat-admin-farmer')
                </div>
            </div>
        </section>
    </div>
</div>



@endsection
@section('scripts')
{{-- for the tab to stay where it should --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Cache DOM elements
        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const chatBox = document.getElementById('chatBox');

        // Scroll to the bottom of the chat box
        window.scrollToBottom = function () {
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        };

        // Automatically scroll on initial load
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
                    messageDiv.className = 'message right'; // Adjust class for admin side if needed
                    const currentTimestamp = new Date().toLocaleString([], {
                        hour: '2-digit',
                        minute: '2-digit',
                    });

                    messageDiv.innerHTML = `
                        <div class="text-container">
                            <div class="user small text-muted">You (Admin):</div>
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

    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab');
        if (activeTab) {
            const tab = document.querySelector(`a[href="#${activeTab}"]`);
            if (tab) {
                const tabInstance = new bootstrap.Tab(tab);
                tabInstance.show();
            }
        }
    });

        document.addEventListener('DOMContentLoaded', function () {
        function activateSavedTab() {
            let activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                let tabElement = document.querySelector(`button[data-bs-target="${activeTab}"]`);
                if (tabElement) {
                    tabElement.click();
                }
            }
        }

        activateSavedTab();

        // Add event listener for Livewire updates
        document.addEventListener('livewire:load', activateSavedTab);
        document.addEventListener('livewire:update', activateSavedTab);

        // Save active tab on click
        const tabLinks = document.querySelectorAll('.nav-link');
        tabLinks.forEach(tabLink => {
            tabLink.addEventListener('click', function (e) {
                let targetTab = e.target.getAttribute('data-bs-target');
                localStorage.setItem('activeTab', targetTab);
            });
        });
    });


</script>

@endsection
