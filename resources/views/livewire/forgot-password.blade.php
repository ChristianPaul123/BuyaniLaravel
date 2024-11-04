<div>   <!-- Step 1: Request OTP Form -->
    @if(!$showOtpModal && !$showPasswordResetForm)
        <form wire:submit.prevent="requestOtp">
            <div class="form-group">
                <label for="email">Enter your registered email</label>
                <input type="email" id="email" wire:model="email" class="form-control" placeholder="Email">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Send OTP</button>
        </form>
    @endif

    <!-- Step 2: OTP Verification Modal -->
    @if($showOtpModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Verify OTP</h5>
                        <button type="button" class="close" wire:click="$set('showOtpModal', false)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="verifyOtp">
                            <div class="form-group">
                                <label for="otp">OTP</label>
                                <input type="text" id="otp" wire:model="otp" class="form-control" placeholder="Enter OTP">
                                @error('otp') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Verify OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Step 3: Reset Password Form -->
    @if($showPasswordResetForm)
        <form wire:submit.prevent="resetPassword">
            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" id="newPassword" wire:model="newPassword" class="form-control" placeholder="New Password">
                @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="newPasswordConfirmation">Confirm New Password</label>
                <input type="password" id="newPasswordConfirmation" wire:model="newPasswordConfirmation" class="form-control" placeholder="Confirm New Password">
                @error('newPasswordConfirmation') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    @endif
</div>
</div>
