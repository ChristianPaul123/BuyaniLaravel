<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;

use Livewire\WithPagination;

class ProductRatingSystem extends Component
{
    use WithPagination;

    public $productId;
    public $temporaryRating = 0; // Temporary local rating for display
    public $ratingValue = 0; // For filtering
    public $comment = '';
    public $newRating = 0;
    public $averageRating;
    public $ratingBreakdown = [];

    protected $paginationTheme = 'bootstrap'; // Optional: Use Bootstrap for pagination styling

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->calculateRatingSummary();
    }

    public function calculateRatingSummary()
    {
        // Calculate average rating
        $this->averageRating = ProductRating::where('product_id', $this->productId)
            ->avg('rating');

        // Get breakdown of ratings
        $this->ratingBreakdown = ProductRating::where('product_id', $this->productId)
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->pluck('count', 'rating')
            ->toArray();
    }


    public function submitRating()
    {
        $this->newRating = $this->temporaryRating; // Finalize the rating

        $this->validate([
            'newRating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        if (!Auth::guard('user')->check()) {
            // Flash a message and return early if the user is not logged in
            session()->flash('message', 'You must be logged in to leave a review.');
            return;
        }


        // Save the rating
        ProductRating::create([
            'product_id' => $this->productId,
            'user_id' => auth()->guard('user')->user()->id,
            'rating' => $this->newRating,
            'comment' => $this->comment,
        ]);

        // Reset fields
        $this->reset(['temporaryRating', 'newRating', 'comment']);
        $this->calculateRatingSummary(); // Recalculate rating summary
        session()->flash('success', 'Your rating has been submitted successfully.');
    }

        public function addRating()
    {
        // Validate the input fields
        $this->validate([
            'newRating' => 'required|integer|min:1|max:5', // Ensure a valid rating is selected
            'comment' => 'nullable|string|max:500', // Optional comment
        ]);

        // Ensure the user is authenticated before proceeding
        if (!Auth::guard('user')->check()) {
            // Flash a message and return early if the user is not logged in
            session()->flash('message', 'You must be logged in to leave a review.');
            return;
        }

        // Check if the user has already rated this product (to prevent duplicate reviews)
        $existingRating = ProductRating::where('product_id', $this->productId)
            ->where('user_id', Auth::guard('user')->id())
            ->first();

        if ($existingRating) {
            session()->flash('message', 'You have already rated this product.');
            return;
        }

        // Save the new rating and comment to the database
        ProductRating::create([
            'product_id' => $this->productId, // Associate the rating with the product
            'user_id' => Auth::guard('user')->id(), // Associate the rating with the logged-in user
            'rating' => $this->newRating, // The selected rating value
            'comment' => $this->comment, // The optional comment
        ]);

        // Reset the rating and comment fields for a new submission
        $this->reset(['newRating', 'comment']);

        // Recalculate the average rating and breakdown after the new rating is added
        $this->calculateRatingSummary();

        // Flash a success message to notify the user
        session()->flash('success', 'Your rating has been submitted successfully.');
    }

    public function applyRatingFilter()
    {
        $this->resetPage(); // Reset to the first page when filtering
    }

    public function render()
    {
        $ratings = ProductRating::where('product_id', $this->productId)
            ->when($this->ratingValue > 0, function ($query) {
                $query->where('rating', $this->ratingValue);
            })
            ->with('user')
            ->latest()
            ->paginate(5);

        return view('livewire.product-rating-system', [
            'ratings' => $ratings,
            'averageRating' => number_format($this->averageRating, 1),
            'ratingBreakdown' => $this->ratingBreakdown,
        ]);
    }
}
