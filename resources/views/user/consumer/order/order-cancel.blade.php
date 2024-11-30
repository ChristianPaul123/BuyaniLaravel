@extends('layouts.app')

@section('title', 'Cancel Order')

@section('content')
<div class="container mt-4">
    <h2>Cancel Order</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5>Order Summary</h5>
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Total Weight:</strong> {{ $order->overall_orderKG }} KG</p>
            <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
        </div>
    </div>

    <form action="{{ route('user.consumer.order.cancel', $order->id) }}" method="POST">
        @csrf
        <div class="card mb-4">
            <div class="card-body">
                <h5>Reason for Cancellation</h5>
                <div class="mb-3">
                    <label for="reason" class="form-label">Reason</label>
                    <textarea class="form-control" id="reason" name="reason" rows="4" placeholder="Provide a reason for cancellation" required></textarea>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('user.consumer.order') }}" class="btn btn-secondary me-2">Back</a>
            <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
        </div>
    </form>
</div>
@endsection
