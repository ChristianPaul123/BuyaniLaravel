<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use PharIo\Manifest\Email;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function showform()
    {
        return view('admin.login');
    }

    public function test()
    {
        return view('admin.test');
    }

    public function showdashboard()
    {
        return view('admin.dashboard');
    }


    public function register (Request $request) {

    $validatedData = $request->validate([
    'username' => ['required', Rule::unique('admins', 'username')],
    'email' => ['required', Rule::unique('admins', 'email')],
    'password' => ['required', 'min:8', 'max:200'],
    'admin_type' => ['required'],
    ], [
    'username.required' => 'The username field is required.',
    'username.unique' => 'This username is already taken.',
    'email.required' => 'The email field is required.',
    'email.unique' => 'This email is already registered.',
    'password.required' => 'The password field is required.',
    'password.min' => 'The password must be at least 8 characters.',
    'password.max' => 'The password may not be greater than 200 characters.',
    'admin_type.required' => 'The admin type field is required.',
    ]);

        //Encryption for password fields
        $validatedData['password'] = bcrypt($validatedData['password']);

        if (Admin::create($validatedData)) {
            return redirect()->route('admin.login')->with('message', 'admin was created successfully');
        } else {
            return redirect()->route('admin.test')->with('message', 'Error#1: error occurred for some reason');
        };

    }

    public function login(Request $request) {

        $validatedData = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (auth()->guard('admin')->attempt([
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
        ])) {

        $request->session()->regenerate();
        //$admin = auth()->guard('admin')->user();

        //dd($admin);
        return redirect()->route('admin.dashboard')->with('message', 'login successfull');
        } else {
        return redirect()->route('admin.login')->with('message', 'invalid email or password');
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('message', 'Successfully logged out');
    }



}
