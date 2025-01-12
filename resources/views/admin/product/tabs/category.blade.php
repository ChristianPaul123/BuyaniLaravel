<div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-3 border-bottom">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Add Category
    </button>
</div>

<div class="card overflow-x-scroll">
    <div class="card-header">
        <h3 class="card-title">All Categories</h3>
    </div>
    <div class="card-body">
        <table id='categoryTable' class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Deactivated Date</th>
                    <th>Deactivated Status</th>
                    <th>Edit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                @php
                    $encryptedId = Crypt::encrypt($category->id);
                @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->created_at->format('l, d F Y') }}</td>
                        <td>{{ $category->updated_at->format('l, d F Y') }}</td>
                        <td>{{ $category->deactivated_date }}</td>
                        <td>{{ $category->deactivated_status == 1 ? 'Deactivated' : 'Active' }}</td>
                        <td>
                            <a href="{{ route('admin.category.edit', $encryptedId) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            @if ($category->deactivated_status)
                                <form action="{{ route('admin.category.activate', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button title="Activate" style="background:none;border:none;padding:0;cursor:pointer;">
                                        <i class="fa fa-power-off" style="color:green;"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.category.deactivate', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button title="Deactivate" style="background:none;border:none;padding:0;cursor:pointer;">
                                        <i class="fa fa-power-off" style="color:red;"></i>
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.add') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="chart-contaner mt-4" style="border: 1px solid #d2d2d2; padding: 20px; border-radius: 7px;">
    <div class="bar-chart">
        <label class="chart-label text-center d-block">Categories</label>
        <div class="chart">
            <canvas id="category_bar"></canvas>
        </div>
    </div>
</div>

