<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Delivered</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f7f7f7;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
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

        .header h2 {
            color: #dca91b;
        }

        .order-details,
        .shipping-info {
            margin-bottom: 30px;
        }

        .order-details table,
        .shipping-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-details th,
        .shipping-info th {
            text-align: left;
            background-color: #f2f2f2;
            padding: 10px;
        }

        .order-details td,
        .shipping-info td {
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .total-price {
            font-size: 1.2em;
            font-weight: bold;
            color: #e74c3c;
        }

        .footer {
            text-align: center;
            font-size: 0.9em;
            color: #777;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="{{ url('https://buyanicommerce.bsitcps.com/public/img/buyanicommece_logo.png') }}" alt="Buyani Logo">
            <h1>Buyanicommerce</h1>
            <h2>Order is out for Delivery</h2>
            <p>Dear {{ $order->customer_name }},</p>
            <p>Your order Has now been accepted and will be delivered to you by our Delivery man: <strong> {{ $order->delivery_employee }}</strong></p><br>
            <p>If you have any questions please message us via our messaging system about your order information</p><br>
            <p>Once you received you order, click order received to register that your order is completed. Thank you</p>
        </div>

        <div class="order-details">
            <h3>Order Details</h3>
            <table>
                <tr>
                    <th>Order Number</th>
                    <td>{{ $order->order_number }}</td>
                </tr>
                <tr>
                    <th>Order Status</th>
                    @php
                        if ($order->order_status == 1) {
                            $order->order_status = 'Pending';
                        } elseif ($order->order_status == 2) {
                            $order->order_status = 'To Pay';
                        } elseif ($order->order_status == 3) {
                            $order->order_status = 'To Ship';
                        } elseif ($order->order_status == 4) {
                            $order->order_status = 'Completed';
                        } elseif ($order->order_status == 5) {
                            $order->order_status = 'Cancelled';
                        } elseif ($order->order_status == 6) {
                            $order->order_status = 'Out for Delivery';
                        } elseif($order->order_status == 7) {
                            $order->order_status = 'On Delivery';
                        }
                    @endphp
                    <td>{{ $order->order_status }}</td>
                </tr>
                <tr>
                    <th>Payment Method</th>
                    @php
                        if($order->order_type == 1) {
                            $order->order_type = 'Cash on Delivery';
                        } else {
                            $order->order_type = 'Stripe';
                        }
                    @endphp
                    <td>{{ $order->order_type }}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>₱ {{ number_format($order->total_price, 2) }}</td>
                </tr>
            </table>

            <h4>Order Items:</h4>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->productSpecification->product->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>₱ {{ number_format($item->price, 2) }}</td>
                            <td>₱ {{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="shipping-info">
            <h3>Shipping Information</h3>
            <table>
                <tr>
                    <th>Customer Name</th>
                    <td>{{ $order->customer_name }}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>{{ $order->customer_phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $order->customer_email }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $order->customer_house_number }}, {{ $order->customer_street }},
                        {{ $order->customer_barangay }}, {{ $order->customer_city }}, {{ $order->customer_state }}
                        {{ $order->customer_zip }}, {{ $order->customer_country }}</td>
                </tr>
            </table>
        </div>

        <div class="total-price">
            <p>Total: ₱ {{ number_format($order->total_price, 2) }}</p>
        </div>

        <div class="footer">
            <p>If you have any questions or concerns, feel free to contact us at <strong>support@buyani.com</strong></p>
            <p>Thank you for shopping with Buyani!</p>
        </div>
    </div>

</body>

</html>
