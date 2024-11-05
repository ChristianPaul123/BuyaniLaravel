<?php

namespace App\Livewire;

use App\Mail\VerificationMail;
use App\Models\Cart;
use App\Models\User;
use Livewire\Component;
use App\Models\OtpVerify;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginUser extends Component
{

    public $username ='';
    public $email='';

    public $password='';

    public $user_type='';

    public $otp;
    public $newPassword;
    public $newPassword_confirmation='';

    public $showEmailModal = false;
    public $showOtpModal = false;
    public $showPasswordResetForm = false;



    public function mount($user_type)
    {
        $this->user_type = $user_type;
        //dd($user_type);
    }

    public function closeModal()
    {
        $this->reset(['otp', 'showEmailModal','showOtpModal','showPasswordResetForm','email', 'newPassword']);
        // Reset OTP and hide modal
    }

    public function login()
    {
        $validatedData = $this->validate([
            'email' => ['required'],
            'password' => ['required'],
            'user_type' => ['required'],
        ]);

        //dd($validatedData);

        if (Auth::guard('user')->attempt(
['email' =>$validatedData['email'],
            'password' => $validatedData['password'],
            'user_type' => $validatedData['user_type']]))
            {
            session()->regenerate();

            $user = Auth::guard('user')->user();

                if ($user->user_type == 1) {
                   Cart::firstOrCreate(
                    ['user_id' => $user->id],
                    ['cart_total' => 0, 'overall_cartKG' => 0, 'total_price' => 0]
                );
                }
                // Redirect to the appropriate dashboard based on user type
                $route = $user->user_type == 1 ? 'user.consumer' : 'user.farmer';
                return redirect()->route($route)->with('message', 'Login successful');

            } else {
                session()->flash('message', 'Invalid username or password. Please try again.');
                //$this->message = 'Invalid username or password. Please try again.';
            }
    }

    public function showModal() {
        $this->showEmailModal = true;
    }

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
        Mail::to($this->email)->send(new VerificationMail($otp));
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

            //closes the other modal and show the password reseet modal
            $this->showOtpModal = false;
            $this->showEmailModal = false;
            $this->showPasswordResetForm = true;

            session()->flash('message', 'OTP confirmed Please input your new password.');
        } else {
            session()->flash('error', 'Invalid or expired OTP. Please try again.');
        }
    }

    public function resetPassword()
    {
        // Validate new password input
        $this->validate([
           'newPassword' => ['required', 'min:8', 'max:200', 'confirmed'],
        ]);

        // Update the user's password
        $user = User::where('email', $this->email)->first();
        if ($user) {
            $user->password = bcrypt($this->newPassword);
            $user->save();

            // Flash success message and redirect
            session()->flash('message', 'Password has been reset successfully.');
            $this->reset(['otp', 'showEmailModal','showOtpModal','showPasswordResetForm','email', 'newPassword']);
            return redirect()->route('user.login', ['user_type' => $this->user_type]);
        } else {
            session()->flash('error', 'User not found. Please try again.');
        }
    }
    public function render()
    {
        return view('livewire.login-user',['message' => session('message')]);
    }
}
