<?php

namespace App\Livewire\Farmer;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class FarmerProfile extends Component
{
    use WithFileUploads;

    public $user;
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
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $this->user->username = $this->username;
        $this->user->phone_number = $this->phone_number;

        // Handle profile picture upload if a new file is provided
        if ($this->profile_pic) {
            // Delete old profile pic if exists
            if ($this->user->profile_pic) {
                $this->deleteOldImage($this->user->profile_pic);
            }

            // Store the new image
            $profileImagePath = $this->storeImage($this->profile_pic, 'img/profile/'. $this->user->username);
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
        // Ensure the directory exists
        if (!file_exists(public_path($directory))) {
            mkdir(public_path($directory), 0755, true);
        }

        // Create a unique name for the uploaded file
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Use storeAs to save the file
        $storedPath = $image->storeAs($directory, $imageName, 'public_uploads');

        return $storedPath;
    }

    private function deleteOldImage($path)
    {
        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function render()
    {
        return view('livewire.farmer.farmer-profile');
    }


    // DUMPS
    // public $showEditProfileModal = false;
    // public $showChangePasswordModal = false;

            // $this->closeModal();


                // #[On('hide-modal')]
    // public function closeModal()
    // {
    //      // Reset inputs and hide modal
    //     $this->reset(['showChangeModal', 'showProfileModal']);
    // }

}
