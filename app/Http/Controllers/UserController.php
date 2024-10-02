<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function showRegisterform(Request $request)
    {
        $user_type = $request->get('user_type', null);
         //checks user_type
        if ($user_type == 1) {
        return view('user.register')->with('user_type', $user_type);
        } else if ($user_type == 2) {
        return view('user.register')->with('user_type', $user_type);
        }
    }

    public function showLoginform(Request $request)
    {
        $user_type = $request->get('user_type', null);
        //checks user_type
        if ($user_type == 1) {
        return view('user.login')->with('user_type', $user_type);
        } else if ($user_type == 2) {
        return view('user.login')->with('user_type', $user_type);;
        }
    }

    public function showConDashboard()
    {
        //returns the view starting
        return view('user.consumer');
    }

    public function showFarmDashboard()
    {
        //return the view starting
        return view('user.farmer');
    }


    public function register (Request $request) {
        $fields = $request->validate([
            'username' => ['required',  Rule::unique('users','username')],
            'email' => ['required', Rule::unique('users','email')],
            'password' => ['required', 'min:8', 'max:200', 'confirmed'],
            'user_type' => ['required','numeric'],
        ],
        [
            'username.required' => 'The username field is required.',
            'username.unique' => 'This username is already taken.',
            'email.required' => 'The email field is required.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.max' => 'The password may not be greater than 200 characters.',
            'password.confirmed' => 'The password is not the as confirmed password.',
            'user_type.required' => 'The admin type field is required.',
            'user_type.numeric' => 'The user_type is not a number.',
        ]);
        //Encryption for password fields
        $fields['password'] = bcrypt($fields['password']);

        //checks for user type field if numeric otherwise bitch it out
        $fields['user_type'] = is_numeric($fields['user_type']) ? (int) $fields['user_type'] : 0;

        if (User::create($fields)) {
            return redirect('/')->with('message', 'user was created successfully');
        } else {
            return redirect()->route('user.register')->with('message', 'invalid login problems');
        };
    }

    public function login(Request $request) {

     // Validate the username and password fields
     $fields = $request->validate([
         'username' => ['required'],
         'password' => ['required'],
         'user_type' => ['required'],
     ]);

    $user_type = $fields['user_type'];

     // Attempt to authenticate the user
     if (auth()->guard('user')->attempt([
         'username' => $fields['username'],
         'password' => $fields['password'],
         'user_type' => $fields['user_type'],
     ])) {
         $request->session()->regenerate();
         $user = auth()->guard('user')->user();

         // Check user_type and redirect accordingly
         if ($user->user_type == 1) {
             return redirect()->route('user.consumer')->with('message', 'Login successful');
         } elseif ($user->user_type == 2) {
             return redirect()->route('user.farmer')->with('message', 'Login successful');
         }
        //  else {
        //      // Unknown user_type, return with an error message -- not readable
        //      return redirect('/user/login?user_type=' . $user_type)
        //          ->withErrors('message', 'User type not recognized! Please check properly.');
        //  }
     } else {
         // Authentication failed, return error with user_type in URL
         return redirect('/user/login?user_type=' . $user_type)
            ->withErrors(['login' => 'Invalid username or password. Please try again.']);
     }
    }


    public function logout(Request $request)
    {
       // Get the authenticated user
    $user = auth()->guard('user')->user();
    Auth::guard('user')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Check user_type and redirect accordingly
    if ($user->user_type == 1) {
        return redirect('/user/login?user_type=1')->with('message', 'Successfully logged out');
    } elseif ($user->user_type == 2) {
        return redirect('/user/login?user_type=2')->with('message', 'Successfully logged out');
    } else {
        return redirect('/')->with('message', 'Successfully logged out');
    }
    }
}
