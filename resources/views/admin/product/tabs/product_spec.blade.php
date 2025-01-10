<div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addSpecModal">
        Add Specification
    </button>
</div>

<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">All Product Specifications</h3>
    </div>
    <div class="card-body">
        <table id="productSpecificationTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Specification Name</th>
                    <th>Price</th>
                    <th>Weight</th>
                    <th>Product</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productSpecifications as $specification)
                @php
                $encryptedId = Crypt::encrypt($specification->id);
                @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $specification->specification_name }}</td>
                        <td>{{ $specification->product_price }}</td>
                        <td>{{ $specification->product_kg }} kg</td>
                        <td>{{ $specification->product->product_name ?? 'N/A'  }}</td>
                        <td>
                            <a href="{{ route('admin.product.specification.edit', $encryptedId) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.product.specification.delete', $specification->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this specification?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Add Product Specification Modal -->
<div class="modal fade" id="addSpecModal" tabindex="-1" aria-labelledby="addProductSpecModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductSpecModalLabel">Add Product Specification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.product.specification.add') }}" method="POST">
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
                        <label for="specification_name">Specification Name</label>
                        <input type="text" class="form-control" id="specification_name" name="specification_name" required>
                    </div>
                    <div class="form-group my-3">
                        <label for="product_price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="product_price" name="product_price" required>
                    </div>
                    <div class="form-group my-3">
                        <label for="product_kg">Weight (kg)</label>
                        <input type="number" step="0.01" class="form-control" id="product_kg" name="product_kg" required>
                    </div>
                    <input type="hidden" name="admin_id" value="{{ Auth::guard('admin')->user()->id }}">
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
