<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Category;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserProductController extends Controller
{
    public function showConsumerProduct()
    {
        try {
            $categories = Category::all();
            $subcategories = SubCategory::all();
            $products = Product::where('product_status', 1)->get();

            if ($products->isEmpty()) {
                return view('user.product.show', [
                    'products' => $products,
                    'categories' => $categories,
                    'subcategories' => $subcategories,
                    'message' => 'Sorry, there are no products available at the moment.'
                ]);
            }

            return view('user.product.show', [
                'products' => $products,
                'categories' => $categories,
                'subcategories' => $subcategories
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while retrieving products.');
        }
    }

    public function viewConsumerProduct($product) {
        try {
            $product = Product::with('category', 'subcategory', 'productImages', 'productSpecification', 'inventory')->findOrFail($product);
            $categories = Category::all();
            $subcategories = SubCategory::all();

            return view('user.product.view', [
                'product' => $product,
                'categories' => $categories,
                'subcategories' => $subcategories,
                'productSpecification' => $product->productSpecification,
                'inventory' => $product->inventory
            ]);
        } catch (\Exception $e) {
            return back()->with(['error', 'An error occurred while retrieving the product.', 'product' => $product]);
        }
    }
    public function addProductSpecificationToCart(Request $request, $product, $specification)
    {
         // Step 1: try to check
        try {
            if (!Auth::check()) {
                // If not authenticated, flush the session and redirect to user index with a message
                Session::flush();
                return redirect()->route('user.index')->with('message', 'Session expired. Please log in and try again.');
            }

            // Step 2: Find or create a cart for the current user
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::user()->id],
                ['cart_total' => 0, 'overall_cartKG' => 0, 'total_price' => 0]
            );

              // Step 3: Retrieve the selected product specification
            $product_status = $request->input('product_status');
            $productSpecification = ProductSpecification::findOrFail($specification);

            // Step 4: Validate quantity input
            $quantity = $request->input('quantity', 1);
            if ($quantity < 1) {
                return redirect()->back()->with(['error' => 'Invalid quantity specified.', 'product' => $product]);
            }

            // Step 5: Create or update CartItem for this product specification in the current cart
            $cartItem = CartItem::firstOrNew(
                [
                    'cart_id' => $cart->id,
                    'product_specification_id' => $specification,
                ]
            );

            // Update quantity and calculate price and weight
            $cartItem->quantity = $cartItem->exists ? $cartItem->quantity + $quantity : $quantity;
            $cartItem->price = $productSpecification->product_price * $cartItem->quantity;
            $cartItem->overall_kg = $productSpecification->product_kg * $cartItem->quantity;
            $cartItem->product_status = $product_status;  // Set product status

            // Save CartItem
            $cartItem->save();

            // Step 6: Recalculate cart totals
            $cart->cart_total = $cart->cartItems()->sum('quantity');
            $cart->overall_cartKG = $cart->cartItems()->sum('overall_kg');
            $cart->total_price = $cart->cartItems()->sum('price');
            $cart->save();

            // Step 7: Redirect back with success message
            return redirect()->back()->with(['message' => 'Product added to cart successfully!', 'product' => $product]);

        } catch (\Exception $e) {
            // Log the exception
            // \Log::error('Error adding to cart: ' . $e->getMessage());
            return redirect()->back()->with(['error' => 'An unexpected error occurred while adding the product to the cart.', 'product' => $product]);
        }
    }
}



////////////////////////////////
//tHis is just for testing

//     public function showConsumerProductDetails($id)
//     {
//         try {
//             $product = Product::findOrFail($id);
//             return view('consumer.product-details', ['product' => $product]);
//         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
//             return back()->with('error', 'Sorry, the product you are looking for does not exist.');
//         } catch (\Exception $e) {
//             return back()->with('error', 'An error occurred while retrieving the product details.');
//         }
//     }

//     public function showConsumerProductBySubCategory($subcategory)
//     {
//         try {
//             $subcategory = SubCategory::findOrFail($subcategory);
//             $categories = Category::all();
//             $subcategories = SubCategory::all();
//             $products = Product::where('subcategory_id', $subcategory->id)
//                 ->where('product_status', 1)
//                 ->get();

//             if ($products->isEmpty()) {
//                 return view('user.product.show-subcategory', [
//                     'products' => $products,
//                     'subcategory' => $subcategory,
//                     'categories' => $categories,
//                      'message' => 'Sorry, there are no products under the ' . $subcategory->sub_category_name . ' subcategory at the moment.'
//                 ]);
//             }

//             return view('user.product.show-subcategory', [
//                 'products' => $products,
//                 'subcategory' => $subcategory,
//                 'categories' => $categories
//             ]);
//         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
//             return back()->with('error', 'Sorry, the subcategory you are looking for does not exist.');
//         } catch (\Exception $e) {
//             return back()->with('error', 'An error occurred while retrieving products for the subcategory.');
//         }
//     }

//     public function showConsumerProductByCategory($category)
//     {
//         try {
//             $category = Category::findOrFail($category);
//             $categories = Category::all();
//             $subcategories = SubCategory::all();
//             $products = Product::where('category_id', $category->id)
//                 ->where('product_status', 1)
//                 ->get();

//             if ($products->isEmpty()) {
//                 return view('user.product.show-category', [
//                     'products' => $products,
//                     'category' => $category,
//                     'subcategories' => $subcategories,
//                     'categories' => $categories,
//                     'message' => 'Sorry, there are no products under this' . $category->category_name . ' at the moment.'
//                 ]);
//             }

//             return view('user.product.show-category', [
//                 'products' => $products,
//                 'category' => $category,
//                 'subcategories' => $subcategories,
//                 'categories' => $categories
//             ]);
//         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
//             return back()->with('error', 'Sorry, the category you are looking for does not exist.');
//         } catch (\Exception $e) {
//             return back()->with('error', 'An error occurred while retrieving products for the category.');
//         }
//     }

//     public function searchConsumerProduct(Request $request)
//     {
//         try {
//             // Validate that 'query' exists in the request
//             $request->validate([
//                 'query' => 'required|string|min:3'
//             ]);

//             // Get the search query from the request
//             $query = $request->input('query');

//             // Search for products by product name (you can also add more search fields)
//             $products = Product::where('product_name', 'LIKE', '%' . $query . '%')
//                 ->where('product_status', 1)
//                 ->get();

//             // Retrieve categories and subcategories for the sidebar or dropdown
//             $categories = Category::all();
//             $subcategories = SubCategory::all();

//             if ($products->isEmpty()) {
//                 // If no products are found, return a message
//                 return view('user.product.search', [
//                     'products' => $products,
//                     'categories' => $categories,
//                     'subcategories' => $subcategories,
//                     'message' => "Sorry, no products were found for '{$query}'."
//                 ]);
//             }

//             // Return search results if products are found
//             return view('user.product.search', [
//                 'products' => $products,
//                 'categories' => $categories,
//                 'subcategories' => $subcategories
//             ]);
//         } catch (\Exception $e) {
//             return back()->with('error', 'An error occurred while performing the search.');
//         }
//     }


