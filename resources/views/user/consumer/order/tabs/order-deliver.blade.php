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
                    <th class="d-none d-lg-table-cell">Delivery Employee</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordersToDeliver as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td class="d-none d-lg-table-cell">{{ number_format($order->total_amount) }}</td>
                        <td class="d-none d-lg-table-cell">{{ $order->overall_orderKG }} KG</td>
                        <td class="d-none d-lg-table-cell">₱{{ number_format($order->total_price, 2) }}</td>
                        <td class="d-none d-lg-table-cell">
                            <span class="badge status-out-for-delivery text-white">
                                {{ $order->getStatusLabelAttribute() }}
                            </span>
                        </td>
                        <td class="d-none d-lg-table-cell">{{ $order->delivery_employee }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('user.consumer.order.details', $order->id)}}">View</a>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmOrderModal" data-order-id="{{ $order->id }}">Order Received</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No orders Yet!</td>
                    </tr>
                @endforelse

                <div class="modal fade" id="confirmOrderModal" tabindex="-1" aria-labelledby="confirmOrderModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmOrderModalLabel">Confirm Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to mark this order as received?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form id="confirmOrderForm" method="POST" action="{{ route('user.order.confirm') }}">
                                    @csrf
                                    <input type="hidden" name="order_id" id="order_id">
                                    <button type="submit" class="btn btn-success">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </tbody>
        </table>
    </div>
</div>
