<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">To Standby Orders</h3>
    </div>
    <div class="card-body">
        <table id="ordershipTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>User</th>
                        <th>Total Amount</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Order Type</th>
                        <th>Customer Details</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordersToShip as $order)
                    <tr>
                        {{-- ORDER NUMBER --}}
                        <td>{{ $order->order_number }}</td>

                        {{-- USER --}}
                        <td>
                            <strong>Username:</strong>   {{ $order->user->username ?? 'Guest' }}<br>
                            <strong>First Name:</strong> {{ $order->user->first_name ?? 'Guest'}}<br>
                            <strong>Last Name:</strong> {{ $order->user->last_name ?? 'Guest'}}<br>
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
                            <strong>Order Type:</strong>   {{ $order->order_type == 1 ? 'Delivery' : 'Pickup' }} <br>
                            <strong>Payment Method:</strong> {{ $order->payment->payment_method ?? 'None' }} <br>
                            <strong>Payment Status:</strong> {{ $order->payment->payment_status ?? 'Pending' }}

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

                        {{-- ACTIONS --}}
                        <td>
                            {{-- View Order --}}
                            <a href="{{ route('admin.orders.view', $order->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i> View Order
                            </a>

                            {{-- Assign employee --}}
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#assignEmployeeModal">
                                <i class="fa fa-eye"></i> Assign Employee
                            </button>
                            {{-- <a href="{{ route('admin.orders.view', $order->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>Ass
                            </a> --}}

                            <a href="{{ route('admin.orders.reject', $order->id) }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-eye"></i> Decline Order
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>

<div class="modal fade" id="assignEmployeeModal" tabindex="-1" aria-labelledby="assignEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignEmployeeModalLabel">Assign Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="assignEmployeeForm" method="POST" action="{{ route('admin.orders.ship') }}">
                    {{-- {{ route('employee.assign') }} --}}
                    @csrf
                    <div class="mb-3">
                        <label for="employeeName" class="form-label">Employee Name</label>
                        <input type="text" class="form-control" id="employeeName" name="employee_name" required>
                        <input type="hidden" name="order_id" value="{{ $order->id ?? null }}">
                    </div>
                </form>
                {{-- Add note that by confirming, it will change to out for delivery status --}}
                <p>By assigning an employee, the order will be marked as <strong>Out for Delivery</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="assignEmployeeForm" class="btn btn-primary">Confirm</button>
            </div>
        </div>
    </div>
</div>
