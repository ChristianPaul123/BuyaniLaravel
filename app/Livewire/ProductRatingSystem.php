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

    public function addRating()
    {
        $this->validate([
            'newRating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        if (!Auth::guard('user')->check()) {
            session()->flash('message', 'You must be logged in to leave a review.');
            return;
        }

        ProductRating::create([
            'product_id' => $this->productId,
            'user_id' => Auth::guard('user')->id(),
            'rating' => $this->newRating,
            'comment' => $this->comment,
        ]);

        $this->reset(['newRating', 'comment']);
        $this->calculateRatingSummary();
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
            ->paginate(5); // Paginate results

        return view('livewire.product-rating-system', [
            'ratings' => $ratings,
            'averageRating' => number_format($this->averageRating, 1),
            'ratingBreakdown' => $this->ratingBreakdown,
        ]);
    }
}
