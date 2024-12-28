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
                    <th>Product Details</th>
                    <th>Product Status</th>
                    <th>Product Stocks</th>
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
                @php
                $encryptedId = Crypt::encrypt($product->id);
                @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_details }}</td>
                        <td>{{ $product->status_label }}</td>
                        <th>{{ $product->inventory->product_total_stock }}</th>
                        <td><img src="{{\
                        $product->product_pic) }}" alt="{{ $product->product_name }}" width="50"></td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->subcategory->sub_category_name }}</td>
                        <td>{{ $product->product_deactivated }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit', $encryptedId) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.product.delete', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                            </form>
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
                    <input type="hidden" name="product_status" value="1">
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
