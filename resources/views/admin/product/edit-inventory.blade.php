@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Edit Inventory') {{-- Set the page title --}}

@push('styles')
<style>
    .card {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        background-color: #fff;
        margin-top: 1rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 500;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #80bdff;
    }
    .main-section {
        max-height: 35rem;
        overflow-y: auto;
    }
    .btn-back {
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar') {{-- Include the sidebar --}}

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 main-section">
            <div class="container-fluid">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Inventory</h1>
                </div>

                {{-- Back Button --}}
                <button type="button" class="btn btn-primary btn-back" onclick="window.history.back()">&#9754; Back to previous</button>

                {{-- Error Messages --}}
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Edit Inventory Form --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Inventory</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product.inventory.update', $inventory->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Product Dropdown --}}
                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select class="form-control" id="product_id" name="product_id" required>
                                    <option value="{{ $inventory->product_id }}" selected>{{ $inventory->product->product_name }}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- New Stock --}}
                            <div class="form-group my-3">
                                <label for="product_new_stock">New Stock</label>
                                <input type="number" class="form-control" id="product_new_stock" name="product_new_stock" value="{{ $inventory->product_new_stock }}" step="0.01" min="0" required>
                            </div>

                            {{-- Old Stock --}}
                            <div class="form-group my-3">
                                <label for="product_old_stock">Old Stock</label>
                                <input type="number" class="form-control" id="product_old_stock" name="product_old_stock" value="{{ $inventory->product_old_stock }}" step="0.01" min="0" required>
                            </div>

                            {{-- Damage Stock --}}
                            <div class="form-group my-3">
                                <label for="product_damage_stock">Damage Stock</label>
                                <input type="number" class="form-control" id="product_damage_stock" name="product_damage_stock" value="{{ $inventory->product_damage_stock }}" step="0.01" min="0" required>
                            </div>

                            {{-- Submit Button --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Update Inventory</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Additional JavaScript can be added here if needed.
</script>
@endpush
