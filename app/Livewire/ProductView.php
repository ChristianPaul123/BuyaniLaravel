<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductView extends Component
{
    public $product;
    public $categories;
    public $subcategories;
    public $message;

    // Properties to capture quantity and specification ID for adding to cart
    public $quantities = 1;

    public $product_status;
    public $productSpecification;

    public $specification;

    public $productId;

    public function mount($productId)
    {
        // Retrieve the product along with related models
        $this->productId = $productId;
        $this->product = Product::with('category', 'subcategory', 'productSpecification', 'inventory')->findOrFail($productId);
        $this->categories = $this->product->category;
        $this->subcategories = $this->product->subcategory;
        $this->productSpecification = $this->product->productSpecification;
        $this->product_status = $this->product->product_status; // Default to the first specification

    }



    public function addToCart($specification)
    {



        $validatedData = $this->validate([
            'quantities' => ['required', 'integer', 'min:1'],
            'product_status' => ['required', 'numeric'],
        ]);


        $this->$specification = $specification;
        $user = Auth::guard('user')->user();


        try {
            // Step 2: Find or create a cart for the current user
            $cart = Cart::firstOrCreate(
                ['user_id' => $user->id],
                ['cart_total' => 0, 'overall_cartKG' => 0, 'total_price' => 0]
            );

            // Step 3: Retrieve the selected product specification
            $productSpecification = ProductSpecification::findOrFail($specification);
            // dd( $productSpecification);


            $this->quantities = $validatedData['quantities'];
            $this->product_status = $validatedData['product_status'];

            // Step 5: Create or update CartItem for this product specification in the current cart
            $cartItem = CartItem::firstOrNew(
                [
                    'cart_id' => $cart->id,
                    'product_specification_id' => $productSpecification->id,
                ]
            );

            // Update quantity and calculate price and weight
            $cartItem->quantity = $cartItem->exists ? $cartItem->quantity + $this->quantities : $this->quantities;
            $cartItem->price = $productSpecification->product_price * $cartItem->quantity;
            $cartItem->overall_kg = $productSpecification->product_kg * $cartItem->quantity;
            $cartItem->product_status = $this->product_status;// Set product status
            // Save CartItem
            $cartItem->save();


            // Step 6: Recalculate cart totals
            $cart->cart_total = $cart->cartItems()->sum('quantity');
            $cart->overall_cartKG = $cart->cartItems()->sum('overall_kg');
            $cart->total_price = $cart->cartItems()->sum('price');
            $cart->save();


            // Step 7: Redirect back with success message
            session()->flash('message', 'Product added to cart successfully!');

        } catch (\Exception $e) {
            // Log the exception
            // \Log::error('Error adding to cart: ' . $e->getMessage());
            return redirect()->back()->with(['error' => 'An unexpected error occurred while adding the product to the cart.', 'product' => $this->productId]);
        }
    }

    public function render()
    {
        return view('livewire.product-view', [
            'product' => $this->product,
            'specifications' => $this->product->productSpecification,
        ]);
    }
}
