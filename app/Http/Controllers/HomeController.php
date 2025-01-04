<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SponsorImgs;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showConDashboard()
    {
        //returns the view starting
        $products = Product::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $sponsorImages = SponsorImgs::all();
        return view('user.consumer',['products' => $products, 'categories' => $categories, 'subcategories' => $subcategories,'sponsorImages' => $sponsorImages]);
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
        //return the view starting
        return view('user.farmer');
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
