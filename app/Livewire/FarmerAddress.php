<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class FarmerAddress extends Component
{
    public $user;
    public $address; // Current address
    public $editing = false; // Controls whether the form is editable

    // Address form fields
    public $shipping_name;
    public $house_number;
    public $street;
    public $city;
    public $state;
    public $country;
    public $zip_code;

    public function mount()
    {
        $this->user = Auth::guard('user')->user();
        $this->loadAddress();
    }

    public function loadAddress()
    {
        $this->address = $this->user->shippingAddresses->first();

        if ($this->address) {
            // Populate the form fields with the existing address
            $this->shipping_name = $this->address->shipping_name;
            $this->house_number = $this->address->house_number;
            $this->street = $this->address->street;
            $this->city = $this->address->city;
            $this->state = $this->address->state;
            $this->country = $this->address->country;
            $this->zip_code = $this->address->zip_code;
        }
    }

    // Toggle editing mode
    public function toggleEdit()
    {
        $this->editing = !$this->editing;

        // If canceling edit, reload the address data
        if (!$this->editing) {
            $this->loadAddress();
        }
    }

    // Save or update the address
    public function saveAddress()
    {
        $this->validate([
            'shipping_name' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
        ]);

        if ($this->address) {
            // Update the existing address
            $this->address->update([
                'shipping_name' => $this->shipping_name,
                'house_number' => $this->house_number,
                'street' => $this->street,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'zip_code' => $this->zip_code,
            ]);
        } else {
            // Create a new address
            $this->address = ShippingAddress::create([
                'user_id' => $this->user->id,
                'shipping_name' => $this->shipping_name,
                'house_number' => $this->house_number,
                'street' => $this->street,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'zip_code' => $this->zip_code,
            ]);
        }

        // Exit editing mode and reload address
        $this->editing = false;
        $this->loadAddress();

        session()->flash('message', 'Address saved successfully.');
    }
    public function render()
    {
        return view('livewire.farmer-address');
    }
}
