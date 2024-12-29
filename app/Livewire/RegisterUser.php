<?php

namespace App\Livewire;

use App\Models\User;
use App\Mail\HelloMail;
use Livewire\Component;
use App\Models\OtpVerify;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class RegisterUser extends Component
{

    public $username ='';
    public $email='';
    public $phone_number = '';

    public $password='';


    public $password_confirmation='';
    public $user_type='';

    public $message;

    public $otp;
    public $showModal = false;
    public $terms  = null;
    public $policys = null;



    public function mount($user_type)
    {
        $this->user_type = $user_type;
    }
// Controls the visibility of the modal

    public function openModal()
    {
        $this->showModal = true;

        $user = User::where('username', $this->username)->first();
        if ($user) {
            $user->otp = rand(100000, 999999);
            $user->save();
        }
    }

    public function closeModal()
    {
        $this->reset(['otp', 'showModal']);
        // Reset OTP and hide modal
    }


    public function register()
    {
        $validatedData = $this->validate([
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => ['required','regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com|hotmail\.com|outlook\.com|icloud\.com)$/', Rule::unique('users', 'email')],
            'phone_number' => ['required','regex:/^\d{10,15}$/',Rule::unique('users', 'phone_number')],
            'password' => ['required', 'min:8', 'max:200', 'confirmed'],
            'user_type' => ['required', 'numeric'],
        ],[
            'email.regex' => 'Please provide a valid email address Ex: Gmail, Yahoo, Hotmail, Outlook, or iCloud.',
            'phone_number.required' => 'The phone number is required.',
            'phone_number.regex' => 'The phone number must be 10-15 digits',
            'phone_number.unique' => 'This phone number is already registered.',
        ]);
        //$validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['user_type'] = (int)$validatedData['user_type'];

        $this->username = $validatedData['username'];
        $this->email = $validatedData['email'];
        $this->password = $validatedData['password'];
        $this->phone_number = $validatedData['phone_number'];
        //$this->password_confirmation = $validatedData['password_confirmation'];
        $this->user_type = $validatedData['user_type'];

        $this->showModal = true;

        $this->generateAndStoreOtp($this->email);

    }

    protected function generateAndStoreOtp($email)
{
    try {
    // Generate a 6-digit OTP
    $otp = rand(100000, 999999);
    $expiryTime = now()->addMinutes(5); // Set OTP to expire in 5 minutes

    // Store OTP in the database
    OtpVerify::updateOrCreate(
        [
            'email' => $email,
            'v_purpose' => 'registration', // Condition to check for existing record
        ],
        [
            'otp' => $otp,
            'otp_expiry' => $expiryTime,
            'is_verified' => false,
            'updated_at' => now(), // Update timestamp
        ]);

    Mail::to($email)->send(new HelloMail($otp));
    // Flash a success message to indicate OTP was resent
    //session()->flash('message', 'A new OTP has been sent to your email.');

    } catch (\Exception $e) {
        // Flash an error message if there's an issue resending the OTP
        session()->flash('error', 'Error resending OTP. Please try again.');
    }

}

public function resendOtp()
{
    try {
        // Generate a new 6-digit OTP
        $otp = rand(100000, 999999);
        $expiryTime = now()->addMinutes(5); // Set OTP to expire in 5 minutes

        // Update or create the OTP in the database
        OtpVerify::updateOrCreate(
            [
                'email' => $this->email,
                'v_purpose' => 'registration', // Condition to check for existing record
            ],
            [
                'otp' => $otp,
                'otp_expiry' => $expiryTime,
                'is_verified' => false,
                'updated_at' => now(), // Update timestamp
            ]);

            Mail::to($this->email)->send(new HelloMail($otp));
        // Flash a success message to indicate OTP was resent
        session()->flash('message', 'A new OTP has been sent to your email.');

    } catch (\Exception $e) {
        // Flash an error message if there's an issue resending the OTP
        session()->flash('error', 'Error resending OTP. Please try again.');
    }
}


public function verifyOtp()
{
    // Validate OTP input
    $this->validate([
        'otp' => 'required|numeric|digits:6',
    ]);

    // Retrieve the OTP record from the database for the provided email and purpose
    $otpRecord = OtpVerify::where('email', $this->email)
        ->where('v_purpose', 'registration')
        ->where('is_verified', false)
        ->where('otp_expiry', '>', now())
        ->latest()  // Ensure the OTP hasn't expired
        ->first();


    if ($otpRecord && $otpRecord->otp == $this->otp) {
        // Mark OTP as verified
        $otpRecord->update(['is_verified' => true]);

        try {
            // Attempt to create the user
            User::create([
                'username' => $this->username,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'password' => bcrypt($this->password), // Hash password before saving
                'user_type' => $this->user_type,
            ]);

            // Flash success message and redirect
            session()->flash('success', 'User was created successfully.');
            return redirect()->route('user.login', ['user_type' => $this->user_type]);
        } catch (\Exception $e) {
            // Handle any errors that occur during user creation
            session()->flash('error', 'Error creating user. Please try again.');
        }
        // Complete the registration process
        // Close the OTP modal
        $this->showModal = false;
        $this->completeRegistration();
    } else {
        // If OTP is invalid, flash an error message
        session()->flash('error', 'Invalid or expired OTP. Please try again.');
    }
}

    public function render()
    {
        return view('livewire.register-user');
    }
}
