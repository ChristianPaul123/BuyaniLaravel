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
                @forelse($ordersToShip as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ number_format($order->total_amount) }}</td>
                        <td>{{ $order->overall_orderKG }} KG</td>
                        <td>₱{{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <span class="badge status-to-ship text-white">
                                {{ $order->getStatusLabelAttribute() }}
                            </span>
                        </td>
                        <td>{{ $order->customer_name }}</td>
                        <td>
                            <a class="btn btn-primary"
                                href="{{ route('user.consumer.order.details', $order->id) }}">View</a>
                            {{-- <a class="btn btn-secondary" href="{{ route('user.consumer.order.track', $order->id)}}">Track</a> --}}
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmOrderModal = document.getElementById('confirmOrderModal');
        confirmOrderModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const orderId = button.getAttribute('data-order-id'); // Extract order ID
            const orderInput = confirmOrderModal.querySelector('#order_id');
            orderInput.value = orderId; // Set the order ID in the hidden input
        });
    });
</script>
