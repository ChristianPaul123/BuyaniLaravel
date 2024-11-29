@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Profile page') <!-- Defining a title for this view -->

@push('styles')
<style>
    .small-input {
        width: 80px; /* Adjust this value to change the width */
    }
    <style>
        .profile-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        .profile-section {
            margin-top: 20px;
        }
    </style>
</style>
@endpush
@section('content')
    @include('user.includes.navbar-farmer')

    <div class="container my-5">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="farmerTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                    Farmer Profile
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">
                    Farmer Address
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="forms-tab" data-bs-toggle="tab" data-bs-target="#forms" type="button" role="tab" aria-controls="forms" aria-selected="false">
                    Farmer Forms
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-4" id="farmerTabsContent">
            <!-- Farmer Profile Tab -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <livewire:farmer-profile />
            </div>

            <!-- Farmer Address Tab -->
            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                <livewire:farmer-address />
            </div>

            <!-- Farmer Forms Tab -->
            <div class="tab-pane fade" id="forms" role="tabpanel" aria-labelledby="forms-tab">
                <livewire:farmer-forms />
            </div>
        </div>
    </div>

@endsection
@section('scripts')
<script>
        document.addEventListener('DOMContentLoaded', function () {
        function activateSavedTab() {
            let activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                let tabElement = document.querySelector(`button[data-bs-target="${activeTab}"]`);
                if (tabElement) {
                    tabElement.click();
                }
            }
        }

        activateSavedTab();

        // Add event listener for Livewire updates
        document.addEventListener('livewire:load', activateSavedTab);
        document.addEventListener('livewire:update', activateSavedTab);

        // Save active tab on click
        const tabLinks = document.querySelectorAll('.nav-link');
        tabLinks.forEach(tabLink => {
            tabLink.addEventListener('click', function (e) {
                let targetTab = e.target.getAttribute('data-bs-target');
                localStorage.setItem('activeTab', targetTab);
            });
        });
    });
</script>
@endsection
