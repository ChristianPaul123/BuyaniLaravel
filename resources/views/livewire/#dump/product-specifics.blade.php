<div>

    <!-- Notifications -->
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-8">
            <h2>Manage Products</h2>
        </div>
        <div class="col-4 text-end">
            <button class="btn btn-primary" wire:click="showAddingProductModal">Add Product</button>
            <button class="btn btn-secondary" wire:click="showAddingSpecModal">Add Product Specification</button>
        </div>
    </div>

    <!-- Tabs for navigation -->
    <ul class="nav nav-tabs" id="productTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">
                Products
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab">
                Product Specifications
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content mt-4" id="productTabsContent">
        <!-- Products Tab -->
        <div class="tab-pane fade show active" id="products" role="tabpanel">
            <div class="card overflow-auto">
                <div class="card-header">
                    <h3 class="card-title">All Products</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_details }}</td>
                                    <td>{{ $product->status_label }}</td>
                                    <td>
                                        <img src="{{ Storage::url($product->product_pic) }}" alt="Product Image" width="50" height="auto">
                                    </td>
                                    <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                                    <td>{{ $product->subcategory->sub_category_name ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-primary" wire:click="showEditingProductModal({{ $product->id }})">Edit</button>
                                        <button class="btn btn-danger" wire:click="deleteProduct({{ $product->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Product Specifications Tab -->
        <div class="tab-pane fade" id="specifications" role="tabpanel">
            <div class="card overflow-auto">
                <div class="card-header">
                    <h3 class="card-title">All Product Specifications</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Specification Name</th>
                                <th>Price</th>
                                <th>Weight (kg)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productSpecifications as $specification)
                                <tr>
                                    <td>{{ $specification->product->product_name ?? 'N/A' }}</td>
                                    <td>{{ $specification->specification_name }}</td>
                                    <td>${{ $specification->product_price }}</td>
                                    <td>{{ $specification->product_kg }} kg</td>
                                    <td>
                                        <button class="btn btn-primary" wire:click="showEditingSpecModal({{ $specification->id }})">Edit</button>
                                        <button class="btn btn-danger" wire:click="deleteProductSpecification({{ $specification->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Modals -->

    <!-- Add Product Modal -->
    @if ($showAddProductModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="addProduct">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" id="productName" class="form-control" wire:model="product_name">
                                @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="productDetails" class="form-label">Product Details</label>
                                <textarea id="productDetails" class="form-control" rows="3" wire:model="product_details"></textarea>
                                @error('product_details') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Category</label>
                                <select id="productCategory" class="form-control" wire:model="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="productSubcategory" class="form-label">Subcategory</label>
                                <select id="productSubcategory" class="form-control" wire:model="subcategory_id">
                                    <option value="">Select Subcategory</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="productImage" class="form-label">Upload Image</label>
                                <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="profilePic" wire:model="product_pic">
                                @error('product_pic') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <input type="hidden" wire:model="product_status" value="1">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Add Product Specification Modal -->
    @if ($showAddSpecModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product Specification</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="addProductSpecification">
                            <div class="mb-3">
                                <label for="specProduct" class="form-label">Product</label>
                                <select id="specProduct" class="form-control" wire:model="product_id">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="specName" class="form-label">Specification Name</label>
                                <input type="text" id="specName" class="form-control" wire:model="specification_name">
                                @error('specification_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="specPrice" class="form-label">Price</label>
                                <input type="number" id="specPrice" class="form-control" wire:model="product_price">
                                @error('product_price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="specWeight" class="form-label">Weight (kg)</label>
                                <input type="number" id="specWeight" class="form-control" wire:model="product_kg">
                                @error('product_kg') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($showEditProductModal)
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateProduct">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Product Name</label>
                            <input type="text" id="editProductName" class="form-control" wire:model="product_name">
                            @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editProductDetails" class="form-label">Product Details</label>
                            <textarea id="editProductDetails" class="form-control" rows="3" wire:model="product_details"></textarea>
                            @error('product_details') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editProductCategory" class="form-label">Category</label>
                            <select id="editProductCategory" class="form-control" wire:model="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editProductSubcategory" class="form-label">Subcategory</label>
                            <select id="editProductSubcategory" class="form-control" wire:model="subcategory_id">
                                <option value="">Select Subcategory</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->sub_category_name }}</option>
                                @endforeach
                            </select>
                            @error('subcategory_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="productStatus" class="form-label">Product Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="productStatusAvailable" wire:model="product_status" value="1">
                                <label class="form-check-label" for="productStatusAvailable">Available</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="productStatusOutOfStock" wire:model="product_status" value="2">
                                <label class="form-check-label" for="productStatusOutOfStock">Out of Stock</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="productStatusUnavailable" wire:model="product_status" value="3">
                                <label class="form-check-label" for="productStatusUnavailable">Unavailable</label>
                            </div>
                            @error('product_status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage" class="form-label">Upload Image</label>
                            <input type="file" id="editProductImage" class="form-control" wire:model="product_pic">
                            @error('product_pic') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Edit Product Specification Modal -->
    @if ($showEditSpecModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product Specification</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updateProductSpecification">
                            <div class="mb-3">
                                <label for="editSpecProduct" class="form-label">Product</label>
                                <select id="editSpecProduct" class="form-control" wire:model="product_id">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="editSpecName" class="form-label">Specification Name</label>
                                <input type="text" id="editSpecName" class="form-control" wire:model="specification_name">
                                @error('specification_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="editSpecPrice" class="form-label">Price</label>
                                <input type="number" id="editSpecPrice" class="form-control" wire:model="product_price">
                                @error('product_price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="editSpecWeight" class="form-label">Weight (kg)</label>
                                <input type="number" id="editSpecWeight" class="form-control" wire:model="product_kg">
                                @error('product_kg') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
