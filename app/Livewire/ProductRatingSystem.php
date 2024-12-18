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
