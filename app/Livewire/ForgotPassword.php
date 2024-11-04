<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\OtpVerify;
use Illuminate\Support\Facades\Hash;

class ForgotPassword extends Component
{

    public $email;
    public $otp;
    public $newPassword;
    public $newPasswordConfirmation;
    public $showOtpModal = false;
    public $showPasswordResetForm = false;

    public function requestOtp()
    {
        // Validate email input
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generate a new OTP and expiration time
        $otp = rand(100000, 999999);
        $expiryTime = now()->addMinutes(5);

        // Store OTP in database for password reset purpose
        OtpVerify::updateOrCreate(
            [
                'email' => $this->email,
                'v_purpose' => 'password_reset',
            ],
            [
                'otp' => $otp,
                'otp_expiry' => $expiryTime,
                'is_verified' => false,
                'updated_at' => now(),
            ]
        );

        // Open OTP modal
        $this->showOtpModal = true;
        session()->flash('message', 'A password reset OTP has been sent to your email.');
    }

    public function verifyOtp()
    {
        // Validate OTP input
        $this->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        // Retrieve the OTP record
        $otpRecord = OtpVerify::where('email', $this->email)
            ->where('v_purpose', 'password_reset')
            ->where('is_verified', false)
            ->where('otp_expiry', '>', now())
            ->latest()
            ->first();

        // Check OTP validity
        if ($otpRecord && $otpRecord->otp == $this->otp) {
            $otpRecord->update(['is_verified' => true]);
            $this->showOtpModal = false;
            $this->showPasswordResetForm = true;
        } else {
            session()->flash('error', 'Invalid or expired OTP. Please try again.');
        }
    }

    public function resetPassword()
    {
        // Validate new password input
        $this->validate([
            'newPassword' => 'required|min:8|confirmed',
        ]);

        // Update the user's password
        $user = User::where('email', $this->email)->first();
        if ($user) {
            $user->password = bcrypt($this->newPassword);
            $user->save();

            // Flash success message and redirect
            session()->flash('message', 'Password has been reset successfully.');
            return redirect()->route('user.login');
        } else {
            session()->flash('error', 'User not found. Please try again.');
        }
    }
    public function render()
    {
        return view('livewire.forgot-password');
    }
}
