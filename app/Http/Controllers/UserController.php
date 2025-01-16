<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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



    // public function register (Request $request) {
    //     $validatedData = $request->validate([
    //         'username' => ['required',  Rule::unique('users','username')],
    //         'email' => ['required', Rule::unique('users','email')],
    //         'password' => ['required', 'min:8', 'max:200', 'confirmed'],
    //         'user_type' => ['required','numeric'],
    //     ],
    //     [
    //         'username.required' => 'The username field is required.',
    //         'username.unique' => 'This username is already taken.',
    //         'email.required' => 'The email field is required.',
    //         'email.unique' => 'This email is already registered.',
    //         'password.required' => 'The password field is required.',
    //         'password.min' => 'The password must be at least 8 characters.',
    //         'password.max' => 'The password may not be greater than 200 characters.',
    //         'password.confirmed' => 'The password is not the as confirmed password.',
    //         'user_type.required' => 'The admin type field is required.',
    //         'user_type.numeric' => 'The user_type is not a number.',
    //     ]);
    //     //Encryption for password validatedData
    //     $validatedData['password'] = bcrypt($validatedData['password']);

    //     //checks for user type field if numeric otherwise bitch it out
    //     $validatedData['user_type'] = is_numeric($validatedData['user_type']) ? (int) $validatedData['user_type'] : 0;





    //     if (User::create($validatedData)) {
    //         return redirect('/')->with('message', 'user was created successfully');
    //     } else {
    //         return redirect()->route('user.register')->with('message', 'invalid login problems');
    //     };
    // }



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


    //for user profile

    public function showUserprofile() {
        if (!Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }
        $user = auth()->guard('user')->user();
        return view('user.consumer.profile.show', ['user' => $user]);
    }

    public function showFarmerprofile() {
        if (!Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }

            // **************** NEW CODE: Fetch low stock products ****************
    $lowStockProducts = Product::with('inventory')
    ->whereHas('inventory', function($query) {
        $query->where('product_total_stock', '<', 50);
    })
    ->get();


        $user = auth()->guard('user')->user();
        return view('user.farmer.farmerprofile.show',compact('user','lowStockProducts'));
    }

}
