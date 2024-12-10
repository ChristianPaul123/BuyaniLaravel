<div>
    <section>
    <div class="row mt-3">
        <div class="col-12">
            <h4>Farmer Address</h4>

            <!-- Address Display -->
            @if(!$editing && $address)
                <div>
                    <p><strong>Name:</strong> {{ $address->shipping_name }}</p>
                    <p><strong>House Number:</strong> {{ $address->house_number }}</p>
                    <p><strong>Street:</strong> {{ $address->street }}</p>
                    <p><strong>City:</strong> {{ $address->city }}</p>
                    <p><strong>State:</strong> {{ $address->state }}</p>
                    <p><strong>Country:</strong> {{ $address->country }}</p>
                    <p><strong>Barangay:</strong> {{ $address->barangay }}</p>
                    <p><strong>ZIP Code:</strong> {{ $address->zip_code }}</p>
                </div>
                <button class="btn btn-primary mt-3" wire:click="toggleEdit">Edit Address</button>
            @elseif(!$editing && !$address)
                <p>No address available.</p>
                <button class="btn btn-primary mt-3" wire:click="toggleEdit">Add Address</button>
            @endif

            <!-- Address Form -->
            @if($editing)
                <form wire:submit.prevent="saveAddress">
                    <div class="row">
                        <!-- Shipping Name -->
                        <div class="col-md-6 mb-3">
                            <label for="shippingName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="shippingName" wire:model="shipping_name" placeholder="Enter Name">
                            @error('shipping_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- House Number -->
                        <div class="col-md-6 mb-3">
                            <label for="houseNumber" class="form-label">House Number</label>
                            <input type="text" class="form-control" id="houseNumber" wire:model="house_number" placeholder="Enter House Number">
                            @error('house_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <!-- Street -->
                        <div class="col-md-6 mb-3">
                            <label for="street" class="form-label">Street</label>
                            <input type="text" class="form-control" id="street" wire:model="street" placeholder="Enter Street Name">
                            @error('street') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!-- City -->
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" wire:model="city" placeholder="Enter City">
                            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <!-- State -->
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" wire:model="state" placeholder="Enter State">
                            @error('state') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!-- Country -->
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" id="country" wire:model="country" placeholder="Enter Country">
                            @error('country') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        {{-- Barangay --}}
                        <div class="col-md-6 mb-3">
                            <label for="barangay" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="barangay" wire:model="barangay" placeholder="Enter Barangay">
                            @error('barangay') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!-- ZIP Code -->
                        <div class="col-md-6 mb-3">
                            <label for="zipCode" class="form-label">ZIP Code</label>
                            <input type="text" class="form-control" id="zipCode" wire:model="zip_code" placeholder="Enter ZIP Code">
                            @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Save Address</button>
                        <button type="button" class="btn btn-secondary" wire:click="toggleEdit">Cancel</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    </section>
</div>
