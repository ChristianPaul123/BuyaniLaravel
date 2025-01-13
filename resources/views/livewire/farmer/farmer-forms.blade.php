<div>
    <section>
        <h4>Farmer's Forms</h4>

        <!-- Row 1 -->
        <div class="row">
            <!-- Farmer Form -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="contain" style="display: flex; justify-content: space-between;">
                            <h5 class="card-title">Farm Information</h5>
                            <div class="dropdown">
                                <button class="dropdown-button" onclick="toggleDropdown(this)">
                                    <i class="bi bi-question-circle"></i>
                                    <p style="opacity: 0;">A</p>
                                    List Of Valid Forms
                                    <span class="icon">&#9660;</span>
                                </button>
                                <div class="dropdown-content" style="overflow-y: auto; max-height: 200px; scrollbar-width: thin;">
                                    <a href="#">RSBSA Enrollment Form</a>
                                    <a href="#">Farmer’s Information Sheet (FIS)</a>
                                    <a href="#">Cooperative Membership Certificate</a>
                                    <a href="#">Any government form that will validate as a farmer.</a>
                                </div>
                            </div>
                        </div>
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
                        <div class="contain" style="display: flex; justify-content: space-between;">
                            <h5 class="card-title">Personal Information</h5>
                            <div class="dropdown">
                                <button class="dropdown-button g-5" onclick="toggleDropdown(this)">
                                    <i class="bi bi-question-circle"></i>
                                    <p style="opacity: 0;">A</p>
                                    List Of Valid ID
                                    <span class="icon">&#9660;</span>
                                </button>
                                <div class="dropdown-content" style="overflow-y: auto; max-height: 200px; scrollbar-width: thin;">
                                    <a href="#">Philippine Passport</a>
                                    <a href="#">Driver’s License</a>
                                    <a href="#">Unified Multi-Purpose ID (UMID)</a>
                                    <a href="#">PhilSys ID</a>
                                    <a href="#">Social Security System (SSS) ID</a>
                                    <a href="#">GSIS eCard</a>
                                    <a href="#">PRC ID</a>
                                    <a href="#">Voter’s ID</a>
                                    <a href="#">Postal ID</a>
                                    <a href="#">Senior Citizen ID</a>
                                    <a href="#">Any government ID.</a>
                                </div>
                            </div>
                        </div>

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

<script>
    function toggleDropdown(button) {
        const dropdown = button.parentElement;
        dropdown.classList.toggle('show');
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-button') && !event.target.matches('.icon')) {
            var dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(function(dropdown) {
                dropdown.classList.remove('show');
            });
        }
    }
</script>
