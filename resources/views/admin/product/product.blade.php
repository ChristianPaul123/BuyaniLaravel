<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Admin | Product</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo1.svg') }}">
    @include('layouts.head')
    @include('admin.styles.admin_styles')

</head>
<body class="body">
@auth('admin')
    @include('admin.includes.navbar')


     <div class="container-fluid">
        <div class="row">


        @include('admin.includes.sidebar')

        <section class="col-md-9 ml-sm-auto col-lg-10 px-4">
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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Product</h1>
        </div>

            <!--Add the more part here
            EX: just add a div
            -->

            <div class="card my-3">
                <div class="card-header">
                    <h3 class="card-title">Add Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                                </div>

                                <div class="form-group my-3">
                                    <label for="product_details">Product Details</label>
                                    <textarea class="form-control" style="resize: none;" id="product_details" name="product_details" rows="2" required></textarea>
                                </div>

                                <div class="form-group my-3">
                                    <label for="product_pic">Product Image</label>
                                    <input type="file" class="form-control" id="product_pic" name="product_pic">
                                </div>


                                <div class="form-group my-3">
                                    <label for="category_id">Category</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Remember this is not sub_category_id but subcategory_Id --}}
                                <div class="form-group">
                                    <label for="subcategory_id">SubCategory</label>
                                    <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                                        <option value="">Select SubCategory</option>
                                        @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" class="form-control" id="product_status" name="product_status" value="1" required>

                        <div class="d-flex ">
                            <button type="submit" class="btn btn-block my-3 px-4" style="background-color: #06ff02;">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card overflow-scroll">
                <div class="card-header">
                    <h3 class="card-title">All Products</h3>
                </div>
            {{-- <div class=" justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom border-top"> --}}
            <div class="card-body">
                <table id="productTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Details</th>
                            <th>Product Status</th>
                            <th>Product Image</th>
                            <th>Category Name</th>
                            <th>Sub Category Name</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th>Deactivated Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        {{-- @dd($subcategories) --}}
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_details }}</td>
                            <td>{{ $product->product_status }}</td>
                            <td><img src="{{ asset( "$product->product_pic" ) }}" alt="{{ $product->product_name }}" width="50"></td>
                            <td>{{ $product->category->category_name }}</td>
                            <td>{{ $product->subcategory->sub_category_name }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td>{{ $product->product_deactivated }}</td>
                            <td class="text-center d-flex justify-content-center align-items-center">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the product: {{ $product->product_name }}?');">Delete</button>
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
