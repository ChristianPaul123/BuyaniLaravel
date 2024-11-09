<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\ShowModelCommand;

class ProductCategory extends Component
{
    public $showAddCategoryModal = false;
    public $showAddSubcategoryModal = false;

    public $showEditCategoryModal = false;
    public $showEditSubcategoryModal = false;

    public $editingCategoryId = null;
    public $editingSubcategoryId = null;
    public $category_name;
    public $sub_category_name;
    public $category_id;
    public $categories;
    public $subcategories;

    public $modalmessage;

    public function mount()
    {
        $this->fetchCategories();
        $this->fetchSubcategories();
    }

    // Fetching categories with fresh data
    public function fetchCategories()
    {
        $this->categories = Category::with('subcategories')->get();
    }

    // Fetching subcategories with fresh data
    public function fetchSubcategories()
    {
        $this->subcategories = Subcategory::with('category')->get();
    }

    public function deleteCategory($id)
    {
        if ($category = Category::find($id)) {
            $category->delete();
            $this->fetchCategories();

            session()->flash('modalerror', 'Category has been successfully deleted');

        }
    }

    public function deleteSubcategory($id)
    {
        if ($subcategory = Subcategory::find($id)) {
            $subcategory->delete();
            $this->fetchSubcategories();

            session()->flash('modalerror', 'Subcategory has been successfully deleted');

        }
    }

    public function showcategoryModal()
    {
        $this->reset(['category_name']); // Reset modal fields
        $this->showAddCategoryModal = true;
    }

    public function showsubcategoryModal()
    {
        $this->reset(['sub_category_name', 'category_id']); // Reset modal fields
        $this->showAddSubcategoryModal = true;
    }

    public function showEditCatModal($id)
    {
        $category = Category::findOrFail($id);
        $this->editingCategoryId = $id;
        $this->category_name = $category->category_name;
        $this->showEditCategoryModal = true;
    }

    public function updateCategory()
    {
        $this->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $this->editingCategoryId,
        ]);

        Category::where('id', $this->editingCategoryId)->update([
            'category_name' => $this->category_name,
        ]);

        session()->flash('modalmessage', 'Category updated successfully.');
        $this->closeModal();
        $this->fetchCategories();
    }

    public function showEditSubcatModal($id)
    {

        // dd('showEditSubcategoryModal');
        $subcategory = Subcategory::findOrFail($id);
        $this->editingSubcategoryId = $id;
        $this->sub_category_name = $subcategory->sub_category_name;
        $this->category_id = $subcategory->category_id;
        $this->showEditSubcategoryModal = true;
    }

    public function updateSubcategory()
    {
        $this->validate([
            'sub_category_name' => 'required|string|max:255|unique:sub_categories,sub_category_name,' . $this->editingSubcategoryId,
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::where('id', $this->editingSubcategoryId)->update([
            'sub_category_name' => $this->sub_category_name,
            'category_id' => $this->category_id,
        ]);

        session()->flash('modalmessage', 'Subcategory updated successfully.');
        $this->closeModal();
        $this->fetchSubcategories();
    }

    public function closeModal()
    {
        $this->reset(['showAddCategoryModal', 'showAddSubcategoryModal', 'showEditCategoryModal', 'showEditSubcategoryModal', 'category_name', 'sub_category_name', 'category_id', 'editingCategoryId', 'editingSubcategoryId']);
    }

    public function addCategory()
    {

        $this->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ]);

        Category::create(['category_name' => $this->category_name]);
        session()->flash('modalmessage', 'Category added successfully.');

        $this->closeModal();
        $this->fetchCategories(); // Refresh categories list

        $this->dispatchBrowserEvent('refreshDataTable');
    }

    public function addSubcategory()
    {
        $this->validate([
            'sub_category_name' => 'required|string|max:255|unique:sub_categories,sub_category_name',
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::create([
            'sub_category_name' => $this->sub_category_name,
            'category_id' => $this->category_id,
        ]);

        session()->flash('modalmessage', 'Subcategory added successfully.');

        $this->closeModal();
        $this->fetchSubcategories(); // Refresh subcategories list
    }

    public function render()
    {
        return view('livewire.product-category', [
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
        ]);
    }
}
