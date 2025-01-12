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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\DecryptException;

class UserProductController extends Controller
{
    public function showConsumerProduct()
    {
        try {
            $categories = Category::all();
            $subcategories = SubCategory::all();
            $products = Product::with('inventory')
                ->where('product_status', 1)
                ->get();

            if ($products->isEmpty()) {
                return view('user.consumer.product.show', [
                    'products' => $products,
                    'categories' => $categories,
                    'subcategories' => $subcategories,
                    // 'message' => 'Sorry, there are no products available at the moment.'
                ]);
            }

            return view('user.consumer.product.show', [
                'products' => $products,
                'categories' => $categories,
                'subcategories' => $subcategories
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while retrieving products.');
        }
    }

    public function viewConsumerProduct($encryptedId) {
        try {
            $id = Crypt::decrypt($encryptedId);
            $product = Product::with('category', 'subcategory', 'productImages', 'productSpecification', 'inventory')->findOrFail($id);
            $categories = Category::all();
            $subcategories = SubCategory::all();

            return view('user.consumer.product.view', [
                'product' => $product,
                'categories' => $categories,
                'subcategories' => $subcategories,
                'productSpecification' => $product->productSpecification,
                'inventory' => $product->inventory
            ]);
        } catch (DecryptException $e) {
            return back()->with('error', 'Invalid product ID provided.');
        } catch (\Exception $e) {
            return back()->with(['error', 'An error occurred while retrieving the product.', 'product' => $product]);
        }
    }



    // public function addProductSpecificationToCart(Request $request, $product, $specification)
    // {
    //      // Step 1: try to check


    //      if (!auth()->guard('user')->check()) {
    //         Session::flush();
    //         return redirect()->route('user.index')->with('message', 'Session expired. Please log in and try again.');
    //     }
    //     try {
    //         // Step 2: Find or create a cart for the current user
    //         $cart = Cart::firstOrCreate(
    //             ['user_id' => auth()->guard("user")->user()->id],
    //             ['cart_total' => 0, 'overall_cartKG' => 0, 'total_price' => 0]
    //         );


    //           // Step 3: Retrieve the selected product specification
    //         $product_status = $request->input('product_status');
    //         $productSpecification = ProductSpecification::findOrFail($specification);

    //         // Step 4: Validate quantity input
    //         $quantity = $request->input('quantity', 1);
    //         if ($quantity < 1) {
    //             return redirect()->back()->with(['error' => 'Invalid quantity specified.', 'product' => $product]);
    //         }

    //         // Step 5: Create or update CartItem for this product specification in the current cart
    //         $cartItem = CartItem::firstOrNew(
    //             [
    //                 'cart_id' => $cart->id,
    //                 'product_specification_id' => $specification,
    //             ]
    //         );

    //         // Update quantity and calculate price and weight
    //         $cartItem->quantity = $cartItem->exists ? $cartItem->quantity + $quantity : $quantity;
    //         $cartItem->price = $productSpecification->product_price * $cartItem->quantity;
    //         $cartItem->overall_kg = $productSpecification->product_kg * $cartItem->quantity;
    //         $cartItem->product_status = $product_status;  // Set product status

    //         // Save CartItem
    //         $cartItem->save();

    //         // Step 6: Recalculate cart totals
    //         $cart->cart_total = $cart->cartItems()->sum('quantity');
    //         $cart->overall_cartKG = $cart->cartItems()->sum('overall_kg');
    //         $cart->total_price = $cart->cartItems()->sum('price');
    //         $cart->save();

    //         // Step 7: Redirect back with success message
    //         return redirect()->back()->with(['message' => 'Product added to cart successfully!', 'product' => $product]);

    //     } catch (\Exception $e) {
    //         // Log the exception
    //         // \Log::error('Error adding to cart: ' . $e->getMessage());
    //         return redirect()->back()->with(['error' => 'An unexpected error occurred while adding the product to the cart.', 'product' => $product]);
    //     }
    // }
}
