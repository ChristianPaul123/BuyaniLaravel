@extends('layouts.admin-app')

@section('title', 'Admin | Reviews')

@push('styles')
<style>
    .tab-pane {
        margin-top: 20px;
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

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-2 overflow-y-scroll main-section">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Reviews Management</h1>
            </div>
            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs" id="reviewsTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="productreviews-tab" data-bs-toggle="tab" data-bs-target="#productreviews" href="#productreviews" role="tab">Manage Product Reviews</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="orderreviews-tab" data-bs-toggle="tab" data-bs-target="#orderreviews" href="#orderreviews" role="tab">Manage Order Reviews</a>
                </li>

            </ul>
ddd
            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="reviewsTabsContent">

                <div class="tab-pane fade show active" id="productreviews" role="tabpanel">
                    @include('admin.community.tabs-review.product-review')
                </div>

                <div class="tab-pane fade show" id="orderreviews" role="tabpanel">
                    @include('admin.community.tabs-review.order-review')
                </div>

            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
@endsection
