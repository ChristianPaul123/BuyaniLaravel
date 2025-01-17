<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class CategoryController extends Controller
{



    // Show the form to edit an existing category in the admin category page
    public function editCategory($category)
    {
        // Your logic to show the form for editing an existing category
        // Find the category by id
        try {
            $category = Category::findOrFail($category);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.category')->withErrors(['category' => 'Category not found.']);
        }

        //Return the view with the category
        return view('admin.product.edit-category', ['category' => $category]);
    }

    // Update the category in the admin product category page
    public function updateCategory($category, Request $request)
    {
        // Your logic to update the category
        // Validate the request data
        try {
            $validatedData = $request->validate([
            'category_name' => ['required',  Rule::unique('categories', 'category_name')->ignore($category),'max:200'],
            // Add other validation rules as necessary
        ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.category.edit',['category' => $category])->withErrors($e->errors());
        }
        // Replace $category with Category::findOrFail($category)
        $category = Category::findOrFail($category);
        // $category->dd();
        $category->update($validatedData);
        return redirect()->route('admin.category')->with('message', 'Category updated successfully.');
    }

    // Delete a category in the admin product category page
    public function deleteCategory($category)
    {
        // Your logic to delete the category
        try {
         $category = Category::findOrFail($category);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.category')->withErrors($e->errors());
        }
         $category->delete();
        return redirect()->route('admin.category')->with('message', 'Category deleted successfully.');
    }
}
