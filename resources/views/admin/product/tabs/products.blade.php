<div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
        Add Product
    </button>
</div>

<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">All Products</h3>
    </div>
    <div class="card-body">
        <table id="productTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    {{-- <th>Product Details</th> --}}
                    <th>Product Status</th>
                    <th>Product Stocks</th>
                    <th>Product Image</th>
                    <th>Category Name</th>
                    <th>Sub Category Name</th>
                    <th>Deactivated Date</th>
                    <th>Deactivated Status</th>
                    <th>Edit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                @php
                $encryptedId = Crypt::encrypt($product->id);
                @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_name ?? 'N/A'  }}</td>
                        {{-- <td>{{ $product->product_details ?? 'N/A' }}</td> --}}
                        <td>
                            @if ($product->inventory && $product->inventory->product_total_stock > 50)
                                <span class="text-success">In Stock</span>
                            @elseif ($product->inventory && $product->inventory->product_total_stock >= 1 && $product->inventory->product_total_stock <= 50)
                                <span class="text-warning">Low Stock</span>
                            @elseif ($product->inventory && $product->inventory->product_total_stock === 0)
                                <span class="text-danger">Out of Stock</span>
                            @else
                                <span class="text-danger">Out of Stock</span>
                            @endif
                        </td>
                        <th>{{ $product->inventory->product_total_stock ?? 'N/A' }}</th>
                        <td><img src="{{ asset($product->product_pic) }}" alt="{{ $product->product_name }}" width="50"></td>
                        <td>{{ $product->category->category_name ?? 'N/A'  }}</td>
                        <td>{{ $product->subcategory->sub_category_name ?? 'N/A' }}</td>
                        <td>{{ $product->deactivated_date }}</td>
                        <td>{{ $product->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit', $encryptedId) }}" class="btn btn-primary"><i class="fa fa-edit fa-sm me-2"></i>Edit</a>
                        </td>
                        <td>
                            @if ($product->deactivated_status)
                                <form id="activateProductForm" action="{{ route('admin.product.activate', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button id="activateProductModal" type="button" title="Activate" class="btn btn-success text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="activate" data-type="Product">
                                        <i class="fa fa-power-off fa-sm me-2"></i>Activate
                                    </button>
                                </form>
                            @else
                                <form id="deactivateProductForm" action="{{ route('admin.product.deactivate', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button id="deactivateProductModal" type="button" title="Deactivate" class="btn btn-danger text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="deactivate" data-type="Product">
                                        <i class="fa fa-power-off fa-sm me-2"></i>Deactivate
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Product Modal -->
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
                        <textarea class="form-control" id="product_details" name="product_details" rows="2" required></textarea>
                    </div>
                    <div class="form-group my-3">
                        <label for="product_pic">Product Images</label>
                        <input type="file" class="form-control" id="product_pic" name="product_pic[]" multiple>
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
                    <input type="hidden" name="product_status" value="1">
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <div class="chart-contaner mt-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 7px;">
    <div class="bar-chart">
        <label class="chart-label text-center d-block">Products</label>
        <div class="chart">
            <canvas id="product_bar"></canvas>
        </div>
    </div>
</div> --}}
