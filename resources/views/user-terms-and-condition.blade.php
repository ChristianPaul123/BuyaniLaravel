@extends('layouts.app') {{-- Extend the main parent layout --}}

@section('title', 'Terms and Conditions') {{-- Set the page title --}}

@push('styles')
<style>
    .container {
        height: auto;
        padding: 70px 20px;
        margin-top: 35px;
    }

    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .min-height {
        min-height: 100vh;
    }
</style>
@endpush

@section('x-content')
@include('user.includes.navbar-consumer') {{-- Include the navbar for users --}}

<!-- Terms and Conditions Section -->
<section class="min-height">
    <div class="container">
        <h1 class="text-center mb-4">Terms and Conditions</h1>
        <div class="card">
            <div class="card-body">
                <h3>Welcome to Buyani</h3>
                <p>Welcome to Buyani, your online source for fresh, locally sourced vegetables in Albay. By placing orders on our website, you agree to these terms. Please read carefully.</p>

                <h4>Products</h4>
                <p>All products listed on Buyani are fresh vegetables grown and harvested locally. We strive for accurate product descriptions, but product appearance may vary due to seasonal factors.</p>

                <h4>Pricing and Payment</h4>
                <p>All prices are in Philippine Peso and include applicable taxes. We accept payments via [List payment options, e.g., credit card, bank transfer, etc.]. Prices may change based on seasonal availability and market conditions.</p>

                <h4>Order Acceptance and Availability</h4>
                <p>Orders are accepted based on stock availability and delivery capacity. Bulk orders may require additional lead time. Upon confirmation, a final invoice will be provided.</p>

                <h4>Delivery Policy</h4>
                <p>We currently deliver within Albay, Philippines, covering areas accessible to hotels, markets, and businesses. Orders placed by 5 pm will be delivered within 8 am the next day. Regular deliveries may be arranged upon request. Delivery fees vary based on location and order size. Any applicable fees will be included in the final invoice.</p>

                <h4>Refunds and Cancellations</h4>
                <p>Due to the perishable nature of our products, we do not accept returns. However, if you receive items that are damaged or spoiled, please contact us within 24 hours of delivery for assistance. Cancellations can be requested within 4 hours after order confirmation. After this time, cancellation may not be possible due to harvest and preparation processes.</p>

                <h4>Client Responsibilities</h4>
                <p>Clients must provide accurate delivery information and ensure an authorized person is available to receive the order at the specified location.</p>
            </div>
        </div>
    </div>
</section>
@endsection
