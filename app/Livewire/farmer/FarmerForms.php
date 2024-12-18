<?php

namespace App\Livewire\Farmer;

use Livewire\Component;
use App\Models\FarmerForm;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class FarmerForms extends Component
{
    use WithFileUploads;


    public $form_image; // New farmer form image
    public $identification_front; // New front ID image
    public $identification_back; // New back ID image

    public $response; // Admin response
    public $verified_by; // Admin who verified the form
    public $form_verified; // Whether the form is verified
    public $id_verified; // Whether the ID is verified

    public $existing_form_image; // Existing farmer form image
    public $existing_identification_front; // Existing front ID image
    public $existing_identification_back; // Existing back ID image

    public function mount()
    {
        $user = Auth::guard('user')->user();

        // Load existing farmer form data (if exists)
        if ($user->farmerforms->isNotEmpty()) {
            $form = $user->farmerforms->first();
            $this->existing_form_image = $form->farmer_form;
            $this->existing_identification_front = $form->identification_card_front;
            $this->existing_identification_back = $form->identification_card_back;
            $this->form_verified = $form->form_verified;
            $this->id_verified = $form->id_verified;
            $this->verified_by = $form->verified_by;
            $this->response = $form->response;
        }
    }

    public function saveForm()
    {
        $validatedData = $this->validate([
            'form_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'identification_front' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'identification_back' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);



        $user = Auth::guard('user')->user();

        $form = FarmerForm::firstOrCreate(['user_id' => $user->id]);

        // Save farmer form image in the user's folder
        if ($this->form_image) {
            // Delete the old image if it exists
            if ($this->existing_form_image) {
                $this->deleteOldImage($this->existing_form_image);
            }
            $formImagePath = $this->storeImage($this->form_image, 'img/farmer_forms/' . $user->username);
            $form->farmer_form = $formImagePath;
           // $this->existing_form_image = $formImagePath; // Update existing file for display
        }

        // Save identification front image in the user's folder
        if ($this->identification_front) {
            // Delete the old image if it exists
            if ($this->existing_identification_front) {
                $this->deleteOldImage($this->existing_identification_front);
            }
            $frontImagePath = $this->storeImage($this->identification_front, 'img/identification_card/' . $user->username);
            $form->identification_card_front = $frontImagePath;

        }

        // Save identification back image in the user's folder
        if ($this->identification_back) {
            // Delete the old image if it exists
            if ($this->existing_identification_back) {
                $this->deleteOldImage($this->existing_identification_back);
            }
            $backImagePath = $this->storeImage($this->identification_back, 'img/identification_card/' . $user->username);
            $form->identification_card_back = $backImagePath;

        }
        // Save the form data
        $form->save();

        session()->flash('message', 'Form and Identification updated successfully.');

         // Reset input fields
        $this->reset(['form_image','identification_front','identification_back']);
        $this->mount(); // Reload the component
    }

    private function storeImage($image, $directory)
    {
        // Define the storage directory in the public folder
        $imagePath = $directory;

        // Ensure the directory exists
        if (!file_exists(public_path($directory))) {
            mkdir(public_path($directory), 0755, true);
        }

        // Create a unique name for the uploaded file
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Use storeAs to save the file
        $storedPath = $image->storeAs($imagePath, $imageName, 'public_uploads');

        // Return the relative path to store in the database
        return $storedPath;
    }

    private function deleteOldImage($path)
    {
        // Check if the file exists in the public directory and delete it
        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }



    public function render()
    {
        return view('livewire.farmer.farmer-forms', [
        ]);
    }

    public function updatedQ() {
        $this->resetPage();
    }
}
