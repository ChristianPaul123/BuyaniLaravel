<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Inventory;
use Livewire\WithPagination;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Counter\CartCounter;
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
            $this->dispatch('addedtoCart')->to(CartCounter::class);
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

    // use WithPagination;

    // public $product;
    // public $categories;
    // public $subcategories;
    // public $message;

    // public $quantities = []; // Array for quantities
    // public $productTotalStock = [];
    // public $product_status;
    // public $productSpecification;
    // public $productId;

    // protected $paginationTheme = 'bootstrap'; // Use Bootstrap styling for pagination

    // public function mount($productId)
    // {
    //     $this->productId = $productId;
    //     $this->product = Product::with('category', 'subcategory', 'productSpecification', 'inventory')->findOrFail($productId);
    //     $this->categories = $this->product->category;
    //     $this->subcategories = $this->product->subcategory;
    //     $this->productSpecification = $this->product->productSpecification;
    //     $this->product_status = $this->product->product_status;
    //     $count = 0;

    //     foreach ($this->productSpecification as $specification) {
    //         $this->productTotalStock[$specification->id] = $specification->product->inventory->product_total_stock;

    //         $this->quantities[$specification->id] = ($this->productTotalStock[$specification->id] >= $specification->product_kg)
    //             ? $specification->product_kg
    //             : 0;
    //     }

    // }

    // public function incrementQuantity($specificationId)
    // {
    //     $productkg = ProductSpecification::find($specificationId);

    //     if (isset($this->quantities[$specificationId]) && $this->quantities[$specificationId] < $this->productTotalStock[$specificationId]) {
    //         $this->quantities[$specificationId]+=$productkg->product_kg;
    //     }

    // }

    // public function decrementQuantity($specificationId)
    // {
    //     $productkg = ProductSpecification::find($specificationId);

    //     if (isset($this->quantities[$specificationId]) && $this->quantities[$specificationId] > 1) {
    //         $this->quantities[$specificationId]-=$productkg->product_kg;
    //     }
    // }

    // public function addToCart($specificationId)
    // {
    //     $this->validate([
    //         "quantities.$specificationId" => ['required', 'numeric', 'min:0.1'],
    //         'product_status' => ['required', 'numeric'],
    //     ]);


    //     $user = Auth::guard('user')->user();

    //     $quantity = $this->quantities[$specificationId];
    //     $productkg = ProductSpecification::find($specificationId);
    //     $inventory = Inventory::where('product_id', $productkg->product_id)->first();
    //     $selectc = ProductSpecification::where('product_id', $productkg->product_id)->get();

    //     $totalQuantity = 0;

    //     foreach ($selectc as $item) {
    //         // Sum the quantities for the specific product specification in the cart
    //         $totalQuantity += CartItem::where('product_specification_id', $item->id)->sum('overall_kg');
    //     }

    //     try {
    //         $cart = Cart::firstOrCreate(
    //             ['user_id' => $user->id],
    //             ['cart_total' => 0, 'overall_cartKG' => 0, 'total_price' => 0]
    //         );

    //         $productSpecification = ProductSpecification::findOrFail($specificationId);

    //         $cartItem = CartItem::firstOrNew(
    //             [
    //                 'cart_id' => $cart->id,
    //                 'product_specification_id' => $productSpecification->id,
    //             ]
    //         );

    //         $cartItem->quantity = $cartItem->exists ? $cartItem->quantity + $quantity : $quantity;

    //         if(($this->productTotalStock[$specificationId] >= $cartItem->quantity) && $this->productTotalStock[$specificationId] >= $totalQuantity)  {
    //             $cartItem->price = $productSpecification->product_price * $cartItem->quantity;
    //             $cartItem->overall_kg = $productSpecification->product_kg * $cartItem->quantity;
    //             $cartItem->product_status = $this->product_status;
    //             $cartItem->save();
    //             $cart->cart_total = $cart->cartItems()->sum('quantity');
    //             $cart->overall_cartKG = $cart->cartItems()->sum('overall_kg');
    //             $cart->total_price = $cart->cartItems()->sum('price');
    //             $cart->save();

    //             session()->flash('message', 'Product added to cart successfully!');
    //         } else {
    //             session()->flash('error', 'Unable to add selected quantity to cart as it would exceed your purchase limit.');
    //         }

    //     } catch (\Exception $e) {
    //         session()->flash('error', 'Error occurred while adding the product to the cart.');
    //     }
    // }

    // public function render()
    // {
    //     return view('livewire.product-view', [
    //         'product' => $this->product,
    //        'specifications' => $this->product->productSpecification()->paginate(5),
    //     ]);
    // }


        // $productkg = ProductSpecification::find($specificationId);
        // $inventory = Inventory::where('product_id', $productkg->product_id)->first();

        // dd([
        //     'quantities' => $inventory->product_total_stock,
        // ]);
