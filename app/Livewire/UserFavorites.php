<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;

class UserFavorites extends Component
{
    public $favorites; // To store favorite products
    public $message = null; // Feedback message

    public function mount()
    {
        try {
            // Fetch user favorites
            $this->favorites = Favorite::with(['product'])->where('user_id', Auth::guard('user')->user()->id)->get();

            if ($this->favorites->isEmpty()) {
                $this->message = "You don't have any favorites at the moment.";
            }
        } catch (\Exception $e) {
            $this->message = "An error occurred while fetching your favorites. Please try again later.";
        }
    }

    public function viewProduct($productId)
    {
        // Redirect to the product detail page
        return redirect()->route('user.consumer.product.view', $productId);
    }



    public function removeFavorite($favoriteId)
    {
        try {
            $favorite = Favorite::findOrFail($favoriteId);
            $favorite->delete();

            $this->favorites = $this->favorites->filter(fn ($fav) => $fav->id !== $favoriteId);
            if ($this->favorites->isEmpty()) {
                $this->message = "You don't have any favorites at the moment.";
            } else {
                $this->message = "Favorite removed successfully.";
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->message = "The selected favorite could not be found.";
        } catch (\Exception $e) {
            $this->message = "An error occurred while removing the favorite.";
        }
    }

    public function render()
    {
        return view('livewire.user-favorites', [
            'favorites' => $this->favorites,
            'message' => $this->message,
        ]);
    }
}
