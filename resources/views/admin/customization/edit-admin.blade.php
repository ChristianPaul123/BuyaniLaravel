@extends('layouts.admin-app') {{-- Extend your main admin layout --}}

@section('title', 'Admin | Edit Admin') {{-- Page title --}}

@push('styles')
<style>
    .card {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        background-color: #fff;
        margin-top: 1rem;
    }
    .card-title {
        font-size: 1.25rem;
        font-weight: 500;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #80bdff;
    }
    .main-section {
        min-height: 90vh;
        max-height: 90vh;
    }
    .img-thumbnail {
        margin-top: 10px;
    }
    .btn-back {
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar') {{-- If you have a sidebar --}}

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 overflow-y-scroll main-section">
            <div class="container-fluid">
                <div class="container mt-4">

                    {{-- Header Section --}}
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h1 class="h2">Edit Admin</h1>
                    </div>

                    {{-- Back Button --}}
                    <button type="button" class="btn btn-primary btn-back" onclick="window.history.back()">
                        <i class="bi bi-arrow-left-circle"></i> Back to previous
                    </button>

                    {{-- Success / Error Messages --}}
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Edit Admin Form --}}
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Admin: {{ $admin->username }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Username --}}
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="username"
                                        name="username"
                                        value="{{ old('username', $admin->username) }}"
                                        required
                                    >
                                </div>

                                {{-- Email --}}
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $admin->email) }}"
                                        required
                                    >
                                </div>

                                {{-- Admin Type (Owner=1, Assistant=2, Employee=3) --}}
                                <div class="form-group mb-3">
                                    <label for="admin_type">Admin Type</label>
                                    <select
                                        class="form-control"
                                        id="admin_type"
                                        name="admin_type"
                                        required
                                    >
                                        <option value="1" {{ $admin->admin_type == 1 ? 'selected' : '' }}>Owner</option>
                                        <option value="2" {{ $admin->admin_type == 2 ? 'selected' : '' }}>Assistant</option>
                                        <option value="3" {{ $admin->admin_type == 3 ? 'selected' : '' }}>Employee</option>
                                    </select>
                                </div>

                                {{-- Current Profile Picture (Optional) --}}
                                @if($admin->profile_pic)
                                <div class="mb-3 d-flex flex-column">
                                    <label for="profile_pic_showcase">Current Profile Picture</label>
                                    <img
                                        id="profile_pic_showcase"
                                        src="{{ asset($admin->profile_pic) }}"
                                        alt="Profile Picture"
                                        class="img-thumbnail"
                                        width="200px"
                                        height="100px"
                                    >
                                </div>
                                @endif

                                {{-- Upload New Profile Picture (Optional) --}}
                                <div class="form-group mb-3">
                                    <label for="profile_pic">Change Profile Picture</label>
                                    <input
                                        type="file"
                                        class="form-control"
                                        id="profile_pic"
                                        name="profile_pic"
                                    >
                                </div>

                                {{-- New Password (optional) --}}
                                <div class="form-group mb-3">
                                    <label for="password">New Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="password"
                                        name="password"
                                        placeholder="Leave blank if not changing"
                                    >
                                </div>

                                {{-- Confirm New Password --}}
                                <div class="form-group mb-3">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        placeholder="Leave blank if not changing"
                                    >
                                </div>

                                {{-- Submit Button --}}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">
                                        Update Admin
                                    </button>
                                </div>
                            </form>
                        </div>{{-- card-body --}}
                    </div>{{-- card --}}
                </div>{{-- container --}}
            </div>{{-- container-fluid --}}
        </section>
    </div>{{-- row --}}
</div>{{-- container-fluid --}}
@endsection
