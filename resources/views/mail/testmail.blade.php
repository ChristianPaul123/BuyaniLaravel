<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #f7941d;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
        }
        .header img {
            width: 120px;
            margin-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 22px;
        }
        .content {
            padding: 20px;
            text-align: left;
            color: #333333;
        }
        .content p {
            line-height: 1.6;
            margin: 10px 0;
        }
        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 15px 10px;
            font-size: 12px;
            color: #888888;
        }
        .cta-button {
            display: inline-block;
            background-color: #f7941d;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 20px;
        }
        .cta-button:hover {
            background-color: #d37c1a;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <img src="{{ asset('logo1.svg') }}" alt="Company Logo">
            <h2>Welcome to BuyaniCommerce</h2>
        </div>
        
        <!-- Content Section -->
        <div class="content">
            <p>Hi {{ 'Valued Customer' }},</p>
            <p>Thank you for shopping with us! This email is to confirm your recent transaction with our store.</p>
            <p>If you have any questions, please feel free to reach out to us anytime.</p>
            
            <p>
                <a href="#" class="cta-button">Visit Our Store</a>
            </p>
        </div>
        
        <!-- Footer Section -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Buyanicommerce. All rights reserved.</p>
            <p>
                <a href="#" style="color: #888888; text-decoration: none;">Privacy Policy</a> |
                <a href="#" style="color: #888888; text-decoration: none;">Contact Us</a>
            </p>
        </div>
    </div>
</body>
</html>
