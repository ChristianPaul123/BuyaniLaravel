<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Admin | Category</title>
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



                <section role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5 overflow-scroll">

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Category</h1>
                </div>
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

                <div class="card my-3">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.add') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="category_name">Category Name</label>
                                <input type="text" class="form-control" id="category_name" name="category_name" required>
                            </div>

                            <div class="d-flex ">
                                <button type="submit" class="btn btn-block btn-success my-3 px-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card  overflow-auto">
                    <div class="card-header">
                        <h3 class="card-title">All Category</h3>
                    </div>

                <div class="card-body">
                   <!-- Table with edit and delete buttons using font awesome icons -->
                   <table id="categoryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th>Updated Date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td class="text-center d-flex justify-content-center align-items-center">
                                    <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.category.delete', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
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
