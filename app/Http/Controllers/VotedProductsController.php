<?php

namespace App\Http\Controllers;

use App\Models\VotingCount;
use Illuminate\Http\Request;
use App\Models\SuggestProduct;
use Illuminate\Support\Facades\Auth;

class VotedProductsController extends Controller
{

    public function suggestProduct(Request $request)
    {
        $userId = Auth::guard('user')->id();
        // Validate the request inputs
        $request->validate([
            'suggest_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'suggest_description' => 'required|string',
            'suggest_image' => 'nullable|image|max:2048',
        ]);

        // Check if the user has remaining suggest count
        $votingCount = VotingCount::where('user_id', $userId)->first();

        if (!$votingCount || $votingCount->suggest_count <= 0) {
            return redirect()->back()->withErrors(['error' => 'You have reached your suggestion limit.']);
        }

        // Store the suggested product
        $suggestedProduct = SuggestProduct::create([
            'user_id' =>  $userId,
            'verified_by' => null,
            'suggest_name' => $request->input('suggest_name'),
            'suggest_description' => $request->input('suggest_description'),
            'suggest_image' => $request->file('suggest_image') ? $request->file('suggest_image')->store('suggestions') : null,
            'total_vote_count' => 0,
            'is_accepted' => false,
        ]);

        // Decrement the user's suggest count
        $votingCount->decrement('suggest_count');

        return redirect()->back()->with('message', 'Product suggested successfully!');
    }
    public function showConsumerVoting() {
        // Check if the user is authenticated
        if (!Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to the user index with a message
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }

        // Get the authenticated user
        $userID = Auth::guard('user')->id();

        // Check if the user already has a VotingCount instance
        $votingCount = VotingCount::firstOrCreate(
            ['user_id' => $userID], // Check condition
            [ // Default values if the instance is created
                'max_vote_count' => 5,
                'remaining_vote_count' => 5,
                'suggest_count' => 1,
            ]
        );

        // Proceed to render the voting page
        return view('user.consumer.vote.show');
    }
}
