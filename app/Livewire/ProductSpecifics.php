<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\SubCategory;
use Livewire\WithFileUploads;


use Illuminate\Validation\Rule;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Storage;

class ProductSpecifics extends Component
{

    use WithFileUploads;
    // Modal visibility states
    public $showAddProductModal = false;
    public $showEditProductModal = false;
    public $showAddSpecModal = false;
    public $showEditSpecModal = false;

    public  $product_status = 1;

    // Product properties
    public $product_name, $product_details, $product_pic, $category_id, $subcategory_id, $editingProductId;

    // Product Specification properties
    public $specification_name, $product_price, $product_kg, $admin_id, $product_id, $editingSpecId;

    // Dynamic data
    public $products, $productSpecifications, $categories, $subcategories;
    public function mount()
    {
        $this->fetchProducts();
        $this->fetchCategories();
        $this->fetchProductSpecifications();
    }

    // Fetch all products
    public function fetchProducts()
    {
        $this->products = Product::with('category', 'subcategory')->get();
    }

    // Fetch all categories and subcategories
    public function fetchCategories()
    {
        $this->categories = Category::all();
        $this->subcategories = SubCategory::all();
    }

    // Fetch all product specifications
    public function fetchProductSpecifications()
    {
        $this->productSpecifications = ProductSpecification::with('product')->get();
    }

    // Show Add Product Modal
    public function showAddingProductModal()
    {
        // Reset modal fields
        $this->reset([
            'product_name',
            'product_details',
            'product_status',
            'category_id',
            'subcategory_id'
        ]);

        $this->showAddProductModal = true;
    }

    // Show Add Product Specification Modal
    public function showAddingSpecModal()
    {
        // Reset modal fields
        $this->reset([
            'specification_name',
            'product_price',
            'product_kg',
            'admin_id',
            'product_id'
        ]);

        $this->showAddSpecModal = true;
    }


    // Show edit product modal
    public function addProduct()
    {
        $validatedData = $this->validate([
            'product_name' => ['required', 'string', 'max:255', 'unique:products,product_name'],
            'product_details' => ['required', 'string'],
            'product_status' => ['required', 'integer'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['required', 'exists:sub_categories,id'],
            'product_pic' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4096'], // Validation for image
        ]);

        // Check and upload the image
        if ($this->product_pic) {
            try {
                // Generate a unique file name
                $imageName = time() . '.' . $this->product_pic->getClientOriginalExtension();

                // Define storage path
                $path = $this->product_pic->storeAs(
                    'img/product/' . $validatedData['product_name'], // Directory path
                    $imageName, // File name
                    'public' // Storage disk
                );

                // Store the file path in validated data
                $validatedData['product_pic'] = $path;

            } catch (\Exception $e) {
                // If image upload fails, show an error
                session()->flash('error', 'Failed to upload the product image. Please try again.');
                return;
            }
        }

        // Create the product
        $product = Product::create($validatedData);

        // Initialize inventory for the product
        Inventory::create([
            'product_id' => $product->id,
            'product_new_stock' => 0,
            'product_old_stock' => 0,
            'product_total_stock' => 0,
            'product_sold_stock' => 0,
            'product_damage_stock' => 0,
        ]);

        // Refresh products and close the modal
        $this->fetchProducts();
        $this->closeModal();

        // Flash success message
        session()->flash('message', 'Product added successfully.');
    }


    // Edit Product
    public function showEditingProductModal($id)
    {
        $product = Product::findOrFail($id);


        // Prefill product data
        $this->editingProductId = $id;
        $this->product_name = $product->product_name;
        $this->product_details = $product->product_details;
        $this->product_status = $product->product_status;
        $this->category_id = $product->category_id;
        $this->subcategory_id = $product->subcategory_id;

        $this->showEditProductModal = true;
    }

    public function updateProduct()
    {
        $product = Product::findOrFail($this->editingProductId);

        $validatedData = $this->validate([
            'product_name' => ['required', 'string', 'max:255', Rule::unique('products', 'product_name')->ignore($this->editingProductId)],
            'product_details' => ['required', 'string'],
            'product_status' => ['required', 'integer'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['required', 'exists:sub_categories,id'],
            'product_pic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($this->product_pic) {
            if ($product->product_pic) {
                Storage::delete($product->product_pic);
            }

            $imageName = time() . '.' . $this->product_pic->extension();
            $validatedData['product_pic'] = $this->product_pic->storeAs(
                'img/product/' . $validatedData['product_name'],
                $imageName,
                'public'
            );
        }

        if ($validatedData['product_status'] == 3) {
            $validatedData['product_deactivated'] = now();
        } else {
            $validatedData['product_deactivated'] = null;
        }

        $product->update($validatedData);
        $this->fetchProducts();
        $this->closeModal();
        session()->flash('message', 'Product updated successfully.');
    }

    // Delete Product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->product_pic) {
            Storage::delete($product->product_pic);
        }

        $product->delete();
        $this->fetchProducts();
        session()->flash('message', 'Product deleted successfully.');
    }

    // Add Product Specification
    public function addProductSpecification()
    {
        $validatedData = $this->validate([
            'product_id' => ['required', 'exists:products,id'],
            'specification_name' => ['required', 'string', 'max:255', Rule::unique('product_specifications', 'specification_name')],
            'product_price' => ['required', 'numeric', 'min:0'],
            'product_kg' => ['required', 'numeric', 'min:0'],
            'admin_id' => ['required', 'exists:admins,id'],
        ]);

        ProductSpecification::create($validatedData);

        $this->fetchProductSpecifications();
        $this->closeModal();
        session()->flash('message', 'Product Specification added successfully.');
    }

    // Edit Product Specification
    public function showEditingSpecModal($id)
    {
        $specification = ProductSpecification::findOrFail($id);

        // Prefill specification data
        $this->editingSpecId = $id;
        $this->specification_name = $specification->specification_name;
        $this->product_price = $specification->product_price;
        $this->product_kg = $specification->product_kg;
        $this->product_id = $specification->product_id;

        $this->showEditSpecModal = true;
    }

    public function updateProductSpecification()
    {
        $specification = ProductSpecification::findOrFail($this->editingSpecId);

        $validatedData = $this->validate([
            'product_id' => ['required', 'exists:products,id'],
            'specification_name' => ['required', 'string', 'max:255', Rule::unique('product_specifications', 'specification_name')->ignore($this->editingSpecId)],
            'product_price' => ['required', 'numeric', 'min:0'],
            'product_kg' => ['required', 'numeric', 'min:0'],
            'admin_id' => ['required', 'exists:admins,id'],
        ]);

        $specification->update($validatedData);

        $this->fetchProductSpecifications();
        $this->closeModal();
        session()->flash('message', 'Product Specification updated successfully.');
    }

    // Delete Product Specification
    public function deleteProductSpecification($id)
    {
        $specification = ProductSpecification::findOrFail($id);
        $specification->delete();

        $this->fetchProductSpecifications();
        session()->flash('message', 'Product Specification deleted successfully.');
    }

    // Close all modals and reset fields
    public function closeModal()
    {
        $this->reset([
            'product_name', 'product_details', 'product_status', 'category_id', 'subcategory_id', 'editingProductId',
            'specification_name', 'product_price', 'product_kg', 'admin_id', 'product_id', 'editingSpecId',
            'showAddProductModal', 'showEditProductModal', 'showAddSpecModal', 'showEditSpecModal'
        ]);
    }

    public function render()
    {
        return view('livewire.product-specifics');
    }
}
