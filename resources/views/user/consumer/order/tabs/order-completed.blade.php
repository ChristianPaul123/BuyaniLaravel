<div class="container mt-4 tab-height">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Total Amount</th>
                    <th>Overall Weight (KG)</th>
                    <th>Total Price</th>
                    <th>Order Status</th>
                    <th>View Order Information</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordersCompleted as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td>{{ $order->overall_orderKG }} KG</td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <span class="badge status-completed text-dark">
                                {{ $order->getStatusLabelAttribute() }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No orders to standby</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
