<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

//This is for the admin side

     public function showProducts()
      {
        $products = Product::all();
        $subcategories = SubCategory::all();
        $categories = Category::all();
         return view('admin.product.product', ['products'=>$products,'subcategories' =>$subcategories, 'categories' => $categories]);
      }


       public function addProduct(Request $request) {

         try {
             $validatedData = $request->validate([
                 'product_name' => ['required',  Rule::unique('products','product_name')],
                 'product_details' => ['required'],
                 'product_status' => ['required'],
                 'category_id' => ['required'],
                 'subcategory_id' => ['required'],
                 'product_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max: 4096',
             ]);
         } catch (\Illuminate\Validation\ValidationException $e) {
             return redirect()->route('admin.product')->withErrors($e->errors());
         }


         if ($request->hasFile('product_pic')) {
            $imageName = time().'.'.$request->product_pic->extension();
            $request->product_pic->move(public_path('img/product/'.$validatedData['product_name']), $imageName);
            $validatedData['product_pic'] = 'img/product/'.$validatedData['product_name'].'/'.$imageName;
        } else {
            return redirect()->route('admin.product')->withErrors(['product_pic' => 'No image uploaded.']);
        }

         Product::create($validatedData);
         return redirect()->route('admin.product')->with('message', 'Product added successfully.');
      }


 // Add logic to handle product editing
 public function editProduct($product)
 {
     // Find the product by id
     try {
         $product = Product::findOrFail($product);
     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
         return redirect()->route('admin.product')->withErrors(['product' => 'Product not found.']);
     }
     $subcategories = SubCategory::all();
     $categories = Category::all();

     // Return the view with the product
     return view('admin.product.edit-product', ['product' => $product,'categories' => $categories, 'subcategories' => $subcategories]);
 }

 // Add logic to handle product update
 public function updateProduct($product, Request $request)
 {
     // Validate the request data
     try {
         $validatedData = $request->validate([
             'product_name' => ['required', Rule::unique('products', 'product_name')->ignore($product)],
             'product_details' => ['required'],
             'product_status' => ['required'],
             'category_id' => ['required'],
             'subcategory_id' => ['required'],
             'product_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
     } catch (\Illuminate\Validation\ValidationException $e) {
         return redirect()->route('admin.product.edit', ['product' => $product])->withErrors($e->errors());
     }

     // Find the product by id
     $product = Product::findOrFail($product);

     // Update the product
     if ($request->hasFile('product_pic')) {
         // Delete the old image if it exists
         if ($product->product_pic) {
             Storage::delete($product->product_pic);
         }

         $imageName = time() . '.' . $request->product_pic->extension();
         $request->product_pic->move(public_path('img/product/' . $validatedData['product_name']), $imageName);
         $validatedData['product_pic'] = 'img/product/' . $validatedData['product_name'] . '/' . $imageName;
     }

     if ($validatedData['product_status'] == 2) {
        $validatedData['product_deactivated'] = now();// the current date and time
    } else {
        $validatedData['product_deactivated'] = null;
    }

     $product->update($validatedData);
     return redirect()->route('admin.product')->with('message', 'Product updated successfully.');
 }

 // Add logic to handle product deletion
 public function deleteProduct($product)
 {
     // Find the product by id
     try {
         $product = Product::findOrFail($product);
     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
         return redirect()->route('admin.product')->withErrors(['product' => 'Product not found.']);
     }

     // Delete the product
     $product->delete();

     // Delete the product image if it exists
     if ($product->product_pic) {
         Storage::delete($product->product_pic);
     }

     return redirect()->route('admin.product')->with('message', 'Product deleted successfully.');
 }



////////////////////////////////////////////////////////////////////////////////////////////////

//This is for the user side








}


