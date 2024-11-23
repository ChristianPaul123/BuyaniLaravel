<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">To Standby Orders</h3>
    </div>
    <div class="card-body">
        <table id="orderStandbyTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Total Amount</th>
                    {{-- <th>Order Date</th> --}}
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordersToStandby as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->total_amount }}</td>
                        {{-- <td>{{ $order->created_at->format('d-m-Y') }}</td> --}}
                        <td>{{ $order->order_status }}</td>
                        <td>
                            <a href="{{ route('admin.orders.view', $order->id) }}" class="btn btn-info">View Order</a>
                            <a href="{{ route('admin.orders.cancel', $order->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel Order</a>
                            {{-- <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('POST')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel Order</button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
