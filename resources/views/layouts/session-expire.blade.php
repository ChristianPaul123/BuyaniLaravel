<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Session Expired</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #1566d6;
        }

        .dialog-container {
            text-align: center;
            background: #fff;
            border-radius: 10px;
            padding: 20px 40px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-size: 80px;
            margin-top: 20px;
            padding: 40px;
        }

        .dialog-container img {
            width: 80px;
            margin-bottom: 20px;
        }

        .dialog-container h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }

        .dialog-container p {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 20px;
        }

        .refresh-button {
            display: inline-block;
            background-color: #1566d6;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .refresh-button:hover {
            background-color: #104a9e;
        }
    </style>
</head>
<body>
    <div class="dialog-container">
        <i class="bi bi-hourglass-bottom"></i>
        <h2>Your session has expired</h2>
        <p>Please log in back to the system and try again</p>
        <button class="refresh-button" onclick="window.location.href='/admin'">Login</button>
    </div>
</body>
</html>
