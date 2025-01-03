<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Messaging System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .chat-container {
            max-width: 600px;
            margin: auto;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .message-box {
            overflow-y: auto;
            max-height: 400px;
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
        .message.left .timestamp {
            right: -160px; /* Adjust for left messages */
        }
        .message.right .timestamp {
            left: -160px; /* Adjust for right messages */
        }
        /* Delay the appearance of the timestamp by 3 seconds on hover */
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
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="chat-container">
            <h3 class="text-center" style="color: green;">Buy<span style="color: orange;">Ani</span></h3>
            <div class="message-box mb-3" id="chatBox">
                <!-- Left Side Messages -->
                <div class="message left" data-timestamp="2024-11-09 12:45 PM">
                    <img src="https://via.placeholder.com/40" alt="User Image">
                    <div class="text-container">
                        <div class="user small text-muted">Kathy Robin</div>
                        <div class="text">Hello, Kian</div>
                        <div class="timestamp">Sent: 2024-11-09 12:45 PM</div>
                    </div>
                </div>
                
                <!-- Right Side Messages -->
                <div class="message right admin-msg" data-timestamp="2024-11-09 12:46 PM">
                    <div class="text-container">
                        <div class="user small text-muted">You:</div>
                        <div class="text">Hi, Kathy</div>
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
