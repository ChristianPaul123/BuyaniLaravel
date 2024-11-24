<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">Completed Orders</h3>
    </div>
    <div class="card-body">
        <table id="orderCompletedTable" class="table table-bordered table-striped">
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
                @foreach ($ordersCompleted as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->total_amount }}</td>
                        {{-- <td>{{ $order->created_at->format('d-m-Y') }}</td> --}}
                        <td>{{ $order->order_status }}</td>
                        <td>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
