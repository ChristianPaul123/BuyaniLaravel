<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}


    <title>Admin | Inventory</title>
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
            <h1 class="h2">Inventory</h1>
        </div>

            <!--Add the more part here
            EX: just add a div
            -->
            <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addInventoryModal">
                    Add Stocks
                </button>
            </div>
            <!--Add Modal Frame -->
            <div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addInventoryModalLabel">Add Stocks</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.product.inventory.add') }}" method="POST" enctype="multipart/form-data">
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

                                <div class="form-group my-3">
                                    <label for="product_new_stock">New Stock</label>
                                    <input type="number" class="form-control" id="product_new_stock" name="product_new_stock" value="0" step="0.01" min="0" required>
                                </div>

                                <div class="form-group my-3">
                                    <label for="product_damage_stock">Damage Stock</label>
                                    <input type="number" class="form-control" id="product_damage_stock" name="product_damage_stock" value="0" step="0.01" min="0" required>
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
                    <h3 class="card-title">All Products</h3>
                </div>

                <div class="card-body">
                    @if(auth()->guard('admin')->user()->admin_type == 1)
                    <table id="productTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product New Stocks</th>
                                <th>Product Old Stocks</th>
                                <th>Product Sold Stocks</th>
                                <th>Product Damage Stocks</th>
                                <th>Product Total Stocks</th>
                                <th>Added Date</th>
                                <th>Updated Date</th>
                                <th>Edit Stocks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $inventory)
                                <tr>
                                    <td>{{ $inventory->product->product_name }}</td>
                                    <td>{{ $inventory->product_new_stock }}</td>
                                    <td>{{ $inventory->product_old_stock }}</td>
                                    <td>{{ $inventory->product_sold_stock }}</td>
                                    <td>{{ $inventory->product_damage_stock }}</td>
                                    <td>{{ $inventory->product_total_stock }}</td>
                                    <td>{{ $inventory->created_at }}</td>
                                    <td>{{ $inventory->updated_at }}</td>

                                    <td class="text-center d-flex justify-content-center align-items-center">
                                        <a href="{{ route('admin.product.inventory.edit', $inventory->id) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                    {{-- <td>
                                        <form action="{{ route('admin.product.delete', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the product: {{ $product->product_name }}?');">Delete</button>
                                        </form>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
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
                window.addEventListener('popstate', function(event) {
                    // If the user presses the back button, log them out
                    window.location.href = "{{ route('admin.logout') }}";
                });

            </script>

</body>
</html>
