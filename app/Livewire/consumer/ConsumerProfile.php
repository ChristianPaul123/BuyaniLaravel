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
    public $first_name;
    public $last_name;

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
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
    }

    public function showProfileModal()
    {
        $this->dispatch('show-modal', ['modal' => 'editProfile']);
    }

    public function showChangeModal()
    {
        $this->dispatch('show-modal', ['modal' => 'changePassword']);
    }

    public function saveProfileChanges()
    {
        $this->validate([
            'username' => 'required|string|max:255',
            'phone_number' => 'required|string|max:12',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->user->first_name = $this->first_name;
        $this->user->last_name = $this->last_name;
        $this->user->username = $this->username;
        $this->user->phone_number = $this->phone_number;

        // Handle profile picture upload if a new file is provided
        if ($this->profile_pic) {
            // Delete old profile pic if exists
            if ($this->user->profile_pic) {
                $this->deleteOldImage($this->user->profile_pic);
            }

            // Store the new image
            $profileImagePath = $this->storeImage($this->profile_pic, 'profile/' . $this->user->username);
            $this->user->profile_pic = $profileImagePath;
        }

        // Save user updates to the database
        $this->user->save();

        // Hide modals and display a success message
        session()->flash('message', 'Profile updated successfully.');
        $this->mount();
    }

    private function storeImage($image, $directory)
    {
        // Create a unique name for the uploaded file
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Use storeAs to save the file in the storage/app/public directory
        $storedPath = $image->storeAs($directory, $imageName, 'public');

        // Return the relative path to the file (for use in the database or URLs)
        return 'storage/' . $directory . '/' . $imageName;
    }

    private function deleteOldImage($path)
    {
        $fullPath = storage_path('app/public/' . $path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function render()
    {
        return view('livewire.consumer.consumer-profile', [
            'user' => $this->user,
        ]);
    }
}
