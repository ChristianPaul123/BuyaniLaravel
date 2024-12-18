<?php

namespace App\Livewire\Consumer;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class ConsumerProfile extends Component
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
            'phone_number' => 'required|string|max:12',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->user->username = $this->username;
        $this->user->phone_number = $this->phone_number;

        // Handle profile picture upload if a new file is provided
        if ($this->profile_pic) {
            // Define the directory path in the public folder
            $imagePath = public_path('img/profile');

            // Ensure the directory exists
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }

            // Create a unique name for the uploaded file
            $imageName = time() . '.' . $this->profile_pic->getClientOriginalExtension();

            // Save the uploaded file to the public/img/profile directory
            $this->profile_pic->storeAs('img/profile', $imageName, 'public_uploads');

            // Update the user's profile picture path
            $this->user->profile_pic = 'img/profile/' . $imageName;
        }

        // Save user updates to the database
        $this->user->save();

        // Hide modals and display a success message
        $this->closeModal();
        session()->flash('message', 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.consumer.consumer-profile',[
        'user' => $this->user,]);
    }
}
