<div>
    <section>
    <h4>Farmer's Forms</h4>
    @include('user.includes.messageBox')
    <!-- Row 1 -->
    <div class="row">
        <!-- Farmer Form -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Farm Information</h5>
                    @if ($existing_form_image)
                        <p>
                            Current Form:
                            <a href="{{ asset($existing_form_image) }}" target="_blank">
                                <img src="{{ asset($existing_form_image) }}" class="img-thumbnail" width="100">
                            </a>
                        </p>
                    @else
                        <p>No form uploaded yet.</p>
                    @endif

                    <label for="form_image" class="form-label">Upload New Form (Image):</label>
                    <input type="file" id="form_image" wire:model="form_image" class="form-control">
                    @error('form_image') <span class="text-danger">{{ $message }}</span> @enderror

                    <p class="mt-3"><strong>Verified:</strong> {{ $form_verified ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>

        <!-- Identification Cards -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Personal Information</h5>

                    @if ($existing_identification_front)
                        <p>Front ID:
                            <a href="{{ asset($existing_identification_front) }}" target="_blank">
                                <img src="{{ asset($existing_identification_front) }}" class="img-thumbnail" width="100">
                            </a>
                        </p>
                    @else
                        <p>Front ID: Not uploaded yet.</p>
                    @endif

                    @if ($existing_identification_back)
                        <p>Back ID:
                            <a href="{{ asset($existing_identification_back) }}" target="_blank">
                                <img src="{{ asset($existing_identification_back) }}" class="img-thumbnail" width="100">
                            </a>
                        </p>
                    @else
                        <p>Back ID: Not uploaded yet.</p>
                    @endif

                    <label for="identification_front" class="form-label">Upload Front ID:</label>
                    <input type="file" id="identification_front" wire:model="identification_front" class="form-control mb-2">
                    @error('identification_front') <span class="text-danger">{{ $message }}</span> @enderror

                    <label for="identification_back" class="form-label">Upload Back ID:</label>
                    <input type="file" id="identification_back" wire:model="identification_back" class="form-control">
                    @error('identification_back') <span class="text-danger">{{ $message }}</span> @enderror

                    <p class="mt-3"><strong>Verified:</strong> {{ $id_verified ? 'Yes' : 'No' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2 -->
    <div class="row mt-4">
        <!-- Verified By -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Verified By</h5>
                    <p>{{ $verified_by ?? 'Not verified yet.' }}</p>
                </div>
            </div>
        </div>

        <!-- Admin Response -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Admin Response</h5>
                    <p>{{ $response ?? 'No response yet.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="text-center mt-4">
        <button wire:click="saveForm" wire:loading.attr="disabled" class="btn btn-primary">Save Changes</button>
    </div>
</section>
</div>

@script
<script>
    // Show the flash message popup if it exists
    const flashPopup = document.querySelector('#flashMessage');

    if (flashPopup) {
        // Display the elements and start fade-in animation
        flashPopup.style.display = 'flex';

        // Automatically hide the popup after 3 seconds
        setTimeout(() => {
            flashPopup.classList.add('hidden');

            // After animation ends, hide the elements entirely
            setTimeout(() => {
                flashPopup.style.display = 'none';
            }, 150); // Match the duration of the animation
        }, 3000); // 3 seconds
    }
</script>
@endscript
