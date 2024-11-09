@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Category') {{-- Set the page title --}}

@push('styles')
<style>
.main-section {
        max-height: 35rem;
    }
</style>
@endpush

@section('content')
     <div class="container-fluid">
        <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            @session('message')
            <div class=" mx-3 my-2 px-3 py-2 alert alert-success">
                <button type="button" class="close  btn btn-success" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('message') }}
            </div>
           @endsession
           {{-- if there's errors --}}
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
            @livewire('product-category')
            </section>
        </div>
    </div>
@endsection


