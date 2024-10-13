<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Admin | Blogs</title>
    <link rel="icon" type="image/png" href="../img/logo1.svg">
    @include('layouts.head')
    @include('admin.styles.admin_styles')

</head>
<body class="body">
@auth('admin')
    @include('admin.includes.navbar')


    <div class="container-fluid">
        <div class="row">

        @include('admin.includes.sidebar')

        <section class="col-md-10 ml-sm-auto col-lg-10 px-3 py-5 overflow-y-scroll main-section">
                       {{-- if there is any errors --}}
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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <h1 class="h2">Blogs</h1>
        </div>

            <!--Add the more part here
            EX: just add a div
            -->

            <div class="card my-3">
                <div class="card-header">
                    <h3 class="card-title">Add Blog Post</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.blog.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <div class="form-group">
                                    <label for="blog_title">Blog Title</label>
                                    <input type="text" class="form-control" id="blog_title" name="blog_title" required>
                                </div>

                                <div class="form-group my-3">
                                    <label for="blog_info">Blog Details</label>
                                    <textarea class="form-control" style="resize: none;" id="blog_info" name="blog_info" rows="2" required></textarea>
                                </div>

                                <div class="form-group my-3">
                                    <label for="blog_pic">Blog Image</label>
                                    <input type="file" class="form-control" id="blog_pic" name="blog_pic">
                                </div>

                                <input type="hidden" name="admin_id" value="{{ old('admin_id', auth()->guard('admin')->user()->id) }}">


                                <div class="d-flex ">
                                    <button type="submit" class="btn btn-block my-3 px-4 btn-success">Submit</button>
                                </div>
                    </form>
                </div>
            </div>

            <div class="card overflow-scroll">
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
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->blog_title }}</td>
                            <td>{{ $blog->blog_info }}</td>
                            <td><img src="{{ asset( "$blog->blog_pic" ) }}" alt="{{ $blog->blog_title }}" width="50"></td>
                            <td>{{ $blog->created_at }}</td>
                            <td>{{ $blog->removed_date }}</td>
                            <td class="text-center d-flex justify-content-center align-items-center">
                                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.blog.delete', $blog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the blog: {{ $blog->blog_title }}?');">Delete</button>
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

@else
            <p>not logged in</p>
            @session('message')
            <div class="success-message">
                {{ session('message') }}
            </div>
            @endsession
@endauth
    @include('layouts.script')
<script>
    window.addEventListener('popstate', function(event) {
        // If the user presses the back button, log them out
        window.location.href = "{{ route('admin.logout') }}";
    });
  </script>
</body>
</html>
