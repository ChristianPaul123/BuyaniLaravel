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

        .main-height {
            min-height: 30rem;
        }
    </style>
</style>
@endpush
@section('content')
    @include('user.includes.navbar-consumer')
    <section class="main-height">
    <div class="container my-5">
        <!-- Tab Navigation -->
        <ul class="nav nav-tabs" id="ConsumerTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                    Consumer Profile
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">
                    Shipping Address
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-4" id="ConsumerTabsContent">
            <!-- Consumer Profile Tab -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <livewire:consumer-profile />
            </div>

            <!-- Consumer Address Tab -->
            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                <livewire:consumer-address />
            </div>

        </div>
    </div>
    </section>
@endsection
@section('scripts')
@endsection
