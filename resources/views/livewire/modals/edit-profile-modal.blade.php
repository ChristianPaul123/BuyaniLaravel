<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="resetInputFields"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updateProfile">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nameInput" wire:model="username">
                    </div>
                    <div class="mb-3 text-center">
                        @if ($profile_pic)
                            <img src="{{ $profile_pic->temporaryUrl() }}" alt="Profile Picture Preview" class="profile-pic-preview" width="40px" height="auto">
                        @else
                            <img src="{{ asset($user->profile_pic) }}" alt="Current Profile Picture" class="profile-pic-preview" width="40px" height="auto">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="profilePic" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profilePic" wire:model="profile_pic">
                    </div>
                    <div class="mb-3">
                        <label for="phoneInput" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phoneInput" wire:model="phone_number">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetInputFields">Close</button>
                <button type="button" class="btn btn-primary" wire:click="saveProfileChanges">Save Changes</button>
            </div>
        </div>
    </div>
</div>
