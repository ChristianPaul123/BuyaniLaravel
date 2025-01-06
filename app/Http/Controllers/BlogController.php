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
    $latestBlog = Blog::orderBy('created_at', 'desc')->first();

    // Check if there are any blogs
    if (!$latestBlog) {
        return view('blogs-consumer', [
            'latestBlog' => null,
            'blogs' => collect([]), // Empty collection for consistency
        ])->with('message', 'No blogs are currently available. Check back later!');
    }

    // Fetch the remaining blogs, excluding the latest one
    $blogs = Blog::where('id', '!=', $latestBlog->id)
        ->orderBy('created_at', 'desc')
        ->paginate(2);

    return view('blogs-consumer', [
        'latestBlog' => $latestBlog,
        'blogs' => $blogs,
    ]);
}

public function showFarmerBlogs()
{

    if (!Auth::guard('user')->check()) {
        Session::flush();
        return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
    }

    // Fetch the latest blog for the main display and paginate the rest
    $latestBlog = Blog::orderBy('created_at', 'desc')->first();
    $blogs = Blog::where('id', '!=', $latestBlog->id)->orderBy('created_at', 'desc')->paginate(2);

    return view('blogs-farmer', [
        'latestBlog' => $latestBlog,
        'blogs' => $blogs,
    ]);
}

}
