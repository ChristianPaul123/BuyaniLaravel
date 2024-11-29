<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;

class FavoriteController extends Controller
{

public function showConsumerFavorites() {

    if (!Auth::guard('user')->check()) {
        // If not authenticated, flush the session and redirect to user index with a message
        Session::flush();
        return redirect()->route('user.index')->with('message', 'Please log to access the this page');
    }

    $favorites = Favorite::where('user_id', Auth::guard('user')->user()->id)->get();
    return view('user.consumer.favorite.show', ['favorites' => $favorites]);
}



}
