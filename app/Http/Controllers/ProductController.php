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
        //$products = Product::all();
        //return view('admin.product', compact('products'));
        return view('admin.product.product');

    }

    /**
     * Display the specified resource.
     */

     public function viewProduct(Product $product)
      {

+        $product = Product::findOrFail($product->id); // Retrieve the product by its ID
         return view('admin.product', compact('product'));
      }

      public function showAddProduct() {
        return view('admin.product.add-product');
      }

      public function addProduct(Request $request) {
        $validatedData = $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_details' => 'required',
            'product_status' => 'required',
            'product_kg' => 'required',

            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //$imageName = time().'.'.$request->image->extension();

        //$request->image->move(public_path('images'), $imageName);

        //$product = new Product();
        //$product->name = $validatedData['name'];
        //$product->description = $validatedData['description'];
      }


    public function editProduct($id)
    {
        // Add logic to handle product editing
    }

    public function updateProduct($id, Request $request)
    {
        // Add logic to handle product update
    }

    public function deleteProduct($id)
    {
        // Add logic to handle product deletion
    }



}

