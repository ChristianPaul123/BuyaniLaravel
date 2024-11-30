@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Product Special') {{-- Set the page title --}}

@push('styles')
<style>
    .tab-content .card {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        background-color: #fff;
        margin-top: 1rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 500;
    }
    table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }
    table th, table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
    table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }
    .scroll-to-bottom {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }
    .scroll-to-bottom:hover {
        background-color: #0056b3;
    }

    .main-section {
    min-height: 90vh;
    max-height: 90vh;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-1 overflow-y-scroll main-section">
            <div class="container-fluid">
                <div class="container mt-4">
                    {{-- Back button --}}
                    <div class="d-flex justify-content-start flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                        <button type="button" class="btn btn-primary" onclick="window.history.back()"> &#9754; Back to previous</button>
                    </div>

                    <!-- Top Row: Customer Order Details -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Customer Order Details</h4>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="customerName">Customer Name</label>
                                            <input type="text" class="form-control" id="customerName" value="John Doe" readonly>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="customerPhone">Customer Phone</label>
                                            <input type="text" class="form-control" id="customerPhone" value="+1234567890" readonly>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="customerEmail">Customer Email</label>
                                            <input type="email" class="form-control" id="customerEmail" value="john.doe@example.com" readonly>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                                        <!-- Second Row: Address Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Address Information</h4>
                                </div>
                                <div class="card-body">
                                    <p><strong>Street:</strong> 123 Elm Street</p>
                                    <p><strong>City:</strong> Springfield</p>
                                    <p><strong>State:</strong> Illinois</p>
                                    <p><strong>Zip Code:</strong> 62704</p>
                                    <p><strong>Country:</strong> USA</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row: Payment Method -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Payment Method</h4>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="paymentMethod">Payment Method</label>
                                            <input type="text" class="form-control" id="paymentMethod" value="Cash on Delivery" readonly>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Third Row: Product and Inventory Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Product and Inventory Information</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Category</th>
                                                <th>Stock Available</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Product A</td>
                                                <td>Electronics</td>
                                                <td>20</td>
                                                <td>$50</td>
                                            </tr>
                                            <tr>
                                                <td>Product B</td>
                                                <td>Clothing</td>
                                                <td>15</td>
                                                <td>$30</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Fourth Row: Actions -->
                    <div class="row mb-4">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back()">Cancel</button>
                        </div>
                    </div>
                </div>

                <!-- Scroll-to-Bottom Button -->
                <button class="scroll-to-bottom" id="scrollToBottomBtn">
                    <i class="fas fa-arrow-down"></i>
                </button>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Scroll-to-bottom functionality
    document.getElementById('scrollToBottomBtn').addEventListener('click', function() {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: 'smooth'
        });
    });
</script>
@endsection
