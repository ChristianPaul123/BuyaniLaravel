<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function showConsumerChat() {

        if ($user = !Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            //Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }
        return view('user.consumer.chat.show');
    }

    public function showFarmerChat() {

        if ($user = !Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            //Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }
        return view('user.farmer.chat.show');
    }
}
