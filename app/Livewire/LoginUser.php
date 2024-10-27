<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class LoginUser extends Component
{

    public $username, $email, $password, $password_confirmation, $user_type, $message;


    public function mount($user_type = null)
    {
        $this->user_type = $user_type;
    }

    public function register()
    {
        $validatedData = $this->validate([
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200', 'confirmed'],
            'user_type' => ['required', 'numeric'],
        ]);

        $validatedData['password'] = bcrypt($this->password);
        $validatedData['user_type'] = (int)$this->user_type;

        if (User::create($validatedData)) {
            $this->message = 'User was created successfully.';
            return redirect()->route('user.login', ['user_type' => $this->user_type]);
        } else {
            $this->message = 'Error creating user. Please try again.';
        }
    }

    public function login()
    {
        $this->validate([
            'username' => ['required'],
            'password' => ['required'],
            'user_type' => ['required'],
        ]);

        if (Auth::attempt(
['username' => $this->username,
            'password' => $this->password,
            'user_type' => $this->user_type]))

            {
            session()->regenerate();
            $user = Auth::user();

                if ($user->user_type == 1) {
                   Cart::firstOrCreate(
                    ['user_id' => Auth::user()->id],
                    ['cart_total' => 0, 'overall_cartKG' => 0, 'total_price' => 0]
                );
                }

                // Redirect to the appropriate dashboard based on user type
                $route = $user->user_type == 1 ? 'user.consumer' : 'user.farmer';
                return redirect()->route($route)->with('message', 'Login successful');


            } else {
                $this->message = 'Invalid username or password. Please try again.';
            }
    }

    public function logout()
    {
        $user = Auth::user();
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        $redirectRoute = $user->user_type == 1 ? '/user/login?user_type=1' : '/user/login?user_type=2';
        return redirect($redirectRoute)->with('message', 'Successfully logged out');
    }
    public function render()
    {
        return view('livewire.login-user');
    }
}
