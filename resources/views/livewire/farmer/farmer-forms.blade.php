<div>
    <section>
        <h4>Farmer's Forms</h4>

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
                        <input type="file" id="form_image" wire:model="form_image" class="form-control" onchange="validateFileSize(this)">
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
                        <input type="file" id="identification_front" wire:model="identification_front" class="form-control mb-2" onchange="validateFileSize(this)">
                        @error('identification_front') <span class="text-danger">{{ $message }}</span> @enderror

                        <label for="identification_back" class="form-label">Upload Back ID:</label>
                        <input type="file" id="identification_back" wire:model="identification_back" class="form-control" onchange="validateFileSize(this)">
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
    </div>

    <!-- Save Button -->
    @if($user->is_verified)
    @else
    <div class="text-center mt-4">
        <button wire:click="saveForm" wire:loading.attr="disabled" class="btn btn-primary">Save Changes</button>
    </div>
    @endif


</section>
</div>

<script>
    function validateFileSize(input) {
        const file = input.files[0];
        if (file && file.size > 2048 * 1024) { // 2048 KB in bytes (2 MB) // 2MB in bytes
            alert('File size must not exceed 2MB.');
            input.value = ''; // Clear the input
        }
    }
</script>
