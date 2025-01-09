<div class="card overflow-auto">
    <div class="card-header">
        <h3 class="card-title">Out for Delivery Orders</h3>
    </div>
    @include('admin.includes.messageBox')
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Order Number</th>
                    <th>User</th>
                    <th>Total Amount</th>
                    <th>Total Price</th>
                    <th>Order Status</th>
                    <th>Order Type</th>
                    <th>Customer Details</th>
                    <th>Delivery Person</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordersToDeliver as $order)
                    <tr>
                        {{-- ORDER NUMBER --}}
                        <td>{{ $order->order_number }}</td>

                        {{-- USER --}}
                        <td>
                            <strong>Username:</strong> {{ $order->user->username ?? 'Guest' }}<br>
                            <strong>First Name:</strong> {{ $order->user->first_name ?? 'Guest' }}<br>
                            <strong>Last Name:</strong> {{ $order->user->last_name ?? 'Guest' }}<br>
                        </td>

                        {{-- TOTAL AMOUNT --}}
                        <td>{{ number_format($order->total_amount, 2) }} KG</td>

                        {{-- TOTAL PRICE --}}
                        <td>${{ number_format($order->total_price, 2) }}</td>

                        {{-- ORDER STATUS --}}
                        <td>
                            <span class="badge 
                                @if($order->order_status == \App\Models\Order::STATUS_STANDBY) bg-secondary
                                @elseif($order->order_status == \App\Models\Order::STATUS_TO_PAY) bg-warning
                                @elseif($order->order_status == \App\Models\Order::STATUS_TO_SHIP) bg-info
                                @elseif($order->order_status == \App\Models\Order::STATUS_COMPLETED) bg-success
                                @elseif($order->order_status == \App\Models\Order::STATUS_CANCELLED) bg-danger
                                @else bg-primary @endif">
                                {{ $order->status_label }}
                            </span>
                        </td>

                        {{-- ORDER TYPE --}}
                        <td>
                            <strong>{{ $order->payment->payment_method ?? 'None' }}</strong>
                        </td>

                        {{-- CUSTOMER DETAILS --}}
                        <td>
                            <strong>Name:</strong> {{ $order->customer_name }}<br>
                            <strong>Phone:</strong> {{ $order->customer_phone }}<br>
                            <strong>Email:</strong> {{ $order->customer_email }}<br>
                            <strong>Address:</strong>
                            {{ $order->customer_street }},
                            {{ $order->customer_house_number }},
                            {{ $order->customer_city }},
                            {{ $order->customer_barangay }},
                            {{ $order->customer_state }},
                            {{ $order->customer_zip }},
                            {{ $order->customer_country }}
                        </td>
                        {{-- Delivery Person --}}
                        <td>
                            <strong>{{ $order->delivery_employee }}</strong>
                        </td>
                        <td>
                            {{-- View Order --}}
                            <a href="{{ route('admin.orders.view', $order->id) }}" class="btn btn-info btn-sm mb-2">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
