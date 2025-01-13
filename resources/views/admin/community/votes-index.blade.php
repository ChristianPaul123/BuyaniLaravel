@extends('layouts.admin-app')

@section('title', 'Admin | Votes')

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
            @include('admin.includes.messageBox')
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2" style="font-weight: bold;">Voted Product Management</h1>
            </div>
            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs" id="votedProductsTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="managevotes-tab" data-bs-toggle="tab" data-bs-target="#managevotes" href="#managevotes" role="tab">Manage-Voted Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="currentvotes-tab" data-bs-toggle="tab" data-bs-target="#currentvotes" href="#currentvotes" role="tab">Current-Voted Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pastvotes-tab" data-bs-toggle="tab" data-bs-target="#pastvotes" href="#pastvotes" role="tab">Past-Voted Products</a>
                </li>
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="votedProductsTabsContent">

                <div class="tab-pane fade show active" id="managevotes" role="tabpanel">
                    @include('admin.community.tabs-votes.manage-suggestions',['pendingproductSuggestions' => $pendingproductSuggestions])
                </div>

                <div class="tab-pane fade show" id="currentvotes" role="tabpanel">
                    @include('admin.community.tabs-votes.current-votes',['productSuggestions' => $productSuggestions])
                </div>


                <div class="tab-pane fade" id="pastvotes" role="tabpanel">
                    @include('admin.community.tabs-votes.past-votes',['productSuggestionRecord' => $productSuggestionRecord])
                </div>

            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
@endsection
