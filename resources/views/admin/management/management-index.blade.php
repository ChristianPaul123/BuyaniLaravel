@extends('layouts.admin-app')

@section('title', 'Admin | Management')

@push('styles')
<style>
    .tab-pane {
        margin-top: 20px;
    }

    .form-control {
        margin-bottom: 10px;
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
                <h1 class="h2">User Management</h1>
            </div>
            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs" id="managementTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="consumers-tab" data-bs-toggle="tab" href="#consumers" role="tab">Consumer Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="farmers-tab" data-bs-toggle="tab" href="#farmers" role="tab">Farmer Management</a>
                </li>

            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="managementTabsContent">

                {{-- Manage User Type with 1 means Consumer Tab --}}
                <div class="tab-pane fade show active" id="consumers" role="tabpanel">
                    @include('admin.management.tabs.user-consumer', ['users' => $consumers])
                </div>

                {{-- Manage User type with 2 means Farmers Tab --}}
                <div class="tab-pane fade" id="farmers" role="tabpanel">
                    @include('admin.management.tabs.user-farmer', ['users' => $farmers])
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

<script>
    // Handle modal dynamic content
    $('#confirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var action = button.data('action'); // Extract info from data-* attributes
        var type = button.data('type');

        var modalTitle = action === 'activate' ? 'Confirm ' + type + ' Activation' : 'Confirm ' + type + '  Deactivation';
        var modalBody = action === 'activate' ? 'Are you sure you want to activate this '+type.charAt(0).toLowerCase() + type.slice(1)+'?' : 'Are you sure you want to deactivate this '+type.charAt(0).toLowerCase() + type.slice(1)+'?';
        var formId = action === 'activate' ? '#activate'+type+'Form' : '#deactivate'+ type+'Form';
        
        
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
