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
        $this->products = Product::where('category_id', $categoryId);

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
            $this->products = Product::where('subcategory_id', $subcategoryId)
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
            $this->validate([
                'searchQuery' => 'required|string|min:3'
            ]);

            $this->products = Product::where('product_name', 'LIKE', '%' . $this->searchQuery . '%')
                ->where('product_status', 1)
                ->get();

            $this->message = $this->products->isEmpty() ? "No products found for '{$this->searchQuery}'." : null;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->message = 'Please enter a valid search query.';
        } catch (\Exception $e) {
            $this->message = 'An error occurred while searching for products.';
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