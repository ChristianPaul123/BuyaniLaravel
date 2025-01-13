<div class="container mt-4 tab-height">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th class="d-none d-lg-table-cell">Total Quantity</th>
                    <th class="d-none d-lg-table-cell">Overall Weight (KG)</th>
                    <th class="d-none d-lg-table-cell">Total Price</th>
                    <th class="d-none d-lg-table-cell">Order Status</th>
                    <th class="d-none d-lg-table-cell">Customer Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordersCompleted as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td class="d-none d-lg-table-cell">{{ number_format($order->total_amount) }}</td>
                        <td class="d-none d-lg-table-cell">{{ $order->overall_orderKG }} KG</td>
                        <td class="d-none d-lg-table-cell">₱{{ number_format($order->total_price, 2) }}</td>
                        <td class="d-none d-lg-table-cell">
                            <span class="badge status-completed">
                                {{ $order->getStatusLabelAttribute() }}
                            </span>
                        </td>
                        <td class="d-none d-lg-table-cell">{{ $order->customer_name }}</td>
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
