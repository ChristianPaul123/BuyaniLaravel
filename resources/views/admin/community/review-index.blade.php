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
                <h1 class="h2" style="font-weight: bold;">Reviews Management</h1>
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
            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="reviewsTabsContent">

                <div class="tab-pane fade show active" id="productreviews" role="tabpanel">
                    @include('admin.community.tabs-review.product-review',['productRatings' => $productRatings])
                </div>

                <div class="tab-pane fade show" id="orderreviews" role="tabpanel">
                    @include('admin.community.tabs-review.order-review',['orderRatings' => $orderRatings])
                </div>

            </div>
        </section>
    </div>
</div>

<!-- Modal for confirmation -->
<div id="confirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Handle modal dynamic content
    $('#confirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var action = button.data('action'); // Extract info from data-* attributes
        var type = button.data('type');



        // Update modal content based on the action
        if(type === 'OrderReview'){
            var modalTitle = action === 'activate' ? 'Confirm Order Review Activation' : 'Confirm Order Review Deactivation';
            var modalBody = action === 'activate' ? 'Are you sure you want to activate this order review?' : 'Are you sure you want to deactivate this order review?';
            var formId = action === 'activate' ? '#activate'+type+'Form' : '#deactivate'+ type+'Form';
        }else if(type === 'ProductReview'){
            var modalTitle = action === 'activate' ? 'Confirm Product Review Activation' : 'Confirm Product Review Deactivation';
            var modalBody = action === 'activate' ? 'Are you sure you want to activate this product review?' : 'Are you sure you want to deactivate this product review?';
            var formId = action === 'activate' ? '#activate'+type+'Form' : '#deactivate'+ type+'Form';
        }

        // Set modal title, body and button action
        $(this).find('.modal-title').text(modalTitle);
        $(this).find('.modal-body p').text(modalBody);

        if(action === 'activate'){
            $(this).find('.modal-footer').html(`
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" id="confirmActivate">Activate</button>
            `);
        } else {
            $(this).find('.modal-footer').html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeactivate">Deactivate</button>
            `);
        }
        // Handle form submission based on the selected action
        $('#confirm' + action.charAt(0).toUpperCase() + action.slice(1)).on('click', function() {
            $(formId).submit();
        });
    });
</script>
@endsection
