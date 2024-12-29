<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            width: 100px;
            margin-bottom: 10px;
        }
        .content {
            text-align: center;
            padding: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Test Email</h2>
        </div>
        <div class="content">
            <p>Hello,</p>
            <p>This is a test email to verify that your email service is working correctly.</p>
            <p>If you receive this email, your setup is successful!</p>
        </div>
        <div class="footer">
            <p>Thank you for using our service.</p>
            <p>&copy; {{ date('Y') }} Your Company Name</p>
        </div>
    </div>
</body>
</html>
