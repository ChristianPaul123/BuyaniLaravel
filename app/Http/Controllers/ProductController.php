<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showProducts()
    {
        return view('admin.product');
    }

    public function DisplayProductsOnConsumer()
    {
        $products = Product::all();
        return view('consumer.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddProductOnAdmin()
    {
        return view('admin.add-product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function DisplayProductOnAdmin
    (Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = new Product($validatedData);
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function DisplaySpecificProductInfo(Product $product)
    {
        return view('consumer.product-info', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function EditProductOnAdminPage(Product $product)
    {
        return view('admin.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateProductOnAdminPage(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product->update($validatedData);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteProductOnAdminPage(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}
