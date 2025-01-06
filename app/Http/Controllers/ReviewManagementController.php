<?php

namespace App\Http\Controllers;

use App\Models\OrderRating;
use Illuminate\Http\Request;
use App\Models\ProductRating;

class ReviewManagementController extends Controller
{
    public function showReviews() {
        $productRatings = ProductRating::with('product','user')->get();
        $orderRatings = OrderRating::with('order','user')->get();
        return view('admin.community.review-index',compact('productRatings','orderRatings'));
    }
}
