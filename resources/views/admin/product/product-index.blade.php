@extends('layouts.admin-app') <!-- Extend your main layout -->

@section('title', 'Admin | Product Management')

@push('styles')
<style>
.main-section {
    max-height: 33rem;
}
.tab-pane {
    margin-top: 20px;
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            {{-- Session Messages --}}
            @if (session('message'))
                <div class="alert alert-success mx-3 my-2 px-3 py-2">
                    <button type="button" class="close btn btn-success" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('message') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger mx-3 my-2 px-3 py-2">
                    <button type="button" class="close btn btn-danger" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <h1 class="h2">Product Management</h1>
            </div>

            <!-- Tabs for navigation -->
            <ul class="nav nav-tabs" id="managementTabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link" id="categories-tab" data-bs-toggle="tab" href="#categories" role="tab">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="subcategories-tab" data-bs-toggle="tab" href="#subcategories" role="tab">Subcategories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="products-tab" data-bs-toggle="tab" href="#products" role="tab">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="specifications-tab" data-bs-toggle="tab" href="#specifications" role="tab">Product Specifications</a>
                </li>
            </ul>

            <!-- Tab Contents -->
            <div class="tab-content mt-4" id="managementTabsContent">

                <!-- Categories Tab -->
                <div class="tab-pane fade" id="categories" role="tabpanel">
                    @include('admin.product.tabs.category')
                </div>

                <!-- Subcategories Tab -->
                <div class="tab-pane fade" id="subcategories" role="tabpanel">
                    @include('admin.product.tabs.subcategory')
                </div>

                <!-- Products Tab -->
                <div class="tab-pane fade show active" id="products" role="tabpanel">
                    @include('admin.product.tabs.products')
                </div>

                <!-- Product Specifications Tab -->
                <div class="tab-pane fade" id="specifications" role="tabpanel">
                    @include('admin.product.tabs.product_spec')
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.addEventListener('popstate', function(event) {
        // If the user presses the back button, log them out
        window.location.href = "{{ route('admin.logout') }}";
    });
  </script>
@endpush
