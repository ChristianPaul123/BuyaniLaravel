<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Messaging System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-container {
            display: flex;
            height: 90vh;
            max-width: 1200px;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .user-sidebar {
            background-color: #343a40;
            color: white;
            width: 30%;
            overflow-y: auto;
            padding: 10px;
        }
        .user-item {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #495057;
            transition: background 0.3s;
        }
        .user-item:hover {
            background-color: #495057;
        }
        .user-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .chat-container {
            width: 70%;
            background-color: #f8f9fa;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .message-box {
            overflow-y: auto;
            flex-grow: 1;
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
            position: relative;
        }
        .text {
            background-color: #ffffff;
            padding: 10px 15px;
            border-radius: 20px;
            cursor: pointer;
            display: inline-block;
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
        /* Adjust timestamp for left messages */
        .message.left .timestamp {
            right: -100%; /* Make it appear on the right side of the message */
            margin-left: 10px;
        }
        /* Adjust timestamp for right messages */
        .message.right .timestamp {
            left: -100%; /* Make it appear on the left side of the message */
            margin-right: 10px;
        }
        .message.left:hover .timestamp,
        .message.right:hover .timestamp {
            opacity: 1;
        }
        .btn-leaf-green {
            background-color: #6CAF33;
            border: none;
        }
        .btn-leaf-green:hover {
            background-color: #5a9e2a;
        }
    </style>
</head>
<body>
    <div class="main-container mt-5">
        <!-- Sidebar for Users -->
        <div class="user-sidebar">
            <h5 class="text-center mb-4">Chats</h5>
            <div class="user-item">
                <img src="https://via.placeholder.com/40" alt="User Image">
                <div>
                    <h6 class="mb-0">User 1</h6>
                    <small>Last message...</small>
                </div>
            </div>
        </div>

        <!-- Chat Container -->
        <div class="chat-container">
            <h3 class="text-center" style="color: green;">Buy<span style="color: orange;">Ani</span></h3>
            <div class="message-box mb-3" id="chatBox">
                <!-- Left Side Messages -->
                <div class="message left">
                    <img src="https://via.placeholder.com/40" alt="User Image">
                    <div class="text-container">
                        <div class="user small text-muted">User 1</div>
                        <div class="text">Hello, Kian</div>
                        <div class="timestamp">Sent: 2024-11-09 12:45 PM</div>
                    </div>
                </div>

                <!-- Right Side Messages -->
                <div class="message right admin-msg">
                    <div class="text-container">
                        <div class="user small text-muted">You:</div>
                        <div class="text">Hi, User 1</div>
                        <div class="timestamp">Sent: 2024-11-09 12:46 PM</div>
                    </div>
                </div>
            </div>

            <!-- Message Input -->
            <form id="messageForm">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Message Admin" id="messageInput" required>
                    <button class="btn btn-leaf-green" type="submit">Send</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (with Popper) -->
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
                messageDiv.className = 'message right admin-msg';
                const currentTimestamp = new Date().toLocaleString();

                messageDiv.innerHTML = `
                    <div class="text-container">
                        <div class="user small text-muted">You:</div>
                        <div class="text">${newMessageText}</div>
                        <div class="timestamp">Sent: ${currentTimestamp}</div>
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
