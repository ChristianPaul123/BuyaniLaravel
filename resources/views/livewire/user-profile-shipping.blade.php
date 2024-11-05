<div>
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

    <div class="container my-5 pb-5">
        <ul class="nav nav-tabs" id="profileTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="user-info-tab" data-bs-toggle="tab" data-bs-target="#user-info" type="button" role="tab" aria-controls="user-info" aria-selected="true">
                    User Information
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="shipping-address-tab" data-bs-toggle="tab" data-bs-target="#shipping-address" type="button" role="tab" aria-controls="shipping-address" aria-selected="false">
                    Shipping Address
                </button>
            </li>
        </ul>

        <div class="tab-content" id="profileTabContent">
            <!-- User Information Tab -->
            <div class="tab-pane fade show active" id="user-info" role="tabpanel" aria-labelledby="user-info-tab">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Profile Picture and Basic Info -->
                                    <div class="col-md-6 col-sm-12 text-center">
                                        <h3 class="mt-3">{{ $user->username }}</h3>
                                        <img src="{{ Storage::url($user->profile_pic) }}" alt="Profile Picture" class="profile-pic rounded-circle" width="150px" height="auto">
                                        <p class="text-muted">{{ $user->email }}</p>
                                        <button class="btn btn-primary mt-2" wire:click="showProfileModal()">Edit Profile</button>
                                        <button class="btn btn-secondary mt-2" wire:click="showChangeModal()">Change Password</button>
                                    </div>

                                    <!-- Personal Information List -->
                                    <div class="col-md-6 col-sm-12">
                                        <div class="profile-section mt-4 mt-md-0">
                                            <h4>Personal Information</h4>
                                            <ul class="list-group mb-3">
                                                <li class="list-group-item">Name: {{ $user->username }}</li>
                                                <li class="list-group-item">Email: {{ $user->email }}</li>
                                                <li class="list-group-item">Phone: {{ $user->phone_number }}</li>
                                                <li class="list-group-item">Status: {{ $user->user_status }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Address Tab -->
            <div class="tab-pane fade" id="shipping-address" role="tabpanel" aria-labelledby="shipping-address-tab">
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
            </div>
        </div>
    </div>

    <!-- Modals for Profile and Address --check -->
    ///////////////////////////////////////////////
    @if($showEditProfileModal)
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
        @if (session('message'))
        <div class="alert alert-success text-center my-3 d-block col-12 mt-5">
            {{ session('message') }}
        </div>
        @endif
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    {{-- <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateProfile">
                        <div class="mb-3">
                            <label for="nameInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="nameInput" wire:model="username">
                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3 text-center">
                            @if ($profile_pic)
                                <img src="{{ $profile_pic->temporaryUrl() }}" alt="Profile Picture Preview" class="profile-pic-preview" width="40px" height="auto">
                            @else
                                <img src="{{ asset($user->profile_pic) }}" alt="Current Profile Picture" class="profile-pic-preview" width="40px" height="auto">
                            @endif
                        </div>

                        <div wire:loading wire:target="profile_pic">
                            <p class="text-center">Uploading...</p>
                        </div>

                        <div class="mb-3">
                            <label for="profilePic" class="form-label">Profile Picture</label>
                            <input type="file" accept="image/png, image/jpeg, image/jpg" class="form-control" id="profilePic" wire:model="profile_pic">
                            @error('profile_pic') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phoneInput" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phoneInput" wire:model="phone_number">
                            @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal()">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="saveProfileChanges()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
@endif

@if($showChangePasswordModal)
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
        @if (session('message'))
        <div class="alert alert-success text-center my-3 d-block col-12 mt-5">
            {{ session('message') }}
        </div>
        @endif
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    {{-- <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="changePassword" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="currentPassword" wire:model="current_password" required>
                            @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" wire:model="new_password" required>
                            @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" wire:model="confirm_password" required>
                            @error('confirm_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal()">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="changePassword">Change Password</button>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- check --}}

@if($showAddAddressModal)
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
        @if (session('message'))
        <div class="alert alert-success text-center my-3 d-block col-12 mt-5">
            {{ session('message') }}
        </div>
        @endif
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Address</h5>
                    {{-- <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
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
                    {{-- <button type="button" class="close" wire:click="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
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
</div>
