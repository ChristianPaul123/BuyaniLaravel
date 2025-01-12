{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #eeeeee;
        }
        .container {
            background-color: #ffffff;
            border-radius: 5px;
        }
        .header {
            background-color: #F44336;
            color: #ffffff;
        }
        .header h1 {
            font-weight: 800;
        }
        .content h2 {
            font-weight: 800;
            color: #333333;
        }
        .footer {
            background-color: #ffffff;
            text-align: center;
        }
        .footer p, .footer a {
            color: #777777;
        }

    </style>
</head>
<body>
    <div class="container my-5 p-4">
        <div class="header text-center py-4">
            <h1>Buyani</h1>
            <a href="#" class="text-white h5">Shop <img src="https://img.icons8.com/color/48/000000/small-business.png" alt="Shop Icon" width="27" height="23"></a>
        </div>

        <div class="text-center py-4">
            <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" alt="Checked Checkbox" width="125" height="120">
            <h2>Thank you for Registering to Buyani Shop</h2>
        </div>

        <div class="content text-center px-4">
            <p>Your OTP is {{ $otp }}</p>
            <p>This OTP will expire in 5 mins </p>
        </div>

        <div class="footer py-4">
            <img src="logo-footer.png" alt="Logo" width="37" height="37" class="mb-2">
            {{-- <p>675 Parko Avenue<br>LA, CA 02232</p> --}}
            <p>If you didn't create an account using this email address, please ignore this email</p>
        </div>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Shipped</title>
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
            <h2>Thank you for Registering to Buyani Shop</h2>
        </div>
        <div class="content">
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
