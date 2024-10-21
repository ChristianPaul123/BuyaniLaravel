<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin | Product Specification</title>
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

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
            <h1 class="h2">Product Specification</h1>
        </div>

            <!--Add the more part here
            EX: just add a div
            -->
            <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductSpecificationModal">
                    Add Product Specification
                </button>
            </div>
            <!-- Add Product Specification Modal -->
            <div class="modal fade" id="addProductSpecificationModal" tabindex="-1" aria-labelledby="addProductSpecificationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductSpecificationModalLabel">Add Product Specification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.product.specification.add') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="product_id">Product</label>
                                    <select class="form-control" id="product_id" name="product_id" required>
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="specification_name">Specification Name</label>
                                    <input type="text" class="form-control" id="specification_name" name="specification_name" required>
                                </div>

                                <div class="form-group my-3">
                                    <label for="specific_product_info">Specific Product Info</label>
                                    <textarea class="form-control" style="resize: none;" id="specific_product_info" name="specific_product_info" rows="2" required></textarea>
                                </div>

                                <div class="form-group my-3">
                                    <label for="product_price">Product Price</label>
                                    <input type="number" class="form-control" id="product_price" name="product_price" required>
                                </div>

                                <div class="form-group my-3">
                                    <label for="product_kg">Product Weight (kg)</label>
                                    <input type="number" step="0.01" class="form-control" id="product_kg" name="product_kg" required>
                                </div>

                                <input type="hidden" class="form-control" id="admin_id" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}" required>

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
                    <h3 class="card-title">All Product Specifications</h3>
                </div>

            <div class="card-body">
                <table id="productSpecificationTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Specification Name</th>
                            <th>Specific Product Info</th>
                            <th>Product Price</th>
                            <th>Product Weight (kg)</th>
                            <th>Admin</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productSpecifications as $specification)
                        <tr>
                            <td>{{ $specification->product->product_name }}</td>
                            <td>{{ $specification->specification_name }}</td>
                            <td>{{ $specification->specific_product_info }}</td>
                            <td>{{ $specification->product_price }}</td>
                            <td>{{ $specification->product_kg }}</td>
                            <td>{{ $specification->admin->username }}</td>
                            <td class="text-center d-flex justify-content-center align-items-center">
                                <a href="{{ route('admin.product.specification.edit', $specification->id) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.product.specification.delete', $specification->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the product specification: {{ $specification->specification_name }}?');">Delete</button>
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
@endauth
@include('layouts.script')
<script>
    window.history.pushState(null, null, window.location.href);

    window.addEventListener('popstate', function(event) {
        // If the user presses the back button, log them out
        window.location.href = "{{ route('admin.logout') }}";
    });
</script>
</body>
</html>
