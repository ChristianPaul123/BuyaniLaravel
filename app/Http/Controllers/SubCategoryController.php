<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{

     public function showSubcategories()
     {
         // show all Subcategories
           $subcategories = SubCategory::all();
           $categories = Category::all();
          // Pass two variables 'subcategories' and 'categories' to the view
          //dd(['subcategories' => $subcategories, 'categories' => $categories]);
           return view('admin.product.subcategory', ['subcategories' =>$subcategories, 'categories' => $categories]);
     }


   // Add a new category in the admin Subcategory page
   public function addSubCategory(Request $request)
   {

       // Validate the request data
       try {
           $validatedData = $request->validate([
            'category_id' => ['required'],
           'sub_category_name' => ['required',  Rule::unique('sub_categories', 'sub_category_name'),'max:200'],
           // Add other validation rules as necessary
       ]);
       } catch (\Illuminate\Validation\ValidationException $e) {
           return redirect()->route('admin.subcategory')->withErrors($e->errors());
       }

       // Create the category
       SubCategory::create($validatedData);
       return redirect()->route('admin.subcategory')->with('message', 'Subcategory added successfully.');
   }

   // Show the form to edit an existing Subcategory in the admin Subcategory page
   public function editSubCategory($subcategory)
   {

       // Find the Subcategory by id
       $subcategory = SubCategory::findOrFail($subcategory);

       //Return the view with the Subcategory
       return view('admin.product.edit-subcategory', ['subcategory' => $subcategory]);
   }

   // Update the Subcategory in the admin product Subcategory page
   public function updateSubCategory($subcategory, Request $request)
   {

       // Validate the request data
       try {
           $validatedData = $request->validate([
           'sub_category_name' => ['required',  Rule::unique('sub_categories', 'sub_category_name'),'max:200'],
           // Add other validation rules as necessary
       ]);
       } catch (\Illuminate\Validation\ValidationException $e) {
           return redirect()->route('admin.subcategory.edit',['subcategory' => $subcategory])->withErrors($e->errors());
       }
       // Replace $subcategory with Category::findOrFail($category)
       $subcategory = SubCategory::findOrFail($subcategory);
       $subcategory->update($validatedData);
       return redirect()->route('admin.subcategory')->with('message', 'SubCategory updated successfully.');
   }

   // Delete a category in the admin product subcategory page
   public function deleteSubCategory($subcategory)
   {
       // Your logic to delete the subcategory
       try {
        $subcategory = SubCategory::findOrFail($subcategory);
       } catch (\Illuminate\Validation\ValidationException $e) {
           return redirect()->route('admin.subcategory')->withErrors($e->errors());
       }
        $subcategory->delete();
       return redirect()->route('admin.subcategory')->with('message', 'SubCategory deleted successfully.');
   }
}
