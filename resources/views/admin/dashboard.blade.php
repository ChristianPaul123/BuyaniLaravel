@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Dashboard') {{-- Set the page title --}}

@push('styles')
<style>
    .about-section {
        padding: 60px 0;
        color: white;
    }
    .team-member {
        margin-bottom: 30px;
    }

    .min-height {
        min-height: 100vh;
    }
</style>
<style>
    .table-head {
        background-color: #62b613;
        color: white;
        text-align: center;
    }

    table td {
        text-align: center;
        width: 1000000px;
    }
</style>
<style>
    *{
        /* border: 1px solid black; */
    }

    .chart-container {
        justify-content: space-between;
        text-align: center;
        max-height: 100vh; /* Set a max height for the scrollable container */
        overflow-y: auto; /* Enable vertical scrolling */
        padding: 20px; /* Optional: add padding for spacing */
        scrollbar-width: thin;
    }
    .chart {
        width: 100%;
    }

    .chart-label{
        font-size: 25px;
        font-weight: bold;
    }




    .text-title-container{
        text-align: center;
        font-size: 35px;
    }
    .text-title{
        font-weight: bold;
    }
    .counter{
        display: inline-block;
        font-weight: bold;
    }

    *{
        /* border: 1px solid black; */
    }

</style>
@endpush

@section('content')
     <div class="container-fluid">
        <div class="row">
        @include('admin.includes.sidebar')
            <section role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4 min-height" style="overflow-y: auto;max-height: 500px; scrollbar-width: thin;">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="font-weight: bold;">Dashboard</h1>
                </div>
                <div class="row g-1">
                    <div class="col-md-3 col-sm-12">
                        @livewire('blocks.total-users')
                    </div>
                    <div class="col-md-3 col-sm-12">
                        @livewire('blocks.total-orders')
                    </div>
                    <div class="col-md-3 col-sm-12">
                        @livewire('blocks.monthly-sales')
                    </div>
                    <div class="col-md-3 col-sm-12">
                        @livewire('blocks.active-farmers')
                    </div>
                </div>
                <div class="table-container mt-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 7px;">
                    <div class="row g-5">
                        <div class="col-md-4 col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="table-head" style="background-color: #62b613; color: #ffffff; font-weight:bold;">
                                            LATEST PRODUCT
                                        </th>
                                    </tr>
                                </thead>
                                <tbody style="display: block; max-height: 200px; overflow-y: auto; width: 100%; height: auto; scrollbar-width: thin;">
                                    @if($latestProduct)
                                    <tr>
                                        <td>{{ $latestProduct->product_name }}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>No Latest Product Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Product Specifications Older Than 1 Month Table -->
                        <div class="col-md-4 col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="table-head" style="background-color: #62b613; color: #ffffff; font-weight:bold;">
                                            PRODUCT SPECS (1+ Month Old)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody style="display: block; max-height: 200px; overflow-y: auto; width: 100%; height: auto; scrollbar-width: thin;">
                                    @forelse($olderSpecs as $spec)
                                    <tr>
                                        <td>
                                            {{ $spec->specification_name }}
                                            (Price: {{ $spec->product_price }})
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>No old specifications found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pie Chart (Total Stocks, Sold, Damaged) -->
                        <div class="col-md-4 col-sm-12">
                            <label class="mb-2" style="color: #62b613; font-size: 25px; font-weight: bold;">Monthly Stocks</label>
                            <canvas id="myPieChart"></canvas>
                        </div>


                        {{-- <div class="col-md-4 col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="table-head" style="background-color: #62b613; color: #ffffff; font-weight:bold;">PRODUCT NAME</th>
                                    </tr>
                                </thead>
                                <tbody style="display: block; max-height: 200px; overflow-y: auto; width: 100%; height: auto;scrollbar-width: thin;">
                                    <tr>
                                        <td>APPLE</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>

                <div class="chart-container my-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 7px;">
                    <div class="row g-5">
                        <div class="col-md-6">
                            <label class="chart-label">Top Sales Products</label>
                            <div class="chart">
                                <canvas id="barChart1"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="chart-label">Top Sales Product Specifications</label>
                            <div class="chart">
                                <canvas id="barChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-container" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 7px; margin-bottom: 100px;">
                    <label class="chart-label">Monthly Total Sales</label>
                    <div class="chart">
                        <canvas id="barChart3"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // These arrays come from the controller
    const productLabels = @json($productLabels);
    const productData   = @json($productData);

    const specLabels    = @json($specLabels);
    const specData      = @json($specData);

    const monthLabels   = @json($monthLabels);
    const monthData     = @json($monthData);

    // -- BAR CHART for Top Sales Products --
    const data1 = {
        labels: productLabels,
        datasets: [{
            label: 'Top Products',
            data: productData,
            backgroundColor: ['blue','green','orange','red','purple'], // or generate dynamically
            borderColor: ['darkblue','darkgreen','darkorange','darkred','darkpurple'],
            borderWidth: 1
        }]
    };

    // -- BAR CHART for Top Sales Product Specs --
    const data2 = {
        labels: specLabels,
        datasets: [{
            label: 'Top Product Specs',
            data: specData,
            backgroundColor: ['purple', 'cyan', 'yellow', 'pink', 'teal'],
            borderColor: ['#4b0082','#008b8b','#cccc00','#ffc0cb','#008080'],
            borderWidth: 1
        }]
    };

    // -- LINE CHART (or BAR) for Monthly Totals --
    const data3 = {
        labels: monthLabels,
        datasets: [{
            label: 'Monthly Total Sales',
            data: monthData,
            // For a line chart:
            backgroundColor: 'rgba(75,192,192,0.2)',
            borderColor: 'rgba(75,192,192,1)',
            fill: true,
            tension: 0.1,
            borderWidth: 2
        }]
    };

    // Configuration for the bar charts
    const configBar = {
        type: 'bar',
        options: {
            responsive: true,
            maintainAspectRatio	: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    };

    // Configuration for the line chart
    const configLine = {
        type: 'line',
        options: {
            responsive: true,
            maintainAspectRatio	: false,

            scales: {
                y: { beginAtZero: true }
            }
        }
    };

    // Render Charts
    new Chart(document.getElementById('barChart1').getContext('2d'), {...configBar, data: data1});
    new Chart(document.getElementById('barChart2').getContext('2d'), {...configBar, data: data2});
    new Chart(document.getElementById('barChart3').getContext('2d'), {...configLine, data: data3});
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('myPieChart').getContext('2d');

        const data = {
            labels: [
                'Total Stock',
                'Sold Stock',
                'Damaged Stock'
            ],
            datasets: [{
                label: 'Inventory',
                data: [
                    {{ $inventoryData->total_stocks ?? 0 }},
                    {{ $inventoryData->sold_stocks ?? 0 }},
                    {{ $inventoryData->damaged_stocks ?? 0 }},
                ],
                backgroundColor: [
                    '#42A5F5',
                    '#66BB6A',
                    '#FFCA28'
                ]
            }]
        };

        new Chart(ctx, {
            type: 'pie',
            data: data
        });
    });
</script>

@endsection
