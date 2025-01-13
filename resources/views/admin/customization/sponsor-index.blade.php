@extends('layouts.admin-app') <!-- Extend your main layout -->

@section('title', 'Admin | Sponsor Images') <!-- Define the title for this page -->

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

    <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 overflow-y-scroll main-section">
        {{-- Display session messages --}}
        @if (session('message'))
        <div class="mx-3 my-2 px-3 py-2 alert alert-success">
            <button type="button" class="close btn btn-success" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('message') }}
        </div>
        @endif

        {{-- Display validation errors --}}
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

        {{-- Page Header --}}
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <h1 class="h2" style="font-weight: bold;">Sponsor Images</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSponsorImageModal">
                Add Sponsor Image
            </button>
        </div>

        <!-- Add Sponsor Image Modal -->
        <div class="modal fade" id="addSponsorImageModal" tabindex="-1" aria-labelledby="addSponsorImageModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSponsorImageModalLabel">Add Sponsor Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.customization.sponsor.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="img_title">Image Title</label>
                                <input type="text" class="form-control" id="img_title" name="img_title" required>
                            </div>

                            <div class="form-group my-3">
                                <label for="img">Upload Image</label>
                                <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
                            </div>

                            <div class="d-flex">
                                <button type="submit" class="btn btn-block my-3 px-4 btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sponsor Images Table -->
        <div class="card overflow-scroll">
            <div class="card-header">
                <h3 class="card-title">All Sponsor Images</h3>
            </div>

            <div class="card-body">
                <table id="sponsorImagesTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Uploaded By</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sponsorImages as $image)
                        @php
                        $encryptedId = Crypt::encrypt($image->id);
                        @endphp
                            <tr>
                                <td><img src="{{ asset($image->img) }}" alt="{{ $image->img_title }}" width="100"></td>
                                <td>{{ $image->img_title }}</td>
                                <td>{{ $image->admin->username }}</td>
                                <td>{{ $image->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.customization.sponsor.edit', $encryptedId) }}" class="btn btn-primary"><i class="fa fa-edit"> </i><span> Edit</span></a>
                                    <form action="{{ route('admin.customization.sponsor.delete', $image->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this image?')"><i class="fa fa-trash"> </i><span> Delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // DataTable Initialization
        $('#sponsorImagesTable').DataTable();
    });
</script>
@endsection
