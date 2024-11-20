<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
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
        return view('user.consumer',['products' => $products, 'categories' => $categories, 'subcategories' => $subcategories]);
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

}
