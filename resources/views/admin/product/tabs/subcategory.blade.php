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
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $subcategory)
                @php
                $encryptedId = Crypt::encrypt($subcategory->id);
            @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subcategory->sub_category_name }}</td>
                        <td>{{ $subcategory->category->category_name }}</td>
                        <td>{{ $subcategory->created_at }}</td>
                        <td>{{ $subcategory->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.subcategory.edit', $encryptedId) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.subcategory.delete', $subcategory->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this subcategory?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Subcategory Modal -->
<div class="modal fade" id="addSubCategoryModal" tabindex="-1" aria-labelledby="addSubCategoryModalLabel" aria-hidden="true">
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
                        <input type="text" class="form-control" id="sub_category_name" name="sub_category_name" required>
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
