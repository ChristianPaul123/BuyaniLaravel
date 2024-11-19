<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use Livewire\WithPagination;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductView extends Component
{

    use WithPagination;

    public $product;
    public $categories;
    public $subcategories;
    public $message;

    public $quantities = []; // Array for quantities
    public $product_status;
    public $productSpecification;
    public $productId;

    protected $paginationTheme = 'bootstrap'; // Use Bootstrap styling for pagination

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = Product::with('category', 'subcategory', 'productSpecification', 'inventory')->findOrFail($productId);
        $this->categories = $this->product->category;
        $this->subcategories = $this->product->subcategory;
        $this->productSpecification = $this->product->productSpecification;
        $this->product_status = $this->product->product_status;


        foreach ($this->product->productSpecification as $specification) {
            $this->quantities[$specification->id] = 1; // Default to 1
        }
    }

    public function incrementQuantity($specificationId)
    {
        if (isset($this->quantities[$specificationId]) && $this->quantities[$specificationId] < 20) {
            $this->quantities[$specificationId]++;
        }
    }

    public function decrementQuantity($specificationId)
    {
        if (isset($this->quantities[$specificationId]) && $this->quantities[$specificationId] > 1) {
            $this->quantities[$specificationId]--;
        }
    }

    public function addToCart($specificationId)
    {
        $this->validate([
            "quantities.$specificationId" => ['required', 'integer', 'min:1', 'max:20'],
            'product_status' => ['required', 'numeric'],
        ]);

        $user = Auth::guard('user')->user();

        try {
            $cart = Cart::firstOrCreate(
                ['user_id' => $user->id],
                ['cart_total' => 0, 'overall_cartKG' => 0, 'total_price' => 0]
            );

            $productSpecification = ProductSpecification::findOrFail($specificationId);

            $cartItem = CartItem::firstOrNew(
                [
                    'cart_id' => $cart->id,
                    'product_specification_id' => $productSpecification->id,
                ]
            );

            $quantity = $this->quantities[$specificationId];

            $cartItem->quantity = $cartItem->exists ? $cartItem->quantity + $quantity : $quantity;
            $cartItem->price = $productSpecification->product_price * $cartItem->quantity;
            $cartItem->overall_kg = $productSpecification->product_kg * $cartItem->quantity;
            $cartItem->product_status = $this->product_status;
            $cartItem->save();

            $cart->cart_total = $cart->cartItems()->sum('quantity');
            $cart->overall_cartKG = $cart->cartItems()->sum('overall_kg');
            $cart->total_price = $cart->cartItems()->sum('price');
            $cart->save();

            session()->flash('message', 'Product added to cart successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error occurred while adding the product to the cart.');
        }
    }

    public function render()
    {
        return view('livewire.product-view', [
            'product' => $this->product,
           'specifications' => $this->product->productSpecification()->paginate(5),
        ]);
    }
}
