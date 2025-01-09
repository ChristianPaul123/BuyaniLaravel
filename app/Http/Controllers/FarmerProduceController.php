<?php

namespace App\Http\Controllers;

use App\Models\FarmerProduce;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFarmerProduceRequest;
use App\Http\Requests\UpdateFarmerProduceRequest;
use Illuminate\Support\Facades\Session;

class FarmerProduceController extends Controller
{


    public function showFarmerSupplyProduct() {
        if (!Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }

        return view('user.farmer.farmerproduce.show');
    }
}
