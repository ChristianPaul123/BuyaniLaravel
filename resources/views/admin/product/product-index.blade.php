@extends('layouts.admin-app') <!-- Extend your main layout -->

@section('title', 'Admin | Product Management')

@push('styles')
<style>
.main-section {
    min-height: 90vh;
    max-height: 90vh;
}
.tab-pane {
    margin-top: 20px;
}

*{
    /* border: 1px solid black; */
}
.chart-label{
    font-size: 25px;
    font-weight: bold;
}

</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            {{-- Session Messages --}}
            @include('admin.includes.messageBox')


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
                    <a class="nav-link" id="products-tab" data-bs-toggle="tab" href="#products" role="tab">Products</a>
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
                <div class="tab-pane fade" id="products" role="tabpanel">
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab');
        if (activeTab) {
            const tab = document.querySelector(`a[href="#${activeTab}"]`);
            if (tab) {
                const tabInstance = new bootstrap.Tab(tab);
                tabInstance.show();
            }
        }
    });
</script>
<script>
    // Data for the charts
    const category_bar = {
        labels: ['A', 'B', 'C', 'D'],
        datasets: [{
            label: 'Chart 1 Values',
            data: [10, 25, 15, 30],
            backgroundColor: ['blue', 'green', 'orange', 'red'],
            borderColor: ['darkblue', 'darkgreen', 'darkorange', 'darkred'],
            borderWidth: 1
        }]
    };

    const sub_category_bar = {
        labels: ['X', 'Y', 'Z', 'W'],
        datasets: [{
            label: 'Chart 2 Values',
            data: [20, 40, 25, 35],
            backgroundColor: ['purple', 'cyan', 'yellow', 'pink'],
            borderColor: ['darkpurple', 'darkcyan', 'darkyellow', 'darkpink'],
            borderWidth: 1
        }]
    };

    const product_bar = {
        labels: ['A', 'B', 'C', 'D'],
        datasets: [{
            label: 'Chart 1 Values',
            data: [10, 25, 15, 30],
            backgroundColor: ['blue', 'green', 'orange', 'red'],
            borderColor: ['darkblue', 'darkgreen', 'darkorange', 'darkred'],
            borderWidth: 1
        }]
    };

    const product_specification_bar = {
        labels: ['X', 'Y', 'Z', 'W'],
        datasets: [{
            label: 'Chart 2 Values',
            data: [20, 40, 25, 35],
            backgroundColor: ['purple', 'cyan', 'yellow', 'pink'],
            borderColor: ['darkpurple', 'darkcyan', 'darkyellow', 'darkpink'],
            borderWidth: 1
        }]
    };

    // Configuration for the charts
    const config = {
        type: 'bar',
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Rendering the charts
    new Chart(document.getElementById('category_bar').getContext('2d'), {...config, data: category_bar});
    new Chart(document.getElementById('sub_category_bar').getContext('2d'), {...config, data: sub_category_bar});
    new Chart(document.getElementById('product_bar').getContext('2d'), {...config, data: product_bar});
    new Chart(document.getElementById('product_specification_bar').getContext('2d'), {...config, data: product_specification_bar});
</script>

@endsection
