<?php

namespace App\Livewire\User;

use App\Models\Cart;
use App\Models\User;
use Livewire\Component;
use App\Models\OtpVerify;
use Livewire\Attribute\On;
use App\Mail\VerificationMail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class LoginIndex extends Component
{

    public $username ='';
    public $email_phoneNum='';

    public $password='';

    public $user_type='';
    public $success;
    public $message;
    public $error;
    public $selectedEmail;

    public $otp;
    public $newPassword;
    public $newPassword_confirmation='';

    public $showEmailModal = false;
    public $showOtpModal = false;
    public $showPasswordResetForm = false;
    public $captcha = null;
    public $captchaVerify = false;




    public function mount($user_type)
    {
        $this->user_type = $user_type;
        //dd($user_type);
    }

    public function closeModal()
    {
        $this->reset(['otp', 'showEmailModal','showOtpModal','showPasswordResetForm','selectedEmail', 'newPassword']);
        // Reset OTP and hide modal
    }

    public function updatedCaptcha($token)
    {


        try {
            //#UNCOMMENT WHEN IMPLEMENTED
            // Verify the recaptcha response
            // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            //     'secret' => env('RECAPTCHA_SECRETKEY'),
            //     'response' => $token,
            //     'remoteip' => request()->ip(),
            // ]);


            // if (!json_decode($response->body(), true)['success']) {
            //     $this->captcha = 'Invalid recaptcha';
            // } else {
            // $this->captchaVerify = true;

            // };

            //this is for testing purposes #COMMENT IN PROD...
            if (app()->environment('local', 'testing')) {
                $response = ['success' => true];
                $this->captchaVerify = true;

            } else {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => env('RECAPTCHA_SECRETKEY'),
                    'response' => $token,
                    'remoteip' => request()->ip(),
                ])->json();

                // if (!json_decode($response->body(), true)['success']) {
                //         $this->captcha = 'Invalid recaptcha';
                //     } else {
                //     $this->captchaVerify = true;
                //     }
            }
        } catch (\Exception $e) {

            // Log the error or handle exceptions like SSL or network issues
            logger()->error('reCAPTCHA Verification Error: ' . $e->getMessage());

            throw ValidationException::withMessages([
                'captcha' => __('An error occurred during reCAPTCHA verification. Please try again.'),
            ]);
        }
    }
    public function showModal() {
        $this->showEmailModal = true;
    }

    public function login()
    {
            $validatedData = $this->validate([
                'email_phoneNum' => ['required','string','regex:/^(\+?\d{10,15}|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/',],
                'password' => ['required'],
                'user_type' => ['required'],
            ]);

            if ($this->captchaVerify != true) {
                $this->dispatch('sessionError', error: 'Please verify the captcha');
                return;
            }



            // Determine if the input is an email or phone number
            $loginField = filter_var($validatedData['email_phoneNum'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

            // Attempt to authenticate
            if (Auth::guard('user')->attempt([
                $loginField => $validatedData['email_phoneNum'],
                'password' => $validatedData['password'],
                'user_type' => $validatedData['user_type'],
            ])) {
                session()->regenerate();

                $user = Auth::guard('user')->user();

                // If user_type == 1 (Consumer), ensure a cart is created
                if ($user->user_type == 1) {
                    Cart::firstOrCreate(
                        ['user_id' => $user->id],
                        ['cart_total' => 0, 'overall_cartKG' => 0, 'total_price' => 0]
                    );
                }

                // Redirect to the appropriate dashboard
                $route = $user->user_type == 1 ? 'user.consumer' : 'user.farmer';
                return redirect()->route($route)->with('success', 'Login successful');
            } else {

                // dd('something went wrong');
                // $this->dispatch('sessionError', error: $error);
                $this->reset('captcha');
                session()->flash('errorpassword', 'Invalid email/phone number or password.');
            }
    }


    public function requestOtp()
    {

        // Validate email input
        $this->validate([
            'selectedEmail' => 'required|email|exists:users,email',
        ]);

        // Generate a new OTP and expiration time
        $otp = rand(100000, 999999);
        $expiryTime = now()->addMinutes(5);

        // Store OTP in database for password reset purpose
        OtpVerify::updateOrCreate(
            [
                'email' => $this->selectedEmail,
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
        $this->showEmailModal = false;
        $this->showOtpModal = true;
        Mail::to($this->selectedEmail)->send(new VerificationMail($otp));
        session()->flash('message', 'A password reset OTP has been sent to your email.');
    }

    public function verifyOtp()
    {
        // Validate OTP input
        $this->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        // Retrieve the OTP record
        $otpRecord = OtpVerify::where('email', $this->selectedEmail)
            ->where('v_purpose', 'password_reset')
            ->where('is_verified', false)
            ->where('otp_expiry', '>', now())
            ->latest()
            ->first();

        // Check OTP validity
        if ($otpRecord && $otpRecord->otp == $this->otp) {
            $otpRecord->update(['is_verified' => true]);

            //closes the other modal and show the password reset modal
            $this->showOtpModal = false;
            $this->showPasswordResetForm = true;

            session()->flash('success', 'OTP confirmed Please input your new password.');
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
        $user = User::where('email', $this->selectedEmail)->first();
        if ($user) {
            $user->password = bcrypt($this->newPassword);
            $user->save();

            // Flash success message and redirect
            session()->flash('success', 'Password has been reset successfully.');
            $this->reset(['otp', 'showEmailModal','showOtpModal','showPasswordResetForm','newPassword','selectedEmail']);
            return redirect()->route('user.login', ['user_type' => $this->user_type]);
        } else {
            session()->flash('error', 'User not found. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.user.login-index',['success' => session('success'),['message' => session('message')],['error' => session('error')]]);
    }
}


// Code dumps

    // public function requestOtp()
    // {

    //     // Validate email input
    //     $this->validate([
    //         'selectedEmail' => 'required|email|exists:users,email',
    //     ]);


    //     // Generate a new OTP and expiration time
    //     $otp = rand(100000, 999999);
    //     $expiryTime = now()->addMinutes(5);

    //     // Store OTP in database for password reset purpose
    //     OtpVerify::updateOrCreate(
    //         [
    //             'email' => $this->selectedEmail,
    //             'v_purpose' => 'password_reset',
    //         ],
    //         [
    //             'otp' => $otp,
    //             'otp_expiry' => $expiryTime,
    //             'is_verified' => false,
    //             'updated_at' => now(),
    //         ]
    //     );

    //     // // Open OTP modal
    //     // $this->showOtpModal = true;
    //     $this->dispatch("show-modal",["modal" => 'modal1']);

    //     // Mail::to($this->selectedEmail)->send(new VerificationMail($otp));
    //     session()->flash('message
    //     ', 'A password reset OTP has been sent to your email.');
    // }

            //Send the reCAPTCHA verification request
            // $response = Http::withOptions([
            //     'verify' => false, // Temporarily disable SSL verification
            // ])->post('https://www.google.com/recaptcha/api/siteverify', [
            //     'secret' => env('RECAPTCHA_SECRETKEY'),
            //     'response' => $token,
            //     'remoteip' => request()->ip(),
            // ]);
            // $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            //         'secret' =>config('services.recaptcha.secret_key'),
            //         'response' => $token,
            //     ]);

            // $response = Http::post(
            //     'https://www.google.com/recaptcha/api/siteverify?secret='.
            //    env('RECAPTCHA_SECRETKEY').
            //     '&response='.$token
            // );


            // // Log the raw response to check what Google returns
            // logger()->info('Google reCAPTCHA Response: ', $response->json());

            //     $success = $response->json('success');

            //     if (!$success) {

            //         // Throw validation exception if verification fails
            //         throw ValidationException::withMessages([
            //             'captcha' => __('Google thinks you are a bot, please refresh and try again!'),
            //         ]);
            //     } else {
            //         $this->captcha = true;
            //     }

