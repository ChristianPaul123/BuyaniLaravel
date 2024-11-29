<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartCheckout extends Component
{

    public $user;
    public $cartId;
    public $shippingAddresses = [];
    public $selectedAddress = null;
    public $shippingInfo = [
        'name' => '',
        'phone' => '',
        'email' => '',
        'city' => '',
        'state' => '',
        'zip_code' => '',
        'street' => '',
        'country' => '',
        'house_number' => '',
    ];
    public $cartItems = [];
    public $totalPrice = 0;
    public $totalWeight = 0.0;

    public $orderNumber;
    public $totalCart = 0;
    public $paymentMethod = null;

    public function mount($cartId)
    {
        $this->user = Auth::guard('user')->user();
        $this->cartId = $cartId;
        $this->shippingAddresses = $this->user->shippingAddresses;
        $this->loadCartItems();
    }

    public function loadCartItems()
    {
        $cart = Cart::with('cartItems.product_specification.product')->findOrFail($this->cartId);
        $this->cartItems = collect($cart->cartItems);

        // Calculate total price
        $this->totalPrice = $this->cartItems->sum(fn($item) => $item->price);
        $this->totalWeight = $this->cartItems->sum(fn($item) => $item->overall_kg);
        $this->totalCart = $cart->cart_total;
    }

    public function confirmSelectedAddress($address)
    {
            $address = ShippingAddress::find($this->selectedAddress);
            if ($address) {
                $this->shippingInfo = [
                    'name' => $this->user->username,
                    'phone' => $this->user->phone_number,
                    'email' => $this->user->email,
                    'street' => $address->street,
                    'city' => $address->city,
                    'state' => $address->state,
                    'zip_code' => $address->zip_code,
                    'country' => $address->country,
                    'house_number' => $address->house_number,
                ];
            }
    }


    public function processCheckout()
    {
        $this->validate([
            'shippingInfo.name' => 'required|string|max:255',
            'shippingInfo.phone' => 'required|string|max:15',
            'shippingInfo.city' => 'required|string|max:255',
            'shippingInfo.state' => 'required|string|max:255',
            'shippingInfo.zip_code' => 'required|string|max:10',
            'shippingInfo.street' => 'required|string|max:255',
            'shippingInfo.email' => 'required|email|max:255',
            'shippingInfo.country' => 'required|string|max:255',
            'shippingInfo.house_number'=>'required|string|max:255',
            'paymentMethod' => 'required|in:COD,GCash',
        ]);

        $orderNumber = 'ORD-' . strtoupper(uniqid());
        $this->orderNumber = $orderNumber;

        try {
            // Start transaction to ensure atomicity
            DB::beginTransaction();
        // Create Order
                $order = Order::create([
                    'user_id' => $this->user->id,
                    'total_amount' => $this->totalCart,
                    'overall_orderKG' => $this->totalWeight,
                    'order_number' => $this->orderNumber,
                    'total_price' => $this->totalPrice,
                    'order_type' => 1,
                    'order_status' => Order::STATUS_STANDBY,
                    'customer_name' => $this->shippingInfo['name'],
                    'customer_phone' => $this->shippingInfo['phone'],
                    'customer_city' => $this->shippingInfo['city'],
                    'customer_state' => $this->shippingInfo['state'],
                    'customer_zip' => $this->shippingInfo['zip_code'],
                    'customer_street' => $this->shippingInfo['street'],
                    'customer_email' => $this->shippingInfo['email'],
                    'customer_house_number' => $this->shippingInfo['house_number'],
                    'customer_country' => $this->shippingInfo['country'],
                ]);

                // Transfer Cart Items to Order Items
                foreach ($this->cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_specification_id' => $item->product_specification_id,
                        'product_id' => $item->product_specification->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'overall_kg' => $item->overall_kg,
                    ]);
                }

                // Create Payment Entry
                Payment::create([
                    'order_id' => $order->id,
                    'payment_amount' => $this->totalPrice,
                    'payment_method' => $this->paymentMethod,
                    'payment_status' => 0,
                ]);

                // Reset Cart totals
                $cart = Cart::findOrFail($this->cartId);
                $cart->update([
                    'cart_total' => 0,
                    'overall_cartKG' => 0,
                    'total_price' => 0,
                ]);

                // Delete Cart Items
                $cart->cartItems()->delete();

                DB::commit();

                session()->flash('message', 'Order placed successfully!');
                return redirect()->route('user.consumer.order');

            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'There was an error processing your order: ' . $e->getMessage());
            }
    }



    public function render()
    {
        return view('livewire.cart-checkout');
    }
}
