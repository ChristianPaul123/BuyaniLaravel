<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewManagementController extends Controller
{
    public function showReviews() {
        return view('admin.community.review-index');
    }
}
