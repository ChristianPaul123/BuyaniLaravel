<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}


    <title>Admin | Product</title>
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
            <h1 class="h2">Product</h1>
        </div>

            <!--Add the more part here
            EX: just add a div
            -->
            <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    Add Product
                </button>
            </div>
            <!--Add Modal Frame -->
            <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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
                    <table id="productTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Details</th>
                                <th>Product Status</th>
                                <th>Product Image</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Deactivated Date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_details }}</td>
                                    <td>{{ $product->status_label }}</td>
                                    <td><img src="{{ asset( "$product->product_pic" ) }}" alt="{{ $product->product_name }}" width="50"></td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>{{ $product->subcategory->sub_category_name }}</td>
                                    <td>{{ $product->product_deactivated }}</td>
                                    <td class="text-center d-flex justify-content-center align-items-center">
                                        {{-- didn't work properly --}}
                                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal" data-product-id="{{ $product->id }}" data-product-name="{{ $product->product_name }}" data-product-details="{{ $product->product_details }}" data-product-status="{{ $product->product_status }}" data-category-id="{{ $product->category_id }}" data-subcategory-id="{{ $product->subcategory_id }}">
                                            Edit product
                                        </button> --}}
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

 <!--Edit Modal Frame Not working properly-->
            {{-- <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editProductForm" action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" value="" required>
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
                                    <label for="product_status">Product Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_status" id="product_status_available" value="1">
                                        <label class="form-check-label" for="product_status_available">
                                            Available
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_status" id="product_status_unavailable" value="0">
                                        <label class="form-check-label" for="product_status_unavailable">
                                            Out of Stock
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="product_status" id="product_status_unavailable" value="2">
                                        <label class="form-check-label" for="product_status_unavailable">
                                            Unavailable
                                        </label>
                                    </div>
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

                                <div class="form-group">
                                    <label for="subcategory_id">SubCategory</label>
                                    <select class="form-control" id="subcategory_id" name="subcategory_id" required>
                                        <option value="">Select SubCategory</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-block my-3 px-4 btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> --}}


            {{-- //     $(document).ready(function() {
                //         // Set up the CSRF token for all AJAX requests
                //         $.ajaxSetup({
                //             headers: {
                //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //             }
                //         });

                //         $('#editProductModal').on('show.bs.modal', function(event) {
                //             var button = $(event.relatedTarget);
                //             var productId = button.data('product-id');
                //             var productName = button.data('product-name');
                //             var productDetails = button.data('product-details');
                //             var productStatus = button.data('product-status');
                //             var categoryId = button.data('category-id');
                //             var subcategoryId = button.data('subcategory-id');

                //             var modal = $(this);
                //             modal.find('#product_name').val(productName);
                //             modal.find('#product_details').val(productDetails);
                //             modal.find('#category_id').val(categoryId);
                //             modal.find('#subcategory_id').val(subcategoryId);
                //             modal.find('#editProductForm').attr('action', '{{ route('admin.product.update.ajax', $product->id) }}');

                //             // Set the product status radio button
                //             modal.find('input[name="product_status"][value="' + productStatus + '"]').prop('checked', true);
                //         });

                //         $('#editProductForm').submit(function(e) {
                //             e.preventDefault();
                //             var formData = new FormData(this);
                //             $.ajax({
                //                 url: $(this).attr('action'),
                //                 type: 'PUT',
                //                 data: formData,
                //                 processData: false,
                //                 contentType: false,
                //                 success: function(response) {
                //                     // On success, insert the success message
                //                     var successAlert = `
                //                         <div class=" mx-3 my-2 px-3 py-2 alert alert-success">
                //                             <button type="button" class="close  btn btn-success" data-dismiss="alert" aria-label="Close">
                //                                 <span aria-hidden="true">&times;</span>
                //                             </button>
                //                             ${response.message}
                //                         </div>
                //                     `;
                //                     // Append the success message to your alert section
                //                     $('#alerts').append(successAlert);

                //                     // Optionally close modal or reset form
                //                     $('#editProductModal').modal('hide');
                //                 },
                //                 error: function(xhr, status, error) {
                //                     if (xhr.status == 422) {
                //                         // Handle validation errors
                //                         var errors = xhr.responseJSON.errors;
                //                         // Display errors in the modal or elsewhere
                //                         alert('Validation errors: ' + JSON.stringify(errors));
                //                     } else {
                //                         // Handle other errors
                //                         alert('An error occurred: ' + error);
                //                     }
                //                 }
                //             });
                //         });
                //     });
                //  --}}
