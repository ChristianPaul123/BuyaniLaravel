<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class UserProductController extends Controller
{
 public function showConsumerProduct()
 {
    $products = Product::where('product_status', 1)->get();
    return view('user.product.show', compact('products'));
 }
 public function showConsumerProductDetails($id)
 {
    $product = Product::findOrFail($id);
    return view('consumer.product-details', compact('product'));
 }
 public function showConsumerProductCategory($id)
 {
    $category = Category::findOrFail($id);
    $products = Product::where('category_id', $id)->where('status', 1)->get();
    return view('consumer.product-category', compact('products', 'category'));
 }


}
