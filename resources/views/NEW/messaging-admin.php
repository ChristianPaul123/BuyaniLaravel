<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Messaging System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }

        .chat-app {
            display: flex;
            height: 100vh;
            flex-direction: row;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 25%;
            max-width: 250px;
            background-color: #343a40;
            color: white;
            display: flex;
            flex-direction: column;
        }

        .sidebar h4 {
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
            overflow-y: auto;
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
            border-top-left-radius: 0;
            border-bottom-left-radius: 20px;
        }

        .message.right .text {
            background-color: #d4edda;
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

        /* Responsive Styles */
        @media (max-width: 768px) {
            .chat-app {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                max-width: none;
                border-bottom: 1px solid #495057;
                height: auto;
                order: 1;
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
</head>
<body>
    <div class="chat-app">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4>BuyAni Chats</h4>
            <div class="user-search">
                <input type="text" placeholder="Search user...">
            </div>
            <div class="user-list">
                <div class="user-item">
                    <img src="https://via.placeholder.com/40" alt="User Image">
                    <div class="details">
                        <div class="name">User 1</div>
                        <div class="last-message">Last message...</div>
                    </div>
                </div>
                <div class="user-item">
                    <img src="https://via.placeholder.com/40" alt="User Image">
                    <div class="details">
                        <div class="name">User 2</div>
                        <div class="last-message">Last message...</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Chat -->
        <div class="main-chat">
            <div class="chat-header">Chat with User 1</div>
            <div class="message-box" id="chatBox">
                <div class="message left">
                    <img src="https://via.placeholder.com/40" alt="User Image">
                    <div class="text-container">
                        <div class="text">Hello, Kian!</div>
                        <div class="timestamp">12:45 PM</div>
                    </div>
                </div>
                <div class="message right">
                    <div class="text-container">
                        <div class="text">Hi, Kathy</div>
                        <div class="timestamp">12:46 PM</div>
                    </div>
                </div>
            </div>
            <div class="input-area">
                <form id="messageForm">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Type a message..." id="messageInput" required>
                        <button class="btn btn-send" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const messageForm = document.getElementById('messageForm');
        const messageInput = document.getElementById('messageInput');
        const chatBox = document.getElementById('chatBox');

        messageForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const newMessageText = messageInput.value.trim();

            if (newMessageText) {
                const messageDiv = document.createElement('div');
                messageDiv.className = 'message right';
                const currentTimestamp = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                messageDiv.innerHTML = `
                    <div class="text-container">
                        <div class="text">${newMessageText}</div>
                        <div class="timestamp">${currentTimestamp}</div>
                    </div>
                `;

                chatBox.appendChild(messageDiv);
                messageInput.value = '';
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    </script>
</body>
</html>
