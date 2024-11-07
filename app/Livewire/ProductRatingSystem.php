<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;

class ProductRatingSystem extends Component
{
    public $productId;
    public $ratings;
    public $ratingValue = 0; // for filtering
    public $comment = '';
    public $newRating = 0;

    private $user;

    public function mount($productId)
    {
        $this->user = Auth::guard('user')->user();
        $this->productId = $productId;
        $this->loadRatings();
    }

    public function loadRatings()
    {
        $this->ratings = ProductRating::where('product_id', $this->productId)
            ->when($this->ratingValue > 0, function ($query) {
                $query->where('rating', $this->ratingValue);
            })
            ->with('user')
            ->latest()
            ->get();
    }

    public function addRating()
    {
        // Validate new rating and comment inputs
        $this->validate([
            'newRating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Ensure user is authenticated
        if (!Auth::guard('user')->check()) {

            session()->flash('message', 'You must be logged in');
        }

        // Create new rating record
        $productrating = ProductRating::create([
            'product_id' => $this->productId,
            'user_id' =>Auth::guard('user')->user()->id, // Assuming the user is authenticated
            'rating' => $this->newRating,
            'comment' => $this->comment,
            'admin_id' => null,
        ]);

        // Reset input fields

        $this->reset(['newRating', 'comment']);
        // Reload ratings
        $this->loadRatings();
    }

    public function updatedRatingValue()
    {
        // Refresh ratings on filter change
        $this->loadRatings();
    }

    public function render()
    {
        return view('livewire.product-rating-system', [
            'ratings' => $this->ratings,
            'user' => $this->user,
        ]);
    }

}
