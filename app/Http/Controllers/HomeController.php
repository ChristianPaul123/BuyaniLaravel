<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SponsorImgs;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function showConDashboard()
    {

        $user = Auth::guard('user')->user(); // Get the authenticated user
        $isProfileIncomplete = false; // Default value for guests
        if ($user != null) {

            $isProfileIncomplete = empty($user->first_name) || empty($user->last_name);
        }
        //returns the view starting
        $products = Product::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $sponsorImages = SponsorImgs::all();
        return view('user.consumer',compact('subcategories', 'sponsorImages', 'products', 'categories','isProfileIncomplete'));
    }

    public function showConAbout()
    {

        return view('about-us-consumer');
    }

    public function showConContact()
    {
        return view('contact-consumer');
    }

    public function showFarmDashboard()
    {
        $user = Auth::guard('user')->user(); // Get the authenticated user
        $isProfileIncomplete = false; // Default value for guests
        if ($user != null) {

            $isProfileIncomplete = empty($user->first_name) || empty($user->last_name);
        }
        //return the view starting
        return view('user.farmer',compact('isProfileIncomplete'));
    }


    public function showFarmAbout()
    {

        return view('about-us-farmer');
    }

    public function showFarmContact()
    {
        return view('contact-farmer');
    }

    public function sessionExpire()
    {
        return view('layouts.session-expire');
    }

    public function showUserTermsandCondition() {
        return view('user-terms-and-condition');
    }

    public function showPrivacyPolicy() {
        return view('user-privacy-policy');
    }

}
