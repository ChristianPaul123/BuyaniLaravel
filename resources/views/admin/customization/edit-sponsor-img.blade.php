@extends('layouts.admin-app') {{-- Extend the main parent layout --}}

@section('title', 'Admin | Edit Sponsor Image') {{-- Set the page title --}}

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
        max-height: 35rem;
        overflow-y: auto;
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
        @include('admin.includes.sidebar') {{-- Include the sidebar --}}

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 main-section">
            <div class="container-fluid">
                {{-- Header Section --}}
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Edit Sponsor Image</h1>
                </div>

                {{-- Back Button --}}
                <button type="button" class="btn btn-primary btn-back" onclick="window.history.back()">&#9754; Back to previous</button>

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

                {{-- Edit Sponsor Image Form --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Sponsor Image: {{ $sponsorImg->img_title }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.customization.sponsor.update', $sponsorImg->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            {{-- Image Title --}}
                            <div class="form-group">
                                <label for="img_title">Image Title</label>
                                <input type="text" class="form-control" id="img_title" name="img_title" value="{{ $sponsorImg->img_title }}" required>
                            </div>

                            {{-- Current Sponsor Image --}}
                            <div class="mb-3 d-flex flex-column">
                                <label for="sponsor_image_showcase">Current Sponsor Image</label>
                                <img id="sponsor_image_showcase" src="{{ asset($sponsorImg->img) }}" alt="Sponsor Image" class="img-thumbnail" width="200px" height="100px">
                            </div>

                            {{-- Upload New Image --}}
                            <div class="form-group my-3">
                                <label for="img">Upload New Image</label>
                                <input type="file" class="form-control" id="img" name="img" accept="image/*">
                            </div>

                            {{-- Submit Button --}}
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Update Sponsor Image</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
