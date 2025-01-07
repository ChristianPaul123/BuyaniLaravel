<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProductSpecification;

class ProductSpecificationController extends Controller
{
// Show all product specifications
public function showProductSpecification()
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

// Add a new product specification
public function addProductSpecification(Request $request)
{
    try {
        $validatedData = $request->validate([
            'product_id' => ['required'],
            'specification_name' => ['required', Rule::unique('product_specifications', 'specification_name')],
            'product_price' => ['required'],
            'product_kg' => ['required'],
            'admin_id' => ['required'],
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->route('admin.product.specification')->withErrors($e->errors());
    }

    ProductSpecification::create($validatedData);
    return redirect()->route('admin.product.specification')->with('message', 'Product specification added successfully.');
}

// Edit a product specification
public function editProductSpecification($productSpecification)
{
    // Find the product specification by id
    try {
        $productSpecification = ProductSpecification::findOrFail($productSpecification);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('admin.product.specification')->withErrors(['productSpecification' => 'Product specification not found.']);
    }

    $products = Product::all();

    // Return the view with the product specification
    return view('admin.product.edit-product-spec', ['productSpecification' => $productSpecification, 'products' => $products]);
}

// Update a product specification
public function updateProductSpecification($productSpecification, Request $request)
{
    // Validate the request data
    try {
        $validatedData = $request->validate([
            'product_id' => ['required'],
            'specification_name' => ['required', Rule::unique('product_specifications', 'specification_name')->ignore($productSpecification)],
            'product_price' => ['required'],
            'product_kg' => ['required'],
            'admin_id' => ['required'],
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->route('admin.product.specification.edit', ['productSpecification' => $productSpecification])->withErrors($e->errors());
    }

    // Find the product specification by id
    $productSpecification = ProductSpecification::findOrFail($productSpecification);

    // Update the product specification
    $productSpecification->update($validatedData);
    return redirect()->route('admin.product.specification')->with('message', 'Product specification updated successfully.');
}

// Delete a product specification
public function deleteProductSpecification($productSpecification)
{
    // Find the product specification by id
    try {
        $productSpecification = ProductSpecification::findOrFail($productSpecification);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('admin.product.specification')->withErrors(['productSpecification' => 'Product specification not found.']);
    }

    // Delete the product specification
    $productSpecification->delete();

    return redirect()->route('admin.product.specification')->with('message', 'Product specification deleted successfully.');
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
//

}
