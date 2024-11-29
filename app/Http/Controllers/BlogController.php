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

    if ($user = !Auth::guard('user')->check()) {
        // If not authenticated, flush the session and redirect to user index with a message
        dd($user);
        Session::flush();
        return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
    }

    $blogs = Blog::all();
    return view('blogs-consumer', ['blogs' => $blogs]);
}

public function showFarmerBlogs()
{

    if (!Auth::guard('user')->check()) {
        // If not authenticated, flush the session and redirect to user index with a message
        Session::flush();

        return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
    }

    $blogs = Blog::all();
    return view('blogs-farmer', ['blogs' => $blogs]);
}

}
