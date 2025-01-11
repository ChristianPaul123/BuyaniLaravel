@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Edit Category') {{-- Set the page title --}}

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
    .btn-back {
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('admin.includes.sidebar')
        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 overflow-y-scroll main-section">
                <div class="container-fluid">
                    <div class="container mt-4">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            <h1 class="h2">Edit Category</h1>
                        </div>

                        {{-- Back Button --}}
                        <button type="button" class="btn btn-primary btn-back" onclick="window.history.back()"><i class="bi bi-arrow-left-circle"> </i>Back to previous</button>

                        {{-- Error Messages --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- Edit Category Form --}}
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Category</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Update Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
@endsection

