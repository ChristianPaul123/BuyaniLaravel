@extends('layouts.admin-app')

@section('title', 'Admin | Customization')

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
                <h1 class="h2" style="font-weight: bold;">Customization</h1>
            </div>
            {{-- Tabs Navigation --}}
            <ul class="nav nav-tabs" id="customizationTabs" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#settings" role="tab">Admin Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admins-tab" data-bs-toggle="tab" href="#admins" role="tab">Manage Admins</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" id="payments-tab" data-bs-toggle="tab" href="#payments" role="tab">Admin Payments</a>
                </li> --}}
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content mt-4" id="customizationTabsContent">

                {{-- Settings Tab --}}
                <div class="tab-pane fade show active" id="settings" role="tabpanel">
                    @include('admin.customization.tabs.setting-admin', ['admin' => $admin])
                </div>

                {{-- Manage Admins Tab --}}
                <div class="tab-pane fade" id="admins" role="tabpanel">
                    @include('admin.customization.tabs.manage-admin', ['admins' => $admins])
                </div>

                {{-- Admin Payments Tab --}}
                {{-- <div class="tab-pane fade" id="payments" role="tabpanel">
                    @include('admin.customization.tabs.payment-admin', ['admin' => $admin])
                </div> --}}
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
{{-- for the tab to stay where it should --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab');
        if (activeTab) {
            const tab = document.querySelector(`a[href="#${activeTab}"]`);
            if (tab) {
                const tabInstance = new bootstrap.Tab(tab);
                tabInstance.show();
            }
        }
    });
</script>

<script>
    // Handle modal dynamic content
    $('#confirmModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var action = button.data('action'); // Extract info from data-* attributes
        var type = button.data('type');

        var modalTitle = type +' Confirmation';
        var modalBody = 'Are you sure you want to ' + action + ' this ' + type.charAt(0).toLowerCase() + type.slice(1)+ '?';
        var formId = '#' + action + type + 'Form';

        // Set modal title, body and button action
        $(this).find('.modal-title').text(modalTitle);
        $(this).find('.modal-body p').text(modalBody);

        if(action === 'activate'){
            $(this).find('.modal-footer').html(`
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirm${action.charAt(0).toUpperCase() + action.slice(1)}">${action.charAt(0).toUpperCase() + action.slice(1)}</button>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const togglePasswordIcons = document.querySelectorAll(".toggle-password");

        togglePasswordIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                const targetId = this.dataset.target;            // e.g., "password" or "confirmation_password"
                const passwordField = document.getElementById(targetId);

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    });
</script>

{{-- this is the script for adding admins --}}
<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach((el) => {
        el.addEventListener('click', function(e) {
            const targetId = e.currentTarget.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (input.type === 'password') {
                input.type = 'text';
                e.currentTarget.classList.remove('fa-eye');
                e.currentTarget.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                e.currentTarget.classList.add('fa-eye');
                e.currentTarget.classList.remove('fa-eye-slash');
            }
        });
    });

    // Show the confirmation modal when user clicks "Add Admin"
    const addAdminModalEl = document.getElementById('addAdminModal');
    const confirmAddAdminModalEl = document.getElementById('confirmAddAdminModal');

    // Reference to the bootstrap modals
    const bootstrapAddAdminModal = new bootstrap.Modal(addAdminModalEl);
    const bootstrapConfirmAddAdminModal = new bootstrap.Modal(confirmAddAdminModalEl);

    document.getElementById('btnShowConfirmModal').addEventListener('click', function () {
        // Optionally do front-end validation checks here before showing confirm modal
        // ...
        // Hide the add-admin modal, show the confirmation
        bootstrapAddAdminModal.hide();
        bootstrapConfirmAddAdminModal.show();
    });

    // If user confirms "Yes", submit the form
    document.getElementById('confirmYesBtn').addEventListener('click', function () {
        document.getElementById('addAdminForm').submit();
    });
</script>

@endsection
