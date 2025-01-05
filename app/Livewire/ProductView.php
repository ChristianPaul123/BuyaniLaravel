<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use Livewire\WithPagination;
use App\Models\Inventory;
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

    public $quantities = [];
    public $productTotalStock = [];
    public $product_status;
    public $productSpecification;
    public $productId;
    public $kl = 0;

    protected $paginationTheme = 'bootstrap'; // Use Bootstrap styling for pagination

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = Product::with('category', 'subcategory', 'productSpecification', 'inventory')->findOrFail($productId);
        $this->categories = $this->product->category;
        $this->subcategories = $this->product->subcategory;
        $this->productSpecification = $this->product->productSpecification;
        $this->product_status = $this->product->product_status;
        $count = 0;

        foreach ($this->productSpecification as $specification) {
            $this->productTotalStock[$specification->id] = $specification->product->inventory->product_total_stock;

            $this->quantities[$specification->id] = ($this->productTotalStock[$specification->id] >= $specification->product_kg)
                ? $specification->product_kg
                : 0;
            // $this->quantities[$specification->id] = 1;

        }

    }

    public function incrementQuantity($specificationId)
    {
        $productkg = ProductSpecification::find($specificationId);
        if (isset($this->quantities[$specificationId]) && $this->quantities[$specificationId] < $this->productTotalStock[$specificationId]) {
            $this->quantities[$specificationId]+=$productkg->product_kg;
        }

        // $productkg = ProductSpecification::find($specificationId);
        // if (isset($this->quantities[$specificationId]) && $this->quantities[$specificationId] < $this->productTotalStock[$specificationId]) {
        //     $this->quantities[$specificationId]+=1;
        // }

    }

    public function decrementQuantity($specificationId)
    {
        $productkg = ProductSpecification::find($specificationId);

        if (isset($this->quantities[$specificationId]) && $this->quantities[$specificationId] > $productkg->product_kg) {
            $this->quantities[$specificationId]-=$productkg->product_kg;
        }

        // $productkg = ProductSpecification::find($specificationId);

        // if (isset($this->quantities[$specificationId]) && $this->quantities[$specificationId] > 1) {
        //     $this->quantities[$specificationId]-=1;
        // }
    }

    public function addToCart($specificationId)
    {

        $this->validate([
            "quantities.$specificationId" => ['required', 'numeric', 'min:0.1'],
            'product_status' => ['required', 'numeric'],
        ]);

        $user = Auth::guard('user')->user();

        $quantity = $this->quantities[$specificationId];
        $productkg = ProductSpecification::find($specificationId);
        $inventory = Inventory::where('product_id', $productkg->product_id)->first();
        $selectc = ProductSpecification::where('product_id', $productkg->product_id)->get();

        $totalQuantity = 0;

        foreach ($selectc as $item) {
            $totalQuantity += CartItem::where('product_specification_id', $item->id)->sum('overall_kg');
        }

        // try {
        //     $cart = Cart::firstOrCreate(
        //         ['user_id' => $user->id],
        //         ['cart_total' => 0, 'overall_cartKG' => 0, 'total_price' => 0]
        //     );

        //     $productSpecification = ProductSpecification::findOrFail($specificationId);

        //     $cartItem = CartItem::firstOrNew(
        //         [
        //             'cart_id' => $cart->id,
        //             'product_specification_id' => $productSpecification->id,
        //         ]
        //     );

        //     // Calculate the new total quantity
        //     $newQuantity = $cartItem->exists ? $cartItem->quantity + $quantity : $quantity;
        //     $addedToCart = $totalQuantity + $newQuantity;

        //     if (($this->productTotalStock[$specificationId] >= $newQuantity) && $addedToCart <= $this->productTotalStock[$specificationId]) {

        //         // Update only the additional quantities and recalculate the values
        //         $additionalQuantity = $quantity;
        //         $additionalWeight = $additionalQuantity * $productSpecification->product_kg;
        //         $additionalPrice = $additionalQuantity * $productSpecification->product_price;

        //         $cartItem->quantity = $newQuantity;
        //         $cartItem->overall_kg = ($cartItem->overall_kg ?? 0) + $additionalWeight;
        //         $cartItem->price = ($cartItem->price ?? 0) + $additionalPrice;
        //         $cartItem->product_status = $this->product_status;

        //         // Debugging output
        //         // dd([
        //         //     'cartQuantity' => $cartItem->quantity,
        //         //     'kg' => $productSpecification->product_kg,
        //         //     'price' => $cartItem->price,
        //         //     'overall_kg' =>  $cartItem->overall_kg,
        //         // ]);

        //         $cartItem->save();

        //         $cart->cart_total = $cart->cartItems()->sum('quantity');
        //         $cart->overall_cartKG = $cart->cartItems()->sum('overall_kg');
        //         $cart->total_price = $cart->cartItems()->sum('price');
        //         $cart->save();

        //         session()->flash('message', 'Product added to cart successfully!');
        //     } else {
        //         session()->flash('error', 'Unable to add selected quantity to cart as it would exceed your purchase limit.');
        //     }
        // } catch (\Exception $e) {
        //     session()->flash('error', 'Error occurred while adding the product to the cart.');
        // }

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

            $cartItem->quantity = $cartItem->exists ? $cartItem->quantity + $quantity : $quantity;
            $addedToCart = $totalQuantity + $cartItem->quantity;
            $selectedQuantity = 0;
            if(($this->productTotalStock[$specificationId] >= $cartItem->quantity) && $addedToCart <= $this->productTotalStock[$specificationId])  {

                if($productSpecification->product_kg < 1 && $cartItem->quantity != null) {
                    if($cartItem->quantity >= 1) {
                        $selectedQuantity = $cartItem->quantity / $productSpecification->product_kg;
                        $selectedQuantity = $selectedQuantity - 1;
                    } else {
                        $selectedQuantity = $cartItem->quantity / $productSpecification->product_kg;
                    }
                } else {
                    $selectedQuantity = $cartItem->quantity / $productSpecification->product_kg;
                }

                $cartItem->price = $productSpecification->product_price * $selectedQuantity;
                $cartItem->overall_kg = $productSpecification->product_kg * $selectedQuantity;
                $cartItem->product_status = $this->product_status;

                // dd([
                //     'cartQuantity' => $cartItem->quantity,
                //     'kg' => $productSpecification->product_kg,
                //     'quantityEquivalent' => $selectedQuantity,
                //     'price' => $cartItem->price,
                //     'overall_kg' =>  $cartItem->overall_kg,
                // ]);

                $cartItem->save();
                $cart->cart_total = $cart->cartItems()->sum('quantity');
                $cart->overall_cartKG = $cart->cartItems()->sum('overall_kg');
                $cart->total_price = $cart->cartItems()->sum('price');
                $cart->save();

                session()->flash('message', 'Product added to cart successfully!');
            } else {
                session()->flash('error', 'Unable to add selected quantity to cart as it would exceed your purchase limit.');
            }

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


        // $productkg = ProductSpecification::find($specificationId);
        // $inventory = Inventory::where('product_id', $productkg->product_id)->first();

        // dd([
        //     'quantities' => $inventory->product_total_stock,
        // ]);
