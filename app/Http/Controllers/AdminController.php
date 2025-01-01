<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use PharIo\Manifest\Email;
use App\Models\SponsorImgs;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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
            $request->admin_payment->move(public_path('img/admin_payments'), $fileName);

            // Update the database
            $admin->update(['admin_payment' => 'img/admin_payments/' . $fileName]);
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

        $sponsorImages = Admin::where('');
        return view('customization.tabs.edit-admin', compact('admin'));
    }


    public function showSponsorimg() {
        $sponsorImages = SponsorImgs::all();
        return view('admin.customization.sponsor-index', compact('sponsorImages'));
    }


        // Add Sponsor Image
    public function addSponsorimg(Request $request)
    {
    $validatedData = $request->validate([
        'img_title' => ['required', 'string', 'max:255', 'unique:sponsor_imgs,img_title'],
        'img' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4096'],
    ]);

    // Upload sponsor image
    if ($request->hasFile('img')) {
        $imageName = time() . '.' . $request->img->extension();
        $request->img->move(public_path('img/sponsor'), $imageName);
        $validatedData['img'] = 'img/sponsor/' . $imageName;
    } else {
        return redirect()->route('admin.customization.sponsor')->withErrors(['img' => 'No image uploaded.']);
    }

    // Create sponsor image record
    SponsorImgs::create([
        'img_title' => $validatedData['img_title'],
        'img' => $validatedData['img'],
        'admin_id' => Auth::guard('admin')->id(), // Assuming admin is logged in
    ]);

    return redirect()->route('admin.customization.sponsor')->with('message', 'Sponsor image added successfully.');
    }

    // Edit Sponsor Image
    public function editSponsorimg($encryptedId)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $sponsorImg = SponsorImgs::findOrFail($id);

            return view('admin.customization.edit-sponsor-img',  compact('sponsorImg'));

        } catch (DecryptException $e) {
            return redirect()->route('admin.customization.sponsor')->with('error', 'Invalid Sponsor Image ID provided.');
        }
    }

    // Update Sponsor Image
    public function updateSponsorimg(Request $request, $id)
    {
        $sponsorImg = SponsorImgs::findOrFail($id);

        $validatedData = $request->validate([
            'img_title' => ['required', 'string', 'max:255', 'unique:sponsor_imgs,img_title,' . $id],
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4096'],
        ]);

        // Handle image upload if a new one is provided
        if ($request->hasFile('img')) {
            // Delete the old image if it exists
            if ($sponsorImg->img) {
                @unlink(public_path($sponsorImg->img));
            }

            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img/sponsor'), $imageName);
            $validatedData['img'] = 'img/sponsor/' . $imageName;
        }

        $sponsorImg->update([
            'img_title' => $validatedData['img_title'],
            'img' => $validatedData['img'] ?? $sponsorImg->img, // Keep the old image if none was uploaded
        ]);
        return redirect()->route('admin.customization.sponsor')->with('message', 'Sponsor image updated successfully.');
    }

    // Delete Sponsor Image
    public function deleteSponsorimg($id)
    {
        $sponsorImg = SponsorImgs::findOrFail($id);

        // Delete the associated image file if it exists
        if ($sponsorImg->img) {
            @unlink(public_path($sponsorImg->img));
        }

        $sponsorImg->delete();

        return redirect()->route('admin.customization.sponsor')->with('message', 'Sponsor image deleted successfully.');
    }





}
