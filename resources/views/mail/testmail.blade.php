<!DOCTYPE html>
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
        .order-info .order-number, .order-info .price {
            font-weight: 800;
        }
        .total {
            border-top: 3px solid #eeeeee;
            border-bottom: 3px solid #eeeeee;
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
            <h2>Thank You For Your Acceptance!</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium iste ipsa numquam odio dolores, nam.</p>
        </div>

        <div class="content px-4">
            <table class="table order-info">
                <tbody>
                    <tr>
                        <td class="order-number">Order Confirmation #</td>
                        <td class="price">$2345678</td>
                    </tr>
                    <tr>
                        <td class="item">Purchased Item (1)</td>
                        <td class="price">$100.00</td>
                    </tr>
                    <tr>
                        <td class="item">Shipping + Handling</td>
                        <td class="price">$10.00</td>
                    </tr>
                    <tr>
                        <td class="item">Sales Tax</td>
                        <td class="price">$5.00</td>
                    </tr>
                    <tr>
                        <td class="total">TOTAL</td>
                        <td class="price">$115.00</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <h5>Delivery Address</h5>
                <p>675 Massachusetts Avenue<br>11th Floor<br>Cambridge, MA 02139</p>

                <h5>Estimated Delivery Date</h5>
                <p>January 1st, 2016</p>
            </div>
        </div>

        <div class="footer py-4">
            <img src="logo-footer.png" alt="Logo" width="37" height="37" class="mb-2">
            <p>675 Parko Avenue<br>LA, CA 02232</p>
            <p>If you didn't create an account using this email address, please ignore this email or <a href="#">unsubscribe</a>.</p>
        </div>
    </div>
</body>
</html>
