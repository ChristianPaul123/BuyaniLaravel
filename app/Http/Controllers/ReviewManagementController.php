<?php

namespace App\Http\Controllers;

use App\Models\OrderRating;
use Illuminate\Http\Request;
use App\Models\ProductRating;

class ReviewManagementController extends Controller
{
    public function showReviews() {
        $productRating = ProductRating::with('product','user')->get();
        $orderRating = OrderRating::with('order','user')->get();
        return view('admin.community.review-index',compact('productRating','orderRating'));
    }
}
