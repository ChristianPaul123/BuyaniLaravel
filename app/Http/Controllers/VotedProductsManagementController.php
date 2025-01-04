<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotedProductsManagementController extends Controller
{
    public function showVotedProducts() {
        return view('admin.community.votes-index');
    }
}
// TODO: Implement this controller
