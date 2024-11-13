<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class UserProduct extends Component
{


    public $categories;
    public $products;
    public $subcategory;
    public $category;
    public $searchQuery;
    public $message;

    public function mount()
    {
        $this->categories = Category::with('subcategories')->get();
        $this->products = Product::where('product_status', 1)->get();
    }


    public function filterByCategory($categoryId)
    {
    try  {
        $category = Category::findOrFail($categoryId);
        $this->products = Product::where('category_id', $category->id)->get();

        $this->message = $this->products->isEmpty() ? 'No products available for this category.' : null;

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        $this->message = 'The category you are looking for does not exist.';

    } catch (\Exception $e) {
        $this->message = 'An error occurred while filtering products by category.';
    }
    }

    public function filterBySubcategory($subcategoryId)
    {
        try {
            $subcategory = SubCategory::findOrFail($subcategoryId);  // Ensures subcategory exists
            $this->products = Product::where('subcategory_id', $subcategory->id)
                ->where('product_status', 1)
                ->get();

            $this->message = $this->products->isEmpty() ? 'No products available for this subcategory.' : null;

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->message = 'The subcategory you are looking for does not exist.';

        } catch (\Exception $e) {
            $this->message = 'An error occurred while filtering products by subcategory.';
        }    }



        public function searchConsumerProduct()
        {


            try {
                // Validate only if searchQuery is present
                if (!empty($this->searchQuery) && strlen($this->searchQuery) >= 3) {
                    $this->products = Product::where('product_name', 'like', '%' . $this->searchQuery . '%')
                        ->where('product_status', 1)
                        ->get();

                    // Set message based on search results
                    $this->message = $this->products->isEmpty()
                        ? "No products found for '{$this->searchQuery}'."
                        : null;
                } else {
                    $this->message = 'Please enter at least 3 characters for the search query.';
                }
            } catch (\Exception $e) {
                $this->message = 'An unexpected error occurred while searching for products.';
            }
        }

        public function viewProduct($productId)
        {
            return redirect()->route('user.consumer.product.view', $productId);
        }

        public function render()
        {
            return view('livewire.user-product', [
                'categories' => $this->categories,
                'products' => $this->products,
                'category' => $this->category,
                'subcategory' => $this->subcategory
            ]);
        }
}
