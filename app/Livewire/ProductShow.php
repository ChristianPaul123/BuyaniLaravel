<?php


namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\SubCategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ProductShow extends Component
{
    use WithPagination;

    public $subcategory; // For selected subcategory
    public $category;    // For selected category
    public $searchQuery; // For search input
    public $searchFilter; // For search
    public $message;     // For user feedback
    public $currentChunkIndex = 0; // Current chunk index for category carousel navigation
    public $filteredCategoryId = null;   // Store selected category ID
    public $filteredSubcategoryId = null; // Store selected subcategory ID

    public $title = 'All Products'; // Default title

    public function mount()
    {
        $this->message = null;
    }

    public function updatingCurrentPage()
    {
        // Reset pagination when current page changes
        $this->resetPage();
    }

    public function toggleFavorite($productId)
    {
        try {
            $userId = Auth::guard('user')->id();

            if (!$userId) {
                $this->message = "Please log in to add products to favorites.";
                return;
            }

            $favorite = Favorite::where('user_id', $userId)->where('product_id', $productId)->first();

            if ($favorite) {
                // If favorite exists, remove it
                $favorite->delete();
                $this->message = "Product removed from favorites.";
            } else {
                // Add to favorites
                Favorite::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                ]);
                $this->message = "Product added to favorites.";
            }
        } catch (\Exception $e) {
            $this->message = "An error occurred while updating favorites.";
        }
    }

    private function checkOutOfStock($query)
    {
        if ($query->total() === 0) {
            $this->message = "Sorry, no products are available at the moment.";
        } else {
            $this->message = null;
        }
    }

    public function filterByCategory($categoryId)
    {
        try {
            $category = Category::findOrFail($categoryId);
            $this->filteredCategoryId = $categoryId; // Set the filtered category
            $this->filteredSubcategoryId = null;     // Reset subcategory filter
            $this->title = "Products in {$category->category_name}"; // Update title
            $this->message = null;                  // Reset message

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->message = 'The category you are looking for does not exist.';
        } catch (\Exception $e) {
            $this->message = 'An error occurred while filtering products by category.';
        }
    }

    public function filterBySubcategory($subcategoryId)
    {
        try {
            $subcategory = SubCategory::findOrFail($subcategoryId);
            $this->filteredSubcategoryId = $subcategoryId; // Set the filtered subcategory
            $this->filteredCategoryId = null;             // Reset category filter
            $this->title = "Products in {$subcategory->sub_category_name}"; // Update title
            $this->message = null;                        // Reset message

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->message = 'The subcategory you are looking for does not exist.';
        } catch (\Exception $e) {
            $this->message = 'An error occurred while filtering products by subcategory.';
        }
    }

    public function searchConsumerProduct()
    {
        try {
            if (!empty($this->searchQuery) && strlen($this->searchQuery) >= 3) {
                $this->searchFilter = $this->searchQuery;
                $this->filteredCategoryId = null;        // Reset category filter
                $this->filteredSubcategoryId = null;     // Reset subcategory filter
                $this->title = "Search results for '{$this->searchFilter}'"; // Update title
                $this->message = null;
                $this->searchQuery = null;

                // $this->dispatch('clear-input');// Reset message
            } else {
                $this->message = 'Please enter at least 3 characters for the search query.';
            }
        } catch (\Exception $e) {
            $this->message = 'An unexpected error occurred while searching for products.';
        }
    }

    public function previousChunk()
    {
        if ($this->currentChunkIndex > 0) {
            $this->currentChunkIndex--;
        }
    }

    public function nextChunk()
    {
        $categoriesChunked = Category::with('subcategories')->get()->chunk(5);
        if ($this->currentChunkIndex < $categoriesChunked->count() - 1) {
            $this->currentChunkIndex++;
        }
    }

    public function viewProduct($productId)
    {
        // Redirect to a specific product view page
        return redirect()->route('user.consumer.product.view', $productId);
    }

    public function render()
    {
        $categories = Category::with('subcategories')->get();
        $categoriesChunked = $categories->chunk(5);

        // Build query for products
        $query = Product::where('product_status', 1);

        if ($this->filteredCategoryId) {
            $query->where('category_id', $this->filteredCategoryId);
        }

        if ($this->filteredSubcategoryId) {
            $query->where('subcategory_id', $this->filteredSubcategoryId);
        }

        if (!empty($this->searchFilter) && strlen($this->searchFilter) >= 3) {
            $query->where('product_name', 'like', '%' . $this->searchFilter . '%');
        }

        // Paginate the products
        $products = $query->paginate(8);

        // Check for out-of-stock condition
        $this->checkOutOfStock($products);

        $userFavorites = Auth::guard('user')->check() ? Favorite::where('user_id', Auth::guard('user')->id())->pluck('product_id')->toArray() : [];


        return view('livewire.product-show', [
            'categories' => $categories,
            'categoriesChunked' => $categoriesChunked,
            'products' => $products,
            'message' => $this->message,
            'currentChunkIndex' => $this->currentChunkIndex,
            'title' => $this->title, // Pass the title to the view
            'userFavorites' => $userFavorites,
        ]);
    }
}

