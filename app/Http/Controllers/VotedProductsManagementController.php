<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\SuggestProduct;
use App\Models\SuggestProductRecord;
use Illuminate\Support\Facades\Auth;

class VotedProductsManagementController extends Controller
{
    public function showVotedProducts() {
        $pendingproductSuggestions = SuggestProduct::with('user','admin')->where('is_accepted', 0)->get();
        $productSuggestions = SuggestProduct::with('user','admin')->where('is_accepted', 1)->get();
        $productSuggestionRecord = SuggestProductRecord::with('user','admin')->get();
        return view('admin.community.votes-index', compact('productSuggestions', 'productSuggestionRecord','pendingproductSuggestions'));
    }

    public function viewSuggestproduct($id) {
        $suggestion = SuggestProduct::with('user','admin')->find($id);
        return view('admin.community.view-manage-suggestions', compact('suggestion'));
    }

    public function acceptSuggestproduct($id)
    {
        // Find the suggestion by ID
        $suggestion = SuggestProduct::findOrFail($id);
        $admin = Auth::guard('admin')->user();

        // Mark the suggestion as accepted
        $suggestion->is_accepted = 1;
        $suggestion->verified_by = $admin->username; // Ensure it is not marked as rejected
        $suggestion->save();

        // Redirect back with a success message
        return redirect()->route('admin.voted-products', ['tab' => 'managevotes'])
        ->with('success',' Suggestion accepted successfully.');

    }
    public function rejectSuggestproduct($id)
    {
        // Find the suggestion by ID
        $suggestion = SuggestProduct::findOrFail($id);
        $admin = Auth::guard('admin')->user();

        // Mark the suggestion as rejected
        $suggestion->is_rejected = 0;
        $suggestion->verified_by = $admin->username; // Ensure it is not marked as rejected
        $suggestion->save();

        // Redirect back with a success message
        return redirect()->route('admin.voted-products', ['tab' => 'managevotes'])
        ->with('success',' Suggestion rejected successfully.');
    }
}
// TODO: Implement this controller
