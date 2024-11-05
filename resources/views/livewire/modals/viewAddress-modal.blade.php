<div class="modal fade" id="viewAddressModal" tabindex="-1" aria-labelledby="viewAddressModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewAddressModalLabel">View Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Address Name</label>
                            <p class="form-control-plaintext">{{ $address_name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">House Number</label>
                            <p class="form-control-plaintext">{{ $house_number }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Street</label>
                            <p class="form-control-plaintext">{{ $street }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <p class="form-control-plaintext">{{ $city }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <p class="form-control-plaintext">{{ $state }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <p class="form-control-plaintext">{{ $country }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Zip Code</label>
                            <p class="form-control-plaintext">{{ $zip_code }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click="editAddress">Edit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
