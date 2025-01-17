<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

//USER SIDE

public function showConsumerBlogs()
{
    if (!Auth::guard('user')->check()) {
        Session::flush();
        return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
    }

    // Fetch the latest blog for the main display
    $latestBlog = Blog::where('deactivated_status', 0)->orderBy('created_at', 'desc')->first();

    // Check if there are any blogs
    if (!$latestBlog) {
        // Return an empty paginator with the correct page settings
        $blogs = Blog::where('deactivated_status', 0)->paginate(2); // This will give a paginator, but with no results.
        return view('blogs-consumer', [
            'latestBlog' => null,
            'blogs' => $blogs,
            'message' => 'No blogs are currently available. Check back later!',
        ]);
    }

    // Fetch the remaining blogs, excluding the latest one
    $blogs = Blog::where('id', '!=', $latestBlog->id)
        ->orderBy('created_at', 'desc')
        ->paginate(2);

    // Return the view with the paginated blogs
    return view('blogs-consumer', [
        'latestBlog' => $latestBlog,
        'blogs' => $blogs,
        'message' => null, // Clear message for the blogs page
    ]);
}



public function showFarmerBlogs()
{

    if (!Auth::guard('user')->check()) {
        Session::flush();
        return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
    }

    // Fetch the latest blog for the main display and paginate the rest
    $latestBlog = Blog::where('deactivated_status', 0)->orderBy('created_at', 'desc')->first();
    if (!$latestBlog) {
        // Return an empty paginator with the correct page settings
        $blogs = Blog::paginate(2); // This will give a paginator, but with no results.
        return view('blogs-farmer', [
            'latestBlog' => null,
            'blogs' => $blogs,
            'message' => 'No blogs are currently available. Check back later!',
        ]);
    }
    $blogs = Blog::where('deactivated_status', 0)->where('id', '!=', $latestBlog->id)->orderBy('created_at', 'desc')->paginate(2);

    return view('blogs-farmer', [
        'latestBlog' => $latestBlog,
        'blogs' => $blogs,
    ]);
}

}
