@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Order') {{-- Set the page title --}}

@push('styles')
<style>
    .about-section {
        padding: 60px 0;
        color: white;
    }
    .team-member {
        margin-bottom: 30px;
    }
</style>
@endpush

@section('content')
     <div class="container-fluid">
        <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Order</h1>
            </div>

        <!--Add the more part here
        EX: just add a div
        -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Orders</h1>
        </div>
        </section>
        </div>
    </div>
@endsection
