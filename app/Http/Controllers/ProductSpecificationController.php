<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProductSpecification;

class ProductSpecificationController extends Controller
{
// Show all product specifications
public function showProductSpecification()
{
    $productSpecifications = ProductSpecification::all();
    $products = Product::all();
    return view('admin.product.product-spec', ['productSpecifications' => $productSpecifications, 'products' => $products]);
}

// Add a new product specification
public function addProductSpecification(Request $request)
{
    try {
        $validatedData = $request->validate([
            'product_id' => ['required'],
            'specification_name' => ['required', Rule::unique('product_specifications', 'specification_name')],
            'specific_product_info' => ['required'],
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
            'specific_product_info' => ['required'],
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


//

}
