<?php

namespace App\Http\Controllers;

use App\Models\OrderRating;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class ReviewManagementController extends Controller
{
    public function showReviews() {
        $productreviews = ProductRating::with('product','user')->get();
        $orderreviews = OrderRating::with('order','user')->get();
        return view('admin.community.review-index',compact('productreviews', 'orderreviews'));
    }
}
