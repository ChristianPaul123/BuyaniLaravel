<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyani</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow: hidden;
        }
        .header {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50; /* Green background */
            border-radius: 10px 10px 0 0;
        }
        .header img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 24px;
            color: #ffffff;
            margin: 0;
            font-weight: bold;
        }
        .content {
            text-align: center;
            margin: 20px 0;
        }
        .content h2 {
            font-size: 20px;
            color: #333333;
            margin-bottom: 10px;
        }
        .content p {
            font-size: 16px;
            color: #666666;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #f44336; /* Red button */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin: 20px 0;
        }
        .code-box {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            display: inline-block;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('img/buyanicommece_logo.png') }}" alt="Buyani Logo">
            <h1>Buyanicommerce</h1>
        </div>
        <div class="content">
            <h2>Hello Fellow Consumer</h2>
            <h2>Password Reset</h2>
            <h4>Your one time password is:</h4>
                <div class="code-box">{{ $otp }}</div>
        </div>
        <hr>
        <div class="footer">
            <p>This OTP will expire in 5 mins</p>
            <p>If you didn’t request this change, you can ignore this email.</p>
        </div>
    </div>
</body>
</html>



{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyani Password Reset</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px;
        }
        .header img {
            width: 200px;
            height: auto;
        }
        .header h1 {
            font-size: 24px;
            color: #333333;
            margin-top: -60px;
        }
        .content {
            text-align: center;
            margin: 20px 0;
        }
        .content h2 {
            font-size: 20px;
            color: #333333;
            margin-bottom: 10px;
        }
        .content p {
            font-size: 16px;
            color: #666666;
        }
        .code-box {
            background-color: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            display: inline-block;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="Images/BuyAni.png" alt="Buyani Logo">
            <h1>Buyani Shop</h1>
        </div>
        <div class="content">
            <h2>Thank you for Registering to Buyani Shop</h2>
            <p>Please use the following code:</p>
            <div class="code-box">123456</div>
            <p>This OTP will expire in 5 minutes.</p>
        </div>
        <div class="footer">
            <p>If you didn’t request this change, you can ignore this email.</p>
        </div>

        <hr>
    </div>
</body>
</html> --}}

