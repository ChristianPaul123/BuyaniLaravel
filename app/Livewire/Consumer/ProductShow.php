<?php


namespace App\Livewire\Consumer;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\SubCategory;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProductShow extends Component
{
    use WithPagination;

    public $subcategory; // For selected subcategory
    public $category;    // For selected category
    public $searchQuery; // For search input
    public $searchFilter; // For search
    public $message = null;     // For user feedback
    public $currentChunkIndex = 0; // Current chunk index for category carousel navigation
    public $filteredCategoryId = null;   // Store selected category ID
    public $filteredSubcategoryId = null; // Store selected subcategory ID
    public $action;

    public $title = 'All Products'; // Default title

    protected $paginationTheme = 'bootstrap'; // Use Bootstrap styling for pagination

    public function resetProducts()
    {
        // Reset the product list
        $this->reset(['subcategory', 'category', 'searchQuery', 'searchFilter', 'filteredCategoryId', 'filteredSubcategoryId','action']);
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
                $this->dispatch('toggleFavorites');
            } else {
                // Add to favorites
                Favorite::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                ]);
                $this->message = "Product added to favorites.";
                $this->dispatch('toggleFavorites');
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
            $this->action = 1;
            $category = Category::findOrFail($categoryId);
            $this->filteredCategoryId = $categoryId; // Set the filtered category
            $this->filteredSubcategoryId = null;     // Reset subcategory filter
            $this->category = $category;
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
            $this->action = 2;
            $subcategory = SubCategory::findOrFail($subcategoryId);
            $this->filteredSubcategoryId = $subcategoryId; // Set the filtered subcategory
            $this->filteredCategoryId = null;
            $this->subcategory = $subcategory;         // Reset category filter
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
            if (!empty($this->searchQuery)) {
                $this->action = 3;

                $this->searchFilter = $this->searchQuery;
                $this->title = "Search results for '{$this->searchFilter}'";
            } else {
                // Clear search and show all products
                $this->searchFilter = null;
                $this->title = 'All Products';
            }
            $this->message = null;
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
        // dd('y im returning products');
        $encryptedId = Crypt::encrypt($productId);
        $this->redirectRoute('user.consumer.product.view', $encryptedId);
    }

    public function render()
    {

        $categories = Category::with('subcategories')->get();
        $categoriesChunked = $categories->chunk(5);

        // Initialize query
        $query = Product::query();

        // If a category is filtered
        if ($this->action == 1) {
            $query->where('product_status', 1)
                  ->where('category_id', $this->filteredCategoryId);
            $this->title = "Products in {$this->category->category_name}";
        }
        // If a subcategory is filtered
        else if ($this->action == 2) {
            $query->where('product_status', 1)
                  ->where('subcategory_id', $this->filteredSubcategoryId);
            $this->title = "Products in {$this->subcategory->sub_category_name}";
        }
        // If a search filter is applied
        else if ($this->action == 3) {
            $this->reset(['subcategory', 'category','filteredSubcategoryId','filteredCategoryId']);
            $query->where('product_status', 1)
                  ->where('product_name', 'like', '%' . $this->searchFilter . '%');
            $this->title = "Search results for '{$this->searchFilter}'";// Clear search query after applying filter
        }
        // Default: Show all products
        else {
            $query->where('product_status', 1);
            $this->title = "All Products";
        }

        // Paginate the products
        $products = $query->paginate(8);

        // Check for out-of-stock condition
        $this->checkOutOfStock($products);

        $userFavorites = Auth::guard('user')->check() ? Favorite::where('user_id', Auth::guard('user')->id())->pluck('product_id')->toArray() : [];

        return view('livewire.consumer.product-show', [
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


        // try {
        //     if (!empty($this->searchQuery) && strlen($this->searchQuery) >= 3) {
        //         $this->searchFilter = $this->searchQuery;
        //         $this->filteredCategoryId = null;        // Reset category filter
        //         $this->filteredSubcategoryId = null;     // Reset subcategory filter
        //         $this->title = "Search results for '{$this->searchFilter}'"; // Update title
        //         $this->message = null;
        //         $this->searchQuery = null;

        //         // $this->dispatch('clear-input');// Reset message
        //     } else {
        //         $this->message = 'Please enter at least 3 characters for the search query.';
        //     }
        // } catch (\Exception $e) {
        //     $this->message = 'An unexpected error occurred while searching for products.';
        // }

              // $categories = Category::with('subcategories')->get();
        // $categoriesChunked = $categories->chunk(5);

        // // Build query for products
        // $query = Product::where('product_status', 1);

        // if ($this->filteredCategoryId) {
        //     $query->where('category_id', $this->filteredCategoryId);
        // }

        // if ($this->filteredSubcategoryId) {
        //     $query->where('subcategory_id', $this->filteredSubcategoryId);
        // }

        // if (!empty($this->searchFilter)) {
        //     $query->where('product_name', 'like', '%' . $this->searchFilter . '%');
        // }

        // if (empty($this->searchFilter)) {
        //     $query = Product::where('product_status', 1);
        // }
