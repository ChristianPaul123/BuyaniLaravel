@extends('layouts.app') {{-- Extend the main parent layout --}}

@section('title', 'Privacy Policy') {{-- Set the page title --}}

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

<!-- Privacy Policy Section -->
<section class="min-height">
    <div class="container">
        <h1 class="text-center mb-4">Privacy Policy</h1>
        <div class="card">
            <div class="card-body">
                <h3>Data Collection</h3>
                <p>Buyani collects business and personal information needed to process orders, such as contact information and delivery addresses. Collected information is used solely for order processing, delivery, and customer service purposes. We may also use information to improve our services.</p>

                <p>Information is shared with delivery partners and payment processors as needed to fulfill orders and ensure accurate invoicing.</p>

                <h3>Security Measures</h3>
                <p>We implement standard security practices to protect customer data but cannot guarantee absolute security.</p>

                <h3>Customer Rights</h3>
                <p>Customers have the right to correct or request deletion of their data by contacting Buyani at <a href="mailto:buyani@gmail.com">buyani@gmail.com</a>.</p>

                <h3>Contact Us</h3>
                <p>For any inquiries, please contact us:</p>
                <ul>
                    <li>Email: <a href="mailto:buyani@gmail.com">buyani@gmail.com</a></li>
                    <li>Phone: 09282591638</li>
                    <li>Business Address: Bagtang, Daraga, Albay</li>
                </ul>

                <p><strong>Date of Last Revision:</strong> November 14, 2024</p>
            </div>
        </div>
    </div>
</section>
@endsection
