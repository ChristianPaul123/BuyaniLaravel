<?php

namespace App\Livewire\Consumer;

use Livewire\Component;
use App\Models\VotingCount;
use App\Models\VotedProducts;
use App\Models\SuggestProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class SuggestedProductPoll extends Component
{
    public $suggestedProducts = [];
    public $productName, $category, $description, $image;

    public function mount()
    {
        $this->loadSuggestedProducts();
    }

    public function loadSuggestedProducts()
    {
        $userId = Auth::guard('user')->id();
        $this->suggestedProducts = SuggestProduct::with(['votedProducts' => function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('is_accepted', 1);
        }])->orderBy('total_vote_count', 'desc')->get();
    }

    public function toggleVote($productId)
    {
        $userId = Auth::guard('user')->id();

        // Check if the user has already voted for this product
        $existingVote = VotedProducts::where('suggest_product_id', $productId)
            ->where('user_id', $userId)
            ->first();

        // Check the user's VotingCount
        $votingCount = VotingCount::where('user_id', $userId)->first();

        if ($existingVote) {
            // Remove the vote
            $existingVote->delete();

            // Decrement the product's vote count
            $product = SuggestProduct::find($productId);
            $product->decrement('total_vote_count');

            // Increment the user's remaining vote count
            $votingCount->increment('remaining_vote_count');

            session()->flash('message', 'Your vote has been removed!');
        } else {
            if (!$votingCount || $votingCount->remaining_vote_count <= 0) {
                session()->flash('error', 'You have no remaining votes.');
                return;
            }

            // Add the vote
            VotedProducts::create([
                'suggest_product_id' => $productId,
                'user_id' => $userId,
                'is_voted' => true,
            ]);

            // Increment the product's vote count
            $product = SuggestProduct::find($productId);
            $product->increment('total_vote_count');

            // Decrement the user's remaining vote count
            $votingCount->decrement('remaining_vote_count');

            session()->flash('message', 'Your vote has been cast!');
        }

        // Reload the product list
        $this->loadSuggestedProducts();

        $this->dispatch('update_charts');
    }

    public function render()
    {
        return view('livewire.consumer.suggested-product-poll', [
            'suggestedProducts' => $this->suggestedProducts,
        ]);
    }
}
