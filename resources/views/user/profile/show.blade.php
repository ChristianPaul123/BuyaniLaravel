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
    @include('user.includes.navbar-consumer')
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

    <div class="container my-5 pb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                <h3 class="mt-3">{{ $user->username }}</h3>
                <img src="{{ asset("$user->profile_pic") }}" alt="Profile Picture" class="profile-pic rounded-circle" width="150px" height="auto">
                <p class="text-muted">{{ $user->email }}</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                </div>
            </div>

            <div class="col-md-8">
                <div class="profile-section">
                    <h4>Personal Information</h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item">Name: {{ $user->username }}</li>
                        <li class="list-group-item">Email: {{ $user->email }}</li>
                        <li class="list-group-item">Phone: {{ $user->phone_number }}</li>
                        <li class="list-group-item">Status: {{ $user->status }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user.consumer.profile.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameInput" name="username" value="{{ $user->username }}">
                        </div>
                        <div class="mb-3 text-center">
                            <img src="{{ $user->profile_pic }}" alt="Profile Picture" class="profile-pic-preview" width="40px" height="auto">
                        </div>
                        <div class="mb-3">
                            <label for="profilePic" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profilePic" name="profile_pic">
                        </div>
                        <div class="mb-3">
                            <label for="phoneInput" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phoneInput" name="phone_number" value="{{ $user->phone_number }}">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Change Password</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
