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





    public function showCustomization()
    {
        $admin = auth()->guard('admin')->user(); // Current Admin
        $admins = Admin::where('admin_type', '!=', 1)->get(); // Exclude admin_type = 1
        return view('admin.customization.customization-index', compact('admin', 'admins'));
    }


    public function updateAdminPayment(Request $request)
    {
        $request->validate([
            'admin_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $admin = auth()->guard('admin')->user();

        if ($request->hasFile('admin_payment')) {
            // Remove the old file if exists
            if ($admin->admin_payment && file_exists(public_path($admin->admin_payment))) {
                unlink(public_path($admin->admin_payment));
            }

            // Save the new file
            $fileName = time() . '.' . $request->admin_payment->extension();
            $request->admin_payment->move(public_path('uploads/admin_payments'), $fileName);

            // Update the database
            $admin->update(['admin_payment' => 'uploads/admin_payments/' . $fileName]);
        }

        return redirect()->route('admin.customization', ['tab' => 'payments'])
        ->with('message', 'Payment picture updated successfully.');
    }

    public function store(Request $request)
    {
    $data = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|string|min:6',
        'admin_type' => 'required|in:2,3',
    ]);

    $data['password'] = bcrypt($data['password']);
    Admin::create($data);

    return redirect()->back()->with('message', 'Admin added successfully.');
    }

    public function deactivate(Admin $admin)
{
    $admin->update([
        'deactivated_status' => 1,
        'deactivated_date' => now(),
    ]);

    return redirect()->route('admin.customization', ['tab' => 'admins'])
        ->with('message', 'Admin deactivated successfully.');
}

public function activate(Admin $admin)
{
    $admin->update([
        'deactivated_status' => 0,
        'deactivated_date' => null,
    ]);

    return redirect()->route('admin.customization', ['tab' => 'admins'])
        ->with('message', 'Admin activated successfully.');
}

    public function edit(Admin $admin)
    {
        return view('customization.tabs.edit-admin', compact('admin'));
    }




}
