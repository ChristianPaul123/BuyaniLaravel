<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Inventory;
use PharIo\Manifest\Email;
use App\Models\SponsorImgs;
use App\Models\ProductSales;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProductSpecification;
use App\Models\SpecificProductSales;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        // 1) Get the top 5 products
        $topProducts = ProductSales::with('product')
            ->orderBy('order_count', 'desc') // or 'total_sales'
            ->take(5)
            ->get();

              // Fetch products added at least a month ago
        $products = Product::whereDate('created_at', '<=', now()->subMonth())->orderBy('created_at', 'desc')->get();

        // Fetch product specifications added at least a month ago
        $productSpecifications = ProductSpecification::whereDate('created_at', '<=', now()->subMonth())->orderBy('created_at', 'desc')->get();

        // Transform them into arrays suitable for Chart.js
        $productLabels = $topProducts->map(function ($item) {
            return optional($item->product)->product_name ?? 'Unknown';
        });
        $productData = $topProducts->map(function ($item) {
            return $item->order_count; // or $item->total_sales
        });

        // 2) Get the top 5 product specs
        $topProductSpecs = SpecificProductSales::with('productSpecification.product')
            ->orderBy('order_quantity', 'desc') // or 'total_sales'
            ->take(5)
            ->get();

        $specLabels = $topProductSpecs->map(function ($item) {
            // e.g. "ProductName - SpecName"
            // $productName = optional($item->productSpecification->product)->product_name ?? 'Unknown Product';
            $specName = optional($item->productSpecification)->specification_name ?? 'Unknown Spec';
            return $specName;
        });
        $specData = $topProductSpecs->map(function ($item) {
            return $item->order_quantity; // or $item->total_sales
        });

        // 3) Fetch monthly totals for the last 6 months (example)
        // Let's group by month-year. This can be done in multiple ways,
        // e.g. DB::raw queries or using Carbon. This is just an example:
        $months = collect();
        $totals = collect();

        // For the sake of example, let's do 6 months back:
        for ($i = 0; $i < 6; $i++) {
            $dateObj = now()->subMonths($i);
            $yearMonth = $dateObj->format('Y-m');

            // Sum from product_sales table:
            $sumForMonth = ProductSales::where('date', 'like', "$yearMonth%")->sum('total_sales');

            // Or, if your 'date' column is a proper date/datetime, you can do:
            // ->whereMonth('date', $dateObj->month)
            // ->whereYear('date',  $dateObj->year)

            $months->prepend($dateObj->format('M Y'));
            $totals->prepend($sumForMonth);
        }

        // Pass arrays for Chart.js
        $monthLabels = $months->values();  // e.g. ['Aug 2024', 'Sep 2024', ...]
        $monthData   = $totals->values();  // e.g. [30, 45, ...]


            // 1. Get the latest added product
            //    If you want strictly "within the last month", you can do ->where('created_at', '>=', now()->subMonth())
            //    But if you literally just want the single most recently added, do this:
        $latestProduct = Product::orderBy('created_at', 'desc')->first();

            // 2. Get product specifications older than 1 month
            //    We check the ProductSpecification's `created_at` field
        $olderSpecs = ProductSpecification::where('created_at', '<=', now()->subMonth())->get();

        // 3. Get total/sold/damaged stocks for the pie chart
        //    Summing across the entire Inventory table
        $inventoryData = Inventory::selectRaw('
            SUM(product_total_stock) as total_stocks,
            SUM(product_sold_stock) as sold_stocks,
            SUM(product_damage_stock) as damaged_stocks
        ')->first();


        return view('admin.dashboard', compact(
            'productLabels', 'productData',
            'specLabels', 'specData',
            'monthLabels', 'monthData',
            'products', 'productSpecifications',
            'inventoryData','latestProduct','olderSpecs'
        ));

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

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (auth()->guard('admin')->attempt([
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
        ])) {
            // Check if the admin account is active
            $admin = auth()->guard('admin')->user();

            if ($admin->deactivated_status == 1) {
                // Log the admin out and redirect to login page with a message
                auth()->guard('admin')->logout();

                return redirect()->route('admin.login')->with('message', 'Your account has been deactivated. Please contact support.');
            }

            // Regenerate session and redirect to dashboard
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('message', 'Login successful');
        }

        // Redirect back with an error message if credentials are invalid
        return redirect()->route('admin.login')->with('message', 'Invalid username or password');
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
        $admins = Admin::all();
        return view('admin.customization.customization-index', compact('admin', 'admins'));
    }


    // public function updateAdminPayment(Request $request)
    // {
    //     $request->validate([
    //         'admin_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $admin = auth()->guard('admin')->user();

    //     if ($request->hasFile('admin_payment')) {
    //         // Remove the old file if exists
    //         if ($admin->admin_payment && file_exists(public_path($admin->admin_payment))) {
    //             unlink(public_path($admin->admin_payment));
    //         }

    //         // Save the new file
    //         $fileName = time() . '.' . $request->admin_payment->extension();
    //         $request->admin_payment->move(public_path('img/admin_payments'), $fileName);

    //         // Update the database
    //         $admin->update(['admin_payment' => 'img/admin_payments/' . $fileName]);
    //     }

    //     return redirect()->route('admin.customization', ['tab' => 'payments'])
    //     ->with('message', 'Payment picture updated successfully.');
    // }

    public function storenewAdmin(Request $request)
{
    // 1) Validate new admin’s data
    //    If you want Laravel's "confirmed" approach, rename "confirmation_password" to "password_confirmation"
    //    or do a custom check. We'll show a custom approach here.
    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|string|min:6',
        'admin_type' => 'required|in:2,3',
        'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 2) Check custom confirm password logic (if "confirmation_password" is used)
    if ($request->password !== $request->confirmation_password) {
        return redirect()->back()->withErrors([
            'confirmation_password' => 'Passwords do not match.'
        ])->withInput();
    }

    // 3) Handle the password
    $password = bcrypt($request->password);

    // 4) Handle the profile picture upload (optional)
    $filePath = null;
    if ($request->hasFile('profile_pic')) {
        $filePath = $request->file('profile_pic')->store('public/profile_pics');
    }

    // 5) Create the admin
    Admin::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => $password,
        'admin_type' => $request->admin_type,
        'profile_pic' => $filePath,
        // fill in any additional fields with default or null if needed
    ]);

    return redirect()->route('admin.customization', ['tab' => 'admins'])->with('success', 'Admin added successfully.');
}




    // public function store(Request $request)
    // {
    //     // 1) Validate the “current_admin_password”
    //     $loggedInAdmin = Auth::guard('admin')->user();
    //     // Or if you’re using the default guard for admins, adapt as needed

    //     if (!$loggedInAdmin) {
    //         return redirect()->route('admin.customization', ['tab' => 'admins'])
    //         ->with('error', 'Payment picture updated successfully.');
    //     }

    //     // Check if user typed their own correct password
    //     if (!Hash::check($request->input('current_admin_password'), $loggedInAdmin->password)) {
    //         return redirect()->route('admin.customization', ['tab' => 'admins'])
    //         ->with('error', 'Payment picture updated successfully.');
    //     }

    //     // 2) Validate new admin’s data
    //     $data = $request->validate([
    //         'username' => 'required|string|max:255',
    //         'email' => 'required|email|unique:admins,email',
    //         'password' => 'required|string|min:6|confirmed', // we can leverage Laravel’s “confirmed” rule
    //         'admin_type' => 'required|in:2,3',
    //         'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // example constraints
    //     ]);

    //     // Because we used `'password' => 'required|string|min:6|confirmed'`, we should ensure
    //     // the field name for confirm password is `password_confirmation` (instead of `confirmation_password`).
    //     // If you want to keep `confirmation_password`, you can manually check in code, or rename for convenience.

    //     // 3) Handle the password
    //     $data['password'] = bcrypt($data['password']);

    //     // 4) Handle the profile picture
    //     if ($request->hasFile('profile_pic')) {
    //         // Store the file. For example, in the 'public/profile_pics' directory
    //         // This will store the file and return the path
    //         $filePath = $request->file('profile_pic')->store('public/profile_pics');
    //         // Remove 'public/' if you want to store in a different disk or path
    //         // Then you can save that path or just the filename
    //         $data['profile_pic'] = $filePath;
    //     }

    //     // 5) Create the admin
    //     Admin::create($data);

    //     return redirect()->back()->with('message', 'Admin added successfully.');
    // }


    public function deactivate(Admin $admin)
    {
        // Check if the admin is trying to deactivate themselves
        if (Auth::guard('admin')->id() === $admin->id) {
            return redirect()->route('admin.customization', ['tab' => 'admins'])
                ->with('message', 'Sorry, you cannot deactivate yourself, silly!');
        }

        // Proceed to deactivate the admin
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


    public function showeditAdmin(Admin $admin)
    {
        // If needed, you can do any checks here, e.g. only owners can edit certain admins, etc.
        return view('admin.customization.edit-admin', compact('admin'));
    }

    // Handle the form submission to update the admin

    public function updateAdmin(Request $request, Admin $admin)
    {
        // Base validation rules
        $rules = [
            'username'   => 'required|string|max:255',
            'email'      => 'required|email',
            'admin_type' => 'required|in:1,2,3', // Owner=1, Assistant=2, Employee=3
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        // If a new password was typed in, validate it
        // "confirmed" rule => requires a matching "password_confirmation" field
        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        }

        $data = $request->validate($rules);

        // Update base fields
        $admin->username   = $data['username'];
        $admin->email      = $data['email'];
        $admin->admin_type = $data['admin_type'];

        // If a new profile picture was uploaded
        if ($request->hasFile('profile_pic')) {
            // Optional: remove the old one from storage if desired
            // Storage::delete($admin->profile_pic);

            $path = $request->file('profile_pic')->store('public/admin_pics');
            $admin->profile_pic = $path;
        }

        // If a new password was entered, update it
        if ($request->filled('password')) {
            $admin->password = Hash::make($data['password']);
        }

        $admin->save();

        return redirect()->route('admin.customization', ['tab' => 'admins'])
            ->with('success', 'Admin updated successfully.');
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
