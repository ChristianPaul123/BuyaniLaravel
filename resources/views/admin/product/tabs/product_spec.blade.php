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
                    <th>Deactivated Date</th>
                    <th>Deactivated Status</th>
                    <th>Edit</th>
                    <th>Action</th>
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
                        <td>{{ $specification->deactivated_date }}</td>
                        <td>{{ $specification->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>
                        <td>
                            <a href="{{ route('admin.product.specification.edit', $encryptedId) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            @if ($specification->deactivated_status)
                                <form id="activateProductSpecificationForm" action="{{ route('admin.product.specification.activate', $specification->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button id="activateProductSpecificationModal" type="button" title="Activate" class="btn btn-success text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="activate" data-type="ProductSpecification">
                                        <i class="fa fa-power-off fa-sm me-2"></i>Activate
                                    </button>
                                </form>
                            @else
                                <form id="deactivateProductSpecificationForm" action="{{ route('admin.product.specification.deactivate', $specification->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button id="deactivateProductSpecificationModal" type="button" title="Deactivate" class="btn btn-danger text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="deactivate" data-type="ProductSpecification">
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

<div class="chart-contaner mt-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 7px;">
    <div class="bar-chart">
        <label class="chart-label text-center d-block">Product Specifications</label>
        <div class="chart">
            <canvas id="product_specification_bar"></canvas>
        </div>
    </div>
</div>
