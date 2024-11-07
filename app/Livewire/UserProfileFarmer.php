<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;


class UserProfileFarmer extends Component
{

    use WithFileUploads;

    // User data and modals visibility
    public $user;
    public $showEditProfileModal = false;
    public $showChangePasswordModal = false;


    // Form fields for user profile
    public $username;
    public $email;
    public $phone_number;
    public $profile_pic;

    public $form_file;

    public $identification_front;
    public $identification_back;

    public $response;


    public function mount()
    {
        $this->user = Auth::guard('user')->user();
        //$this->form_file = $this->user->farmerforms->farmer_form;
        //$this->identification_front = $this->user->farmerforms->identification_card_front;
        //$this->identification_back = $this->user->farmerforms->identification_card_back;
        //$this->response = $this->user->farmerforms->response;
    }

    public function updated()
    {
        $this->loadUserData();
    }

    public function updatedProfilePic()
    {
        $this->loadUserData();
    }

    // Load user profile data into form fields
    public function loadUserData()
    {
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone_number = $this->user->phone_number;
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
        $this->reset(['showChangePasswordModal', 'showEditProfileModal']);
    }

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

    public function render()
    {
        return view('livewire.user-profile-farmer',[
            'user' => $this->user,
        ]);
    }
}
