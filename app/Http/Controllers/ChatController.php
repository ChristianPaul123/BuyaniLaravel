<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function showConsumerChat() {
        return view('user.consumer.chat.show');
    }
}
