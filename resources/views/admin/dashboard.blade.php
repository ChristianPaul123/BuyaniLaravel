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
    *{
        border: 1px solid black;
    }
</style>
@endpush

@section('content')
     <div class="container-fluid">
        <div class="row">
        @include('admin.includes.sidebar')
            <section role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4 min-height">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                <div class="row">
                    <div class="col-3">
                        @livewire('blocks.total-users')
                    </div>
                    <div class="col-3">
                        @livewire('blocks.total-orders')
                    </div>
                    <div class="col-3">
                        @livewire('blocks.admin-pending-payments')
                    </div>
                    <div class="col-3">
                        @livewire('blocks.active-farmers')
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col">

                    </div>
                </div>
                <div class="row">

                </div>
            </section>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
