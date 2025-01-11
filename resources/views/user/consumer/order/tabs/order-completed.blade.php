<div class="container mt-4 tab-height">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Total Quantity</th>
                    <th>Overall Weight (KG)</th>
                    <th>Total Price</th>
                    <th>Order Status</th>
                    <th>Customer Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordersCompleted as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ number_format($order->total_amount) }}</td>
                        <td>{{ $order->overall_orderKG }} KG</td>
                        <td>₱{{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <span class="badge status-completed">
                                {{ $order->getStatusLabelAttribute() }}
                            </span>
                        </td>
                        <td>{{ $order->customer_name }}</td>
                        <td>
                            <a class="btn btn-primary"
                                href="{{ route('user.consumer.order.details', $order->id) }}">View</a>
                            @if (!$order->rating)
                                <a class="btn btn-secondary"
                                    href="{{ route('user.consumer.order.rate', $order->id) }}">Rate Order</a>
                            {{-- @else
                                <span class="text-success">Rated</span> --}}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No orders Yet!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
