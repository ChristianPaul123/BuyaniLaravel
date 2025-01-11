<?php

namespace App\Livewire\Consumer;

use Livewire\Component;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class ConsumerAddress extends Component
{
    public $user; // this is the user object

    public $shipping_name;
    public $house_number;
    public $street;
    public $city;
    public $state;
    public $country;

    public $barangay;
    public $zip_code;
    public $selectedAddress;

    public $showAddAddressModal = false;
    public $showViewAddressModal = false;

    public $isEditingAddress = false; // Determines if the address modal is in edit mode



    public function mount()
    {
        $this->user = Auth::guard('user')->user();
    }

    // Load user profile data into form fields
    public function showAddModal()
    {
        $this->showAddAddressModal = true;
    }
    public function showViewModal($addressId)
    {
        $this->showViewAddressModal = true;
        $address = ShippingAddress::findOrFail($addressId);

        $this->selectedAddress = $address;
        $this->shipping_name = $address->shipping_name;
        $this->house_number = $address->house_number;
        $this->street = $address->street;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->country = $address->country;
        $this->barangay = $address->barangay; // Assuming the address has a 'barangay' field
        $this->zip_code = $address->zip_code;

        $this->isEditingAddress = false; // Default to view mode
    }

    public function closeModal()
    {
         // Reset inputs and hide modal
        $this->reset(['showViewAddressModal','showAddAddressModal']);
        $this->reset(['house_number', 'street', 'city', 'state', 'country', 'barangay','zip_code', 'shipping_name']);
    }

    public function saveAddress()
    {
        $this->validate([
            'shipping_name' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
        ]);

        ShippingAddress::create([
            'house_number' => $this->house_number,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'barangay' => $this->barangay,
            'zip_code' => $this->zip_code,
            'user_id' => $this->user->id,
            'shipping_name' => $this->shipping_name,
        ]);
        session()->flash('modalmessage', 'New address added successfully.');
    }

    public function enableAddressEdit()
{
    $this->isEditingAddress = true; // Switch to edit mode
}

    // Update an existing address
    public function updateAddress($addressId)
    {
        $address = ShippingAddress::findOrFail($addressId);

        $this->validate([
            'shipping_name' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
        ]);

        $address->update([
            'shipping_name' => $this->shipping_name,
            'house_number' => $this->house_number,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'barangay' => $this->barangay, // Assuming the address has a 'barangay' field
            'country' => $this->country,
            'zip_code' => $this->zip_code,
        ]);

        session()->flash('modalmessage', 'Address updated successfully.');
        $this->isEditingAddress = false;
    }

    // Delete an address
    public function deleteAddress($addressId)
    {
        $address = ShippingAddress::findOrFail($addressId);

        if ($address->user_id === $this->user->id) {
            $address->delete();
            session()->flash('succcess', 'Address deleted successfully.');
        } else {
            session()->flash('error', 'Unauthorized action.');
        }

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.consumer.consumer-address',[
            'user' => $this->user,
            'shippingAddresses' => $this->user->shippingAddresses,
        ]);
    }
}
