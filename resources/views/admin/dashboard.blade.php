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
                        @livewire('blocks.admin-pending-payments')
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
                        </div>
                        <div class="col-md-4 col-sm-12">
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
                        </div>
                        <div class="col-md-4 col-sm-12">
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
                        </div>
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
                            <label class="chart-label">Top Sales Products Specifications</label>
                            <div class="chart">
                                <canvas id="barChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-container" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 7px; margin-bottom: 100px;">
                    <label class="chart-label">Total</label>
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
    // Data for the charts
    const data1 = {
        labels: ['A', 'B', 'C', 'D'],
        datasets: [{
            label: 'Chart 1 Values',
            data: [10, 25, 15, 30],
            backgroundColor: ['blue', 'green', 'orange', 'red'],
            borderColor: ['darkblue', 'darkgreen', 'darkorange', 'darkred'],
            borderWidth: 1
        }]
    };

    const data2 = {
        labels: ['X', 'Y', 'Z', 'W'],
        datasets: [{
            label: 'Chart 2 Values',
            data: [20, 40, 25, 35],
            backgroundColor: ['purple', 'cyan', 'yellow', 'pink'],
            borderColor: ['darkpurple', 'darkcyan', 'darkyellow', 'darkpink'],
            borderWidth: 1
        }]
    };

    const data3 = {
        labels: ['P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y'],
        datasets: [{
            label: 'Chart 3 Values',
            data: [30, 15, 45, 20, 25, 40, 35, 10, 50, 30],
            backgroundColor: ['brown', 'teal', 'grey', 'violet', 'cyan', 'magenta', 'yellow', 'lime', 'purple', 'red'],
            borderColor: ['darkbrown', 'darkteal', 'darkgrey', 'darkviolet', 'darkcyan', 'darkmagenta', 'darkyellow', 'darklime', 'darkpurple', 'darkred'],
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
    new Chart(document.getElementById('barChart1').getContext('2d'), {...config, data: data1});
    new Chart(document.getElementById('barChart2').getContext('2d'), {...config, data: data2});


    // Configuration for the line chart (change 'type' to 'line')
    const lineChartConfig = {
            type: 'line',
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Rendering the line chart
        new Chart(document.getElementById('barChart3').getContext('2d'), {...lineChartConfig, data: data3});
</script>

@endsection
