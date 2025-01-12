<div>
    <h4 class="shipping-title text-center">Shipping Addresses</h4>
    <section class="shipping-container">
    <!-- Display Success Message -->
    {{-- @if (session()->has('message'))
        <div class="alert alert-success mx-3 my-2 px-3 py-2">
            <button type="button" class="close btn btn-success">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('message') }}
        </div>
    @endif --}}

    <!-- Display Validation Errors -->
    {{-- @if ($errors->any())
        <div class="alert alert-danger mx-3 my-2 px-3 py-2">
            <button type="button" class="close btn btn-danger">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div class="row mt-3">
        <div class="col-12">

            <div class="row">
                <!-- Loop through Shipping Addresses -->
                @foreach ($shippingAddresses as $address)
                    <div wire:key="{{ $address->id }}" class="col-md-12">
                        <div class="card mb-3 shadow-sm shipping-info">
                            <div class="card-body d-flex flex-row justify-content-between align-items-center">
                                <div class="d-flex flex-column col-md-6">
                                    <h5 class="card-title">{{ $address->shipping_name }}</h5>
                                    <p class="card-text">{{ $address->shipping_address }}</p>
                                    </div>
                                <div class="d-flex flex-column col-md-6">
                                    <button class="btn btn-outline-primary" wire:click="showViewModal({{ $address->id }})">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>



    @if($showAddAddressModal)
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Address</h5>
                </div>
                <div class="modal-body">
                    @include('user.includes.successBox')

                    <form wire:submit.prevent="addAddress">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="addressName" class="form-label">Address Name</label>
                                    <input type="text" class="form-control" id="addressName" placeholder="e.g., Home, Office" wire:model="shipping_name">
                                    @error('shipping_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="houseNumber" class="form-label">House Number</label>
                                    <input type="text" class="form-control" id="houseNumber" placeholder="House Number" wire:model="house_number">
                                    @error('house_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="street" class="form-label">Street</label>
                                    <input type="text" class="form-control" id="street" placeholder="Street" wire:model="street">
                                    @error('street') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" placeholder="City" wire:model="city">
                                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="barangay" class="form-label">Barangay</label>
                                    <input type="text" class="form-control" id="barangay" placeholder="barangay" wire:model="barangay">
                                    @error('barangay') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="state" class="form-label">Province</label>
                                    <input type="text" class="form-control" id="state" placeholder="Province" wire:model="state">
                                    @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" placeholder="Country" wire:model="country">
                                    @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="zipCode" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zipCode" placeholder="Zip Code" wire:model="zip_code">
                                    @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal()">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="saveAddress">Save Address</button>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- check --}}

@if($showViewAddressModal)
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Address</h5>
                </div>
                <div class="modal-body">
                    @include('user.includes.successBox')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address Name</label>
                                @if($isEditingAddress)
                                    <input type="text" class="form-control" wire:model="shipping_name">
                                    @error('shipping_name') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                    <p class="form-control-plaintext">{{ $shipping_name }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">House Number</label>
                                @if($isEditingAddress)
                                    <input type="text" class="form-control" wire:model="house_number">
                                    @error('house_number') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                <p class="form-control-plaintext">{{ $house_number }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Street</label>
                                @if($isEditingAddress)
                                    <input type="text" class="form-control" wire:model="street">
                                    @error('street') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                <p class="form-control-plaintext">{{ $street }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">City</label>
                                @if($isEditingAddress)
                                    <input type="text" class="form-control" wire:model="city">
                                    @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                <p class="form-control-plaintext">{{ $city }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Province</label>
                                @if($isEditingAddress)
                                    <input type="text" class="form-control" wire:model="state">
                                    @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                <p class="form-control-plaintext">{{ $state }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                @if($isEditingAddress)
                                    <input type="text" class="form-control" wire:model="country">
                                    @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                <p class="form-control-plaintext">{{ $country }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Barangay</label>
                                @if($isEditingAddress)
                                    <input type="text" class="form-control" wire:model="barangay">
                                    @error('barangay') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                <p class="form-control-plaintext">{{ $barangay }}</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Zip Code</label>
                                @if($isEditingAddress)
                                    <input type="text" class="form-control" wire:model="zip_code">
                                    @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                                @else
                                <p class="form-control-plaintext">{{ $zip_code }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if($isEditingAddress)
                    <button type="button" class="btn btn-primary" wire:click="updateAddress({{ $selectedAddress->id }})">Save Changes</button>
                    @else
                    <button type="button" class="btn btn-secondary" wire:click="enableAddressEdit()">Edit</button>
                    @endif
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        onclick="if (confirm('Are you sure you want to delete this address?')) @this.deleteAddress({{ $address->id }})">
                        Delete
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif

</section>

        <!-- Add New Address Button -->
        <div class="text-end mt-3">
            <button class="btn btn-primary" wire:click="showAddModal()">Add New Address</button>
        </div>
</div>

@script
{{-- <script>
    function updateLocationOptions() {
        const locationType = document.getElementById('locationType').value;
        const locationDropdown = document.getElementById('location');

        // Clear current options
        locationDropdown.innerHTML = '<option selected>Select a location</option>';

        if (locationType) {
            // Example API endpoint for GeoDB Cities (replace with your own API)
            fetch('https://wft-geo-db.p.rapidapi.com/v1/geo/cities?countryCode=US', {
                    method: 'GET',
                    headers: {
                        'X-RapidAPI-Host': 'wft-geo-db.p.rapidapi.com',
                        'X-RapidAPI-Key': 'YOUR_RAPIDAPI_KEY'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const cities = data.data; // Adjust based on API response
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city.city; // Adjust based on API response
                        option.textContent = city.city; // Adjust based on API response
                        locationDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching cities:', error));
        }
    }

    // Attach the event listener
    document.getElementById('locationType').addEventListener('change', updateLocationOptions);
</script> --}}
@endscript
