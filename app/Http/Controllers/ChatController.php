<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function showConsumerChat() {

        if ($user = !Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }

        $userId = Auth::guard('user')->id();

        try {
            // Attempt to find the chat instance and update the message count
            $chat = Chat::where('user_id', $userId)->firstOrFail();
            $chat->update(['is_message_count' => 0]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // If no chat instance is found, create one
            $chat = Chat::create([
                'user_id' => $userId,
                'chat_status' => 1, // Assuming '1' indicates active
                'is_message_count' => 0,
            ]);
        }

        return view('user.consumer.chat.show');
    }

    public function showFarmerChat() {

        if ($user = !Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }

        $userId = Auth::guard('user')->id();

        try {
            // Attempt to find the chat instance and update the message count
            $chat = Chat::where('user_id', $userId)->firstOrFail();
            $chat->update(['is_message_count' => 0]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // If no chat instance is found, create one
            $chat = Chat::create([
                'user_id' => $userId,
                'chat_status' => 1, // Assuming '1' indicates active
                'is_message_count' => 0,
            ]);
        }

        return view('user.farmer.chat.show');
    }
}
