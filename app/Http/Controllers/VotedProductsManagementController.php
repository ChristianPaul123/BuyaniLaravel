<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuggestProduct;
use App\Models\SuggestProductRecord;

class VotedProductsManagementController extends Controller
{
    public function showVotedProducts() {
        $manageSuggestions = SuggestProduct::with('user','admin','votedProducts')->get();
        $suggestionRecord = SuggestProductRecord::with('user','admin')->get();


        return view('admin.community.votes-index',compact('manageSuggestions', 'suggestionRecord'));
    }
}
// TODO: Implement this controller
