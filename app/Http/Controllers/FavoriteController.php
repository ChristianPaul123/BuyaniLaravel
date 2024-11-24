<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;

class FavoriteController extends Controller
{

public function showConsumerFavorites() {
    $favorites = Favorite::where('user_id', Auth::guard('user')->user()->id)->get();
    return view('user.consumer.favorite.show', ['favorites' => $favorites]);
}



}
