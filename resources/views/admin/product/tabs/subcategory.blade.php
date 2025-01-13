<div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSubCategoryModal">
        Add Subcategory
    </button>
</div>

<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">All Subcategories</h3>
    </div>
    <div class="card-body">
        <table id="subcategoryTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subcategory Name</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Deactivated Date</th>
                    <th>Deactivated Status</th>
                    <th>Edit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $subcategory)
                    @php
                        $encryptedId = Crypt::encrypt($subcategory->id);
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subcategory->sub_category_name ?? 'N/A' }}</td>
                        <td>{{ $subcategory->category->category_name ?? 'N/A' }}</td>
                        <td>{{ $subcategory->created_at }}</td>
                        <td>{{ $subcategory->updated_at }}</td>
                        <td>{{ $subcategory->deactivated_date }}</td>
                        <td>{{ $subcategory->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>
                        <td>
                            <a href="{{ route('admin.subcategory.edit', $encryptedId) }}"
                                class="btn btn-primary"><i class="fa fa-edit fa-sm me-2"></i>Edit</a>
                        </td>
                        <td>
                            @if ($subcategory->deactivated_status)
                                <form id="activateSubcategoryForm"
                                    action="{{ route('admin.subcategory.activate', $subcategory->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button id="activateSubcategoryModal" type="button" title="Activate" class="btn btn-success text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="activate" data-type="Subcategory">
                                        <i class="fa fa-power-off fa-sm me-2"></i>Activate
                                    </button>

                                </form>
                            @else
                                <form id="deactivateSubcategoryForm" action="{{ route('admin.subcategory.deactivate', $subcategory->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    <button id="deactivateSubcategoryModal" type="button" title="Deactivate" class="btn btn-danger text-white w-100" data-bs-toggle="modal" data-bs-target="#confirmModal" data-action="deactivate" data-type="Subcategory">
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

<!-- Add Subcategory Modal -->
<div class="modal fade" id="addSubCategoryModal" tabindex="-1" aria-labelledby="addSubCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubCategoryModalLabel">Add Subcategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.subcategory.add') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="sub_category_name">Subcategory Name</label>
                        <input type="text" class="form-control" id="sub_category_name" name="sub_category_name"
                            required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="category_id">Parent Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="chart-contaner mt-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 7px;">
    <div class="bar-chart">
        <label class="chart-label text-center d-block">Sub Categories</label>
        <div class="chart">
            <canvas id="sub_category_bar"></canvas>
        </div>
    </div>
</div>
