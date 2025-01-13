@extends('layouts.admin-app')

@section('title', 'Admin | Edit Blog')

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
        @include('admin.includes.sidebar')
<section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 overflow-y-scroll main-section">
<div class="container-fluid">
    <div class="container mt-4">
                {{-- Header Section --}}
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Blog</h1>
                </div>

                {{-- Back Button --}}
                <button type="button" class="btn btn-primary btn-back" onclick="window.history.back()"><i class="bi bi-arrow-left-circle"> </i> Back to previous</button>

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

                {{-- Edit Blog Form --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Blog: {{ $blog->blog_title }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Blog Title --}}
                            <div class="form-group">
                                <label for="blog_title">Blog Title</label>
                                <input type="text" class="form-control" id="blog_title" name="blog_title"
                                    value="{{ $blog->blog_title }}" required>
                            </div>

                            {{-- Blog Details --}}
                            <div class="form-group my-3">
                                <label for="blog_info">Blog Details</label>
                                <textarea class="form-control" style="resize: none;" id="blog_info" name="blog_info" rows="2">{{ $blog->blog_info }}</textarea>
                            </div>

                            {{-- Current Blog Image --}}
                            <div class="mb-3 d-flex flex-column">
                                <label for="blog_image_showcase">Current Blog Image</label>
                                <img id="blog_image_showcase" src="{{ asset($blog->blog_pic) }}" alt="Blog Image" class="img-thumbnail" width="400px" height="400px">
                            </div>

                            {{-- Upload New Image --}}
                            <div class="form-group my-3">
                                <label for="blog_pic">Upload New Image</label>
                                <input type="file" class="form-control" id="blog_pic" name="blog_pic">
                            </div>

                            {{-- Submit Button --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Update Blog</button>
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

