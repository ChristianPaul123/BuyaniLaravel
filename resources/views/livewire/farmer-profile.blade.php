<div>
    <section>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Picture and Basic Info -->
                        <div class="col-md-6 col-sm-12 text-center">
                            <h3 class="mt-3">Farmer</h3>
                            <p class="text-muted">Profile Picture</p>
                            <h6 class="mt-3">{{ $user->username }}</h3>
                            <img src="{{ asset($user->profile_pic) }}" alt="Profile Picture" class="profile-pic rounded-circle" width="150px" height="auto">
                            {{-- <img src="{{ Storage::url($user->profile_pic) }}" alt="Profile Picture" class="profile-pic rounded-circle" width="150px" height="auto"> --}}
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
    </section>
</div>
