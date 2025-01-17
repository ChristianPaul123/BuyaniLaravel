@extends('layouts.admin-app') <!-- Extend your main layout -->

@section('title', 'Admin | Blogs') <!-- Define the title for this page -->

@push('styles')
<style>
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

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 overflow-y-scroll main-section">
                       {{-- if there is any errors --}}

            @include('admin.includes.messageBox')

       {{-- if there's errors --}}

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <h1 class="h2">Blogs</h1>
        </div>

            <!--Add the more part here
            EX: just add a div
            -->

            <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBlogModal">
                    Add Blog
                </button>
            </div>

            <div class="card overflow-x-scroll">
                <div class="card-header">
                    <h3 class="card-title">All Blogs</h3>
                </div>
                <div class="card-body">
                    <table id="blogTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Blog Title</th>
                                <th>Blog Details</th>
                                <th>Blog Image</th>
                                <th>Created Date</th>
                                <th>Removed Date</th>
                                <th>Added by</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->blog_title }}</td>
                                    <td>{{ $blog->blog_info }}</td>
                                    <td><img src="{{ asset($blog->blog_pic) }}" alt="{{ $blog->blog_title }}" width="50"></td>
                                    <td>{{ $blog->created_at->format('M d, Y h:i A') }}</td>
                                    <td>{{ $blog->removed_date ? $blog->removed_date->format('M d, Y h:i A') : 'N/A' }}</td>
                                    <td>{{ $blog->admin->username }}</td>
                                    <td>
                                        <a href="{{ route('admin.blog.edit', $blog->id) }}" title="Edit" class="btn btn-primary btn-sm w-100">
                                            <i class="fa fa-edit"> </i><span> Edit</span>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.blog.delete', $blog->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete this blog?');" title="Delete" class="btn btn-danger btn-sm w-100">
                                                    <i class="fa fa-trash"> </i><span> Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Blog Modal -->
            <div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBlogModalLabel">Add Blog</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.blog.add') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="blog_title">Blog Title</label>
                                    <input type="text" class="form-control" id="blog_title" name="blog_title" required>
                                </div>
                                <div class="form-group my-3">
                                    <label for="blog_info">Blog Details</label>
                                    <textarea class="form-control" id="blog_info" name="blog_info" rows="2" required></textarea>
                                </div>
                                <div class="form-group my-3">
                                    <label for="blog_pic">Blog Image</label>
                                    <input type="file" class="form-control" id="blog_pic" name="blog_pic">
                                </div>
                                <input type="hidden" name="admin_id" value="{{ old('admin_id', auth()->guard('admin')->user()->id) }}">
                                <button type="submit" class="btn btn-primary mt-3">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </section>

        </div>
    </div>
@endsection

@section('scripts')
@endsection
