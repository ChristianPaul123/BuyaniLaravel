<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\SponsorImgs;
use App\Models\SubCategory;
use App\Models\ProductSales;
use Illuminate\Http\Request;
use App\Models\SuggestProduct;
use App\Models\SpecificProductSales;
use Illuminate\Support\Facades\Auth;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use function RalphJSmit\Laravel\SEO\seo; // Import the helper function


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

        // $seoData = new SEOData(
        //     title: 'Consumer Dashboard | BuyAni',            // Title
        //     description: 'Discover local farm produce and support Filipino farmers.', // Meta description
        //     image: asset('img/stockImg3.png'),              // URL to a representative image
        //     // keywords: 'farmers, produce, fresh harvests',    // Optionally define keywords (not heavily used by Google, but still okay to set)
        // );

        // // --- STEP 2: Pass your SEO data to the SEO singleton ---
        // seo()->setSEOData($seoData);

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
        // Fetch sponsor images and limit to 6 items
    $sponsorImages = SponsorImgs::all();

    $sponsors = $sponsorImages; // Include all available sponsor images

    // Ensure at least 3 items (real sponsors or placeholders)
    $minVisible = 3;
    $placeholdersNeeded = max(0, $minVisible - $sponsors->count());
    $currentMonth = Carbon::now()->format('Y-m'); // Get the current year and month

    // Fetch best-selling products for the current month
    $bestSellingProducts = ProductSales::where('date', 'like', "$currentMonth%")
        ->with('product') // Assuming a relation with the Product model
        ->orderBy('order_count', 'desc')
        ->take(5)
        ->get();

    // Fetch best-selling product variants for the current month
    $bestSellingVariants = SpecificProductSales::where('date', 'like', "$currentMonth%")
        ->with('productSpecification.product') // Assuming nested relations
        ->orderBy('order_quantity', 'desc')
        ->take(5)
        ->get();

        $currentMonth = Carbon::now()->format('Y-m'); // Get current year and month

        // Fetch top-voted products for the current month
        $topVotedProducts = SuggestProduct::where('deactivated_status', false)
            ->where('is_accepted', true) // Ensure only accepted products are included
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->orderBy('total_vote_count', 'desc')
            ->take(10) // Limit to top 10
            ->get(['suggest_name', 'total_vote_count']); // Fetch only necessary fields

    // Add placeholders if necessary
    for ($i = 0; $i < $placeholdersNeeded; $i++) {
        $sponsors->push((object) [
            'img' => 'https://via.placeholder.com/200x100?text=Sponsor+Placeholder',
            'img_title' => 'Sponsor Placeholder',
        ]);
    }

    return view('user.farmer', compact('sponsors', 'bestSellingProducts', 'bestSellingVariants','topVotedProducts','isProfileIncomplete'));

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
