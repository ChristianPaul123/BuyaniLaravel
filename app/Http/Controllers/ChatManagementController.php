<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatManagementController extends Controller
{
    public function showAdminChat() {

        return view('admin.chat.chat-index');
    }
}
