<div>
<div class="row">
    @if (session()->has('modalmessage'))
    <div class="alert alert-success alert-dismissible fade show mx-3 my-2 px-3 py-3" role="alert">
        {{ session('modalmessage') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session()->has('modalerror'))
    <div class="alert alert-danger alert-dismissible fade show mx-3 my-2 px-3 py-3" role="alert">
        {{ session('modalerror') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="col-8">
        <h2 class="mb-4">Product Category</h2>
    </div>
    <div class="col-4">
        <button type="button" class="btn btn-success" wire:click="showcategoryModal">Create Category</button>
        <button type="button" class="btn btn-success" wire:click="showsubcategoryModal">Create Subcategory</button>
    </div>
</div>

<ul class="nav nav-tabs" id="categoryTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="category-tab" data-bs-toggle="tab" data-bs-target="#categoryTabContent" type="button" role="tab">Main Category</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="subcategory-tab" data-bs-toggle="tab" data-bs-target="#subcategoryTabContent" type="button" role="tab">Sub Category</button>
    </li>
</ul>

<div class="tab-content mt-3" id="categoryTabsContent">
    <!-- Main Category Tab -->
    <div class="tab-pane fade show active" id="categoryTabContent" role="tabpanel">
        <div class="card overflow-auto">
            <div class="card-header">
                <h3 class="card-title">All Categories</h3>
            </div>
            <div wire:ignore.self class="card-body">
                <table id="categoryTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>{{ $category->updated_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-success" wire:click="showEditCatModal({{ $category->id }})">Edit</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger" wire:click="deleteCategory({{ $category->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sub Category Tab -->
    <div class="tab-pane fade" id="subcategoryTabContent" role="tabpanel">
        <div class="card overflow-auto">
            <div class="card-header">
                <h3 class="card-title">All Subcategories</h3>
            </div>
            <div wire:ignore.self class="card-body">
                <table id="subcategoryTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Subcategory Name</th>
                            <th>Category Name</th>
                            <th>Created Date</th>
                            <th>Updated Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->sub_category_name }}</td>
                                <td>{{ $subcategory->category->category_name }}</td>
                                <td>{{ $subcategory->created_at }}</td>
                                <td>{{ $subcategory->updated_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-success" wire:click="showEditSubcatModal({{ $subcategory->id }})">Edit</button>
                                <td>
                                    <button class="btn btn-danger" wire:click="deleteSubcategory({{ $subcategory->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@if($showAddCategoryModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Category</h5>
                    </div>
                    <div class="modal-body">
                        @if (session()->has('modalmessage'))
                            <div class="alert alert-success alert-dismissible fade show mx-3 my-2 px-3 py-3" role="alert">
                                {{ session('modalmessage') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form wire:submit.prevent="addCategory">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" wire:model="category_name">
                                @error('category_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="addCategory">Save Category</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal for Adding Subcategory -->
    @if($showAddSubcategoryModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Subcategory</h5>
                    </div>
                    <div class="modal-body">
                        @if (session()->has('modalmessage'))
                            <div class="alert alert-success alert-dismissible fade show mx-3 my-2 px-3 py-3" role="alert">
                                {{ session('modalmessage') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form wire:submit.prevent="addSubcategory">
                            <div class="mb-3">
                                <label for="subcategoryName" class="form-label">Subcategory Name</label>
                                <input type="text" class="form-control" id="subcategoryName" placeholder="Enter subcategory name" wire:model="sub_category_name">
                                @error('sub_category_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="categorySelect" class="form-label">Category</label>
                                <select id="categorySelect" class="form-control" wire:model="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                        <button type="button" class="btn btn-primary" wire:click="addSubcategory">Save Subcategory</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal for Editing Subcategory -->
    @if($showEditCategoryModal)
    <!-- Edit Category Modal -->
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);" wire:ignore.self x-show="showEditCategoryModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                </div>
                <div class="modal-body">
                    @if (session()->has('modalmessage'))
                        <div class="alert alert-success alert-dismissible fade show mx-3 my-2 px-3 py-3" role="alert">
                            {{ session('modalmessage') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form wire:submit.prevent="updateCategory">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="editCategoryName" wire:model="category_name">
                            @error('category_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="updateCategory">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    @endif


    <!-- Modal for Editing Category -->
    @if($showEditSubcategoryModal)
    <!-- Edit Subcategory Modal -->
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);" wire:ignore.self x-show="showEditSubcategoryModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Subcategory</h5>
                </div>
                <div class="modal-body">
                    @if (session()->has('modalmessage'))
                        <div class="alert alert-success alert-dismissible fade show mx-3 my-2 px-3 py-3" role="alert">
                            {{ session('modalmessage') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form wire:submit.prevent="updateSubcategory">
                        <div class="mb-3">
                            <label for="editSubcategoryName" class="form-label">Subcategory Name</label>
                            <input type="text" class="form-control" id="editSubcategoryName" wire:model="sub_category_name">
                            @error('sub_category_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editCategorySelect" class="form-label">Category</label>
                            <select id="editCategorySelect" class="form-control" wire:model="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="updateSubcategory">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
