<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileShipping extends Component
{
    use WithFileUploads;

    // User data and modals visibility
    public $user;
    public $showEditProfileModal = false;
    public $showChangePasswordModal = false;
    public $showAddAddressModal = false;
    public $showViewAddressModal = false;

    public $isEditingAddress = false; // Determines if the address modal is in edit mode

    // Form fields for user profile
    public $username;
    public $email;
    public $phone_number;
    public $profile_pic;

    // Form fields for shipping address
    public $shipping_name;
    public $house_number;
    public $street;
    public $city;
    public $state;
    public $country;
    public $zip_code;
    public $selectedAddress;

    public function mount()
    {
        $this->user = Auth::guard('user')->user();
        $this->loadUserData();
    }

    // Load user profile data into form fields
    public function loadUserData()
    {
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone_number = $this->user->phone_number;
    }

    // Show or hide modals
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
        $this->zip_code = $address->zip_code;

        $this->isEditingAddress = false; // Default to view mode
    }


    public function showProfileModal()
    {
        $this->showEditProfileModal = true;
    }
    public function showChangeModal()
    {
        $this->showChangePasswordModal = true;
    }

    public function closeModal()
    {
         // Reset inputs and hide modal
        $this->reset(['showChangePasswordModal', 'showEditProfileModal','showViewAddressModal','showAddAddressModal']);
        $this->reset(['house_number', 'street', 'city', 'state', 'country', 'zip_code', 'shipping_name']);
    }



    // Hide all modals

    // Save user profile changes
    public function saveProfileChanges()
    {
        $this->validate([
            'username' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->user->username = $this->username;
        $this->user->phone_number = $this->phone_number;

        // Handle profile picture upload if a new file is provided
        if ($this->profile_pic) {

            // Create a unique name and path for the new image
            $imageName = time() . '.' . $this->profile_pic->extension();
            $imagePath = 'img/profile/' . $this->username;


            // Store the uploaded file in the public directory
            $this->profile_pic->storePubliclyAs($imagePath, $imageName, 'public');

            // Update the user's profile picture path
            $this->user->profile_pic = $imagePath . '/' . $imageName;
        }


        // Save user updates to the database
        $this->user->save();

        // Hide modals and display a success message
        $this->closeModal();
        session()->flash('message', 'Profile updated successfully.');
    }

    // Add a new address for the user - check
    //////////////////////////////////////////
    public function saveAddress()
    {
        $this->validate([
            'shipping_name' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
        ]);

        ShippingAddress::create([
            'house_number' => $this->house_number,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zip_code' => $this->zip_code,
            'user_id' => $this->user->id,
            'shipping_name' => $this->shipping_name,
        ]);

        $this->closeModal();
        session()->flash('message', 'New address added successfully.');
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
            'country' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
        ]);

        $address->update([
            'shipping_name' => $this->shipping_name,
            'house_number' => $this->house_number,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zip_code' => $this->zip_code,
        ]);

        session()->flash('message', 'Address updated successfully.');
        $this->isEditingAddress = false;
        $this->closeModal();
    }

    // Delete an address
    public function deleteAddress($addressId)
    {
        $address = ShippingAddress::findOrFail($addressId);

        if ($address->user_id === $this->user->id) {
            $address->delete();
            session()->flash('message', 'Address deleted successfully.');
        } else {
            session()->flash('error', 'Unauthorized action.');
        }

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.user-profile-shipping', [
            'user' => $this->user,
            'shippingAddresses' => $this->user->shippingAddresses,
        ]);
    }
}

