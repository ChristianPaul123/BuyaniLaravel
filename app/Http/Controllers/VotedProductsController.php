<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotedProductsController extends Controller
{
    public function showConsumerVoting() {
        return view('user.consumer.vote.show');
    }
}
