<div>
    <section>
    <!-- Display Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success mx-3 my-2 px-3 py-2">
            <button type="button" class="close btn btn-success">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('message') }}
        </div>
    @endif

    <!-- Display Validation Errors -->
    @if ($errors->any())
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
    @endif

    <div class="row mt-3">
        <div class="col-12">
            <h4>Shipping Addresses</h4>
            <div class="row">
                <!-- Loop through Shipping Addresses -->
                @foreach ($shippingAddresses as $address)
                    <div wire:key="{{ $address->id }}" class="col-md-12">
                        <div class="card mb-3 shadow-sm">
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

            <!-- Add New Address Button -->
            <div class="text-end mt-3">
                <button class="btn btn-primary" wire:click="showAddModal()">Add New Address</button>
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
                    @if (session()->has('modalmessage'))
                    <div class="alert alert-success alert-dismissible fade show mx-3 my-2 px-3 py-3" role="alert">
                        {{ session('modalmessage') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
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
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" placeholder="State" wire:model="state">
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
                    @if (session()->has('modalmessage'))
                    <div class="alert alert-success alert-dismissible fade show mx-3 my-2 px-3 py-3" role="alert">
                        {{ session('modalmessage') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
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
                                <label class="form-label">State</label>
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

    <section>
</div>