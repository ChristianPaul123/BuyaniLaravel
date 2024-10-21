<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Admin | Sub Category</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1.svg') }}">
    @include('layouts.head')
    @include('admin.styles.admin_styles')

</head>
<body class="body">
@auth('admin')
    @include('admin.includes.navbar')
    {{-- @include('admin.includes.loader') --}}


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
        <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal">
                Add Subcategory
            </button>
        </div>

            <!-- Add Subcategory Modal -->
            <div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSubcategoryModalLabel">Add Subcategory</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.subcategory.add') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_category_name">SubCategory Name</label>
                                    <input type="text" class="form-control" id="sub_category_name" name="sub_category_name" required>
                                </div>

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-block my-3 px-4 btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        <div class="card overflow-scroll">
            <div class="card-header">
                <h3 class="card-title">All Subcategory</h3>
            </div>
        {{-- <div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-top"> --}}
        <div class="card-body">
            <table id="subcategoryTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Subcategory Name</th>
                        <th>Category Name</th>
                        <th>Created Date</th>
                        <th>Updated Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                    {{-- @dd($subcategories) --}}
                    <tr>
                        <td>{{ $subcategory->sub_category_name }}</td>
                        <td>{{ $subcategory->category->category_name }}</td>
                        <td>{{ $subcategory->created_at }}</td>
                        <td>{{ $subcategory->updated_at }}</td>
                        <td class="text-center d-flex justify-content-center align-items-center">
                            <a href="{{ route('admin.subcategory.edit', $subcategory->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.subcategory.delete', $subcategory->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the subcategory: {{ $subcategory->sub_category_name }}');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
           </table>
            </div>

        </section>
    </div>
    </div>

@else
            <p>not logged in</p>
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
