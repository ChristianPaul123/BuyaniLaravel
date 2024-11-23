<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Storage;

class ProductManagementController extends Controller
{

public function showProducts()
{
    $products = Product::with(['category', 'subcategory'])->get();
    $categories = Category::all();
    $subcategories = SubCategory::all();
    $productSpecifications = ProductSpecification::with('product')->get();

return view('admin.product.product-index', [
    'products' => $products,
    'categories' => $categories,
    'subcategories' => $subcategories,
    'productSpecifications' => $productSpecifications,
]);
}

    // Add a new product
    public function addProduct(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => ['required', 'string', 'max:255', 'unique:products,product_name'],
            'product_details' => ['required', 'string'],
            'product_status' => ['required', 'integer'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['required', 'exists:sub_categories,id'],
            'product_pic' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4096'],
        ]);

        // Upload product image
        if ($request->hasFile('product_pic')) {
            $imageName = time().'.'.$request->product_pic->extension();
            $request->product_pic->move(public_path('img/product/'.$validatedData['product_name']), $imageName);
            $validatedData['product_pic'] = 'img/product/'.$validatedData['product_name'].'/'.$imageName;
        } else {
            return redirect()->route('admin.product')->withErrors(['product_pic' => 'No image uploaded.']);
        }

        // Create product and initialize inventory
        $product = Product::create($validatedData);

        Inventory::create([
            'product_id' => $product->id,
            'product_new_stock' => 0,
            'product_old_stock' => 0,
            'product_total_stock' => 0,
            'product_sold_stock' => 0,
            'product_damage_stock' => 0,
        ]);

        return redirect()->route('admin.product.index')->with('message', 'Product added successfully.');
    }

    // Edit a product
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return view('admin.product.edit-product', [
            'product' => $product,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    // Update a product
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'product_name' => ['required', 'string', 'max:255', 'unique:products,product_name,' . $id],
            'product_details' => ['required', 'string'],
            'product_status' => ['required', 'integer'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['required', 'exists:sub_categories,id'],
            'product_pic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        // Handle image upload if a new one is provided
        if ($request->hasFile('product_pic')) {
            // Delete the old image if it exists
            if ($product->product_pic) {
                Storage::delete($product->product_pic);
            }

            $imageName = time() . '.' . $request->product_pic->extension();
            $request->product_pic->move(public_path('img/product/' . $validatedData['product_name']), $imageName);
            $validatedData['product_pic'] = 'img/product/' . $validatedData['product_name'] . '/' . $imageName;
        }


        // Set deactivation date if the status is "Unavailable"
        $validatedData['product_deactivated'] = $validatedData['product_status'] == 3 ? now() : null;

        $product->update($validatedData);

        return redirect()->route('admin.product.index')->with('message', 'Product updated successfully.');
    }

    // Delete a product
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Delete the associated image if it exists
        if ($product->product_pic) {
            Storage::delete($product->product_pic);
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('message', 'Product deleted successfully.');
    }

    // Add a product specification
    public function addProductSpecification(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'specification_name' => ['required', 'string', 'max:255', 'unique:product_specifications,specification_name'],
            'product_price' => ['required', 'numeric', 'min:0'],
            'product_kg' => ['required', 'numeric', 'min:0'],
            'admin_id' => ['required', 'exists:admins,id'],
        ]);

        ProductSpecification::create($validatedData);

        return redirect()->route('admin.product.index')->with('message', 'Product Specification added successfully.');
    }

    // Edit a product specification
    public function editProductSpecification($id)
    {
        $specification = ProductSpecification::findOrFail($id);
        $products = Product::all();

        return view('admin.product.edit-spec', [
            'specification' => $specification,
            'products' => $products,
        ]);
    }

    // Update a product specification
    public function updateProductSpecification(Request $request, $id)
    {
        $specification = ProductSpecification::findOrFail($id);

        $validatedData = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'specification_name' => ['required', 'string', 'max:255', 'unique:product_specifications,specification_name,' . $id],
            'product_price' => ['required', 'numeric', 'min:0'],
            'product_kg' => ['required', 'numeric', 'min:0'],
            'admin_id' => ['required', 'exists:admins,id'],
        ]);

        $specification->update($validatedData);

        return redirect()->route('admin.product.index')->with('message', 'Product Specification updated successfully.');
    }

    // Delete a product specification
    public function deleteProductSpecification($id)
    {
        $specification = ProductSpecification::findOrFail($id);
        $specification->delete();

        return redirect()->route('admin.product.index')->with('message', 'Product Specification deleted successfully.');
    }

    public function addCategory(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => ['required', 'string', 'max:255', 'unique:categories,category_name'],
        ]);

        Category::create($validatedData);

        return redirect()->route('admin.product.index')->with('message', 'Category added successfully.');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.product.edit-category', [
            'category' => $category,
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'category_name' => ['required', 'string', 'max:255', 'unique:categories,category_name,' . $id],
        ]);

        $category->update($validatedData);

        return redirect()->route('admin.product.index')->with('message', 'Category updated successfully.');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.product.index')->with('message', 'Category deleted successfully.');
    }

    // =================== SubCategory Management ===================

    public function addSubCategory(Request $request)
    {
        $validatedData = $request->validate([
            'sub_category_name' => ['required', 'string', 'max:255', 'unique:sub_categories,sub_category_name'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        SubCategory::create($validatedData);

        return redirect()->route('admin.product.index')->with('message', 'SubCategory added successfully.');
    }

    public function editSubCategory($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();

        return view('admin.product.edit-subcategory', [
            'subcategory' => $subcategory,
            'categories' => $categories,
        ]);
    }

    public function updateSubCategory(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $validatedData = $request->validate([
            'sub_category_name' => ['required', 'string', 'max:255', 'unique:sub_categories,sub_category_name,' . $id],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $subcategory->update($validatedData);

        return redirect()->route('admin.product.index')->with('message', 'SubCategory updated successfully.');
    }

    public function deleteSubCategory($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('admin.product.index')->with('message', 'SubCategory deleted successfully.');
    }
}
