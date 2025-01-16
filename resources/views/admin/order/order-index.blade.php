@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Order') {{-- Set the page title --}}

@push('styles')
<style>
    .main-section {
    min-height: 90vh;
    max-height: 90vh;
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
           @include('admin.includes.messageBox')

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <h1 class="h2" style="font-weight: bold;">Order Management</h1>
            </div>

            <ul class="nav nav-tabs" id="orderTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="order-standby-tab" data-bs-toggle="tab" href="#order-standby" role="tab">
                        To Standby ({{ $ordersToStandby->count() }})
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" id="order-pay-tab" data-bs-toggle="tab" href="#order-pay" role="tab">
                        To Pay ({{ $ordersToPay->count() }})
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" id="order-ship-tab" data-bs-toggle="tab" href="#order-ship" role="tab">
                        To Ship ({{ $ordersToShip->count() }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-deliver-tab" data-bs-toggle="tab" href="#order-deliver" role="tab">
                        Out For Delivery ({{ $ordersToDeliver->count() }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-completed-tab" data-bs-toggle="tab" href="#order-completed" role="tab">
                        Order Completed ({{ $ordersCompleted->count() }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-cancelled-tab" data-bs-toggle="tab" href="#order-cancelled" role="tab">
                        Order Cancelled ({{ $ordersCancelled->count() }})
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-archived-tab" data-bs-toggle="tab" href="#order-archived" role="tab">
                        Archived ({{ $ordersArchived->count() }})
                    </a>
                </li>
            </ul>

            <div class="tab-content mt-4" id="orderTabsContent">
                <div class="tab-pane fade show active" id="order-standby" role="tabpanel">
                    @include('admin.order.tabs.order-standby',['ordersToStandby' => $ordersToStandby])
                </div>
                {{-- <div class="tab-pane fade" id="order-pay" role="tabpanel">
                    @include('admin.order.tabs.order-pay',['ordersToPay' => $ordersToPay])
                </div> --}}
                <div class="tab-pane fade" id="order-ship" role="tabpanel">
                    @include('admin.order.tabs.order-ship',['ordersToShip' => $ordersToShip])
                </div>
                <div class="tab-pane fade" id="order-deliver" role="tabpanel">
                    @include('admin.order.tabs.order-deliver', ['ordersToDeliver' => $ordersToDeliver])
                </div>
                <div class="tab-pane fade" id="order-completed" role="tabpanel">
                    @include('admin.order.tabs.order-completed',['ordersCompleted' => $ordersCompleted])
                </div>
                <div class="tab-pane fade" id="order-cancelled" role="tabpanel">
                    @include('admin.order.tabs.order-cancelled',['ordersCancelled' => $ordersCancelled])
                </div>
                <div class="tab-pane fade" id="order-archived" role="tabpanel">
                    @include('admin.order.tabs.order-archived',['ordersCancelled' => $ordersCancelled])
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

        // var modalTitle = action === 'activate' ? 'Confirm ' + type + ' Activation' : 'Confirm ' + type + '  Deactivation';
        // var modalBody = action === 'activate' ? 'Are you sure you want to activate this '+type.charAt(0).toLowerCase() + type.slice(1)+'?' : 'Are you sure you want to deactivate this '+type.charAt(0).toLowerCase() + type.slice(1)+'?';
        // var formId = action === 'activate' ? '#activate'+type+'Form' : '#deactivate'+ type+'Form';

        var modalTitle = type +' Confirmation';
        var modalBody = 'Are you sure you want to ' + action + ' this ' + type.charAt(0).toLowerCase() + type.slice(1)+ '?';
        var formId = '#' + action + type + 'Form';

        // Set modal title, body and button action
        $(this).find('.modal-title').text(modalTitle);
        $(this).find('.modal-body p').text(modalBody);

        if(action === 'accept'){
            $(this).find('.modal-footer').html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirm${action.charAt(0).toUpperCase() + action.slice(1)}">${action.charAt(0).toUpperCase() + action.slice(1)}</button>
            `);
        } else if(action === 'cancel'){
            $(this).find('.modal-footer').html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go back</button>
                <button type="button" class="btn btn-danger" id="confirm${action.charAt(0).toUpperCase() + action.slice(1)}">Confirm Cancel</button>
            `);
        } else {
            $(this).find('.modal-footer').html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm${action.charAt(0).toUpperCase() + action.slice(1)}">${action.charAt(0).toUpperCase() + action.slice(1)}</button>
            `);
        }
        // Handle form submission based on the selected action
        $('#confirm' + action.charAt(0).toUpperCase() + action.slice(1)).on('click', function() {
            $(formId).submit();
        });
    });
</script>
@endsection
