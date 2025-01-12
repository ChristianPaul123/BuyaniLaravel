<?php

namespace App\Livewire\Farmer;

use Livewire\Component;
use App\Models\FarmerForm;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
    public $user;

    public function mount()
    {
        $user = Auth::guard('user')->user();

        $this->user = $user; // Assign the user to the component property

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
            $this->handleImageUpload(
                $this->form_image,
                $form->farmer_form,
                'img/farmer_forms/' . $user->username,
                function ($path) use ($form) {
                    $form->farmer_form = $path;
                }
            );
        }

        // Save identification front image in the user's folder
        if ($this->identification_front) {
            $this->handleImageUpload(
                $this->identification_front,
                $form->identification_card_front,
                'img/identification_card/' . $user->username,
                function ($path) use ($form) {
                    $form->identification_card_front = $path;
                }
            );
        }

        // Save identification back image in the user's folder
        if ($this->identification_back) {
            $this->handleImageUpload(
                $this->identification_back,
                $form->identification_card_back,
                'img/identification_card/' . $user->username,
                function ($path) use ($form) {
                    $form->identification_card_back = $path;
                }
            );
        }

        // Save the form data
        $form->save();

        session()->flash('message', 'Form and Identification updated successfully.');

        // Reset input fields
        $this->reset(['form_image', 'identification_front', 'identification_back']);
        $this->mount(); // Reload the component
    }

    /**
     * Handles the image upload process, including deleting the old image if it exists,
     * storing the new image, and executing a callback to update the database field.
     *
     * @param mixed $image The new image to be uploaded.
     * @param string|null $existingImagePath The path to the existing image that should be deleted, if any.
     * @param string $directory The directory where the new image should be stored.
     * @param callable $callback A callback function to update the database field with the new image path.
     *
     * @return void
     */
    private function handleImageUpload(
        $image,
        $existingImagePath,
        $directory,
        $callback
    ) {
        // Delete the old image if it exists
        if ($existingImagePath) {
            $this->deleteOldImage($existingImagePath);
        }

        // Store the new image
        $imagePath = $this->storeImage($image, $directory);

        // Execute the callback to update the database field
        $callback($imagePath);
    }


    /**
     * Store the uploaded image in the specified directory.
     *
     * This method ensures that the directory exists, creates a unique name for the uploaded file,
     * saves the file using the storeAs method, and returns the relative path to store in the database.
     *
     * @param \Illuminate\Http\UploadedFile $image The uploaded image file.
     * @param string $directory The directory where the image should be stored.
     *
     * @return string The relative path of the stored image.
     */
    private function storeImage($image, $directory)
    {
        // Ensure the directory exists
        if (!File::exists(public_path($directory))) {
            File::makeDirectory(public_path($directory), 0755, true);
        }

        // Create a unique name for the uploaded file
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Use storeAs to save the file
        $storedPath = $image->storeAs($directory, $imageName, 'public_uploads');

        // Return the relative path to store in the database
        return $storedPath;
    }

    /**
     * Deletes an old image file from the public directory if it exists.
     *
     * @param string $path The relative path to the image file within the public directory.
     *
     * @return void
     */
    private function deleteOldImage($path)
    {
        // Check if the file exists in the public directory and delete it
        $fullPath = public_path($path);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
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
