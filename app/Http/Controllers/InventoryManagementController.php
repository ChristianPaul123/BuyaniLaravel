<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InventoryManagementController extends Controller
{
    public function showProductInventory()
    {
      $products = Product::all();
      $inventories = Inventory::all();
       return view('admin.product.inventory', ['products'=>$products,'inventories' =>$inventories]);
    }

    public function addProductInventory(Request $request)
{

    $request->merge([
        'product_new_stock' => strip_tags($request->product_new_stock),
        'product_damage_stock' => strip_tags($request->product_damage_stock),
        'product_id' => strip_tags($request->product_id),
    ]);

    try {
        $validatedData = $request->validate([
            'product_id' => ['required','integer'],
            'product_new_stock' => ['required', 'numeric', 'min:0'],
            'product_damage_stock' => ['required', 'numeric', 'min:0'],
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->route('admin.product.inventory')->withErrors($e->errors());
    }

    $product = Product::findOrFail($request->product_id);

    if (!$product) {
        return redirect()->route('admin.product.inventory')->with('error', 'Product not found');
    }

    $inventory = Inventory::firstOrNew(['product_id' => $request->product_id]);

    $currentMonth = now()->month;
    $currentYear = now()->year;

    // Check if there's already an inventory record for the current month
    $previousInventory = Inventory::where('product_id', $request->product_id)
        ->whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->first();

    if ($previousInventory) {
        // Update the previous inventory record

        $previousInventory->product_old_stock = $previousInventory->product_new_stock + $previousInventory->product_old_stock;
        $previousInventory->product_new_stock = $request->input('product_new_stock');
        $previousInventory->product_damage_stock = $previousInventory->product_damage_stock + $request->input('product_damage_stock');
        $previousInventory->product_total_stock = $previousInventory->product_old_stock + $previousInventory->product_new_stock - $previousInventory->product_damage_stock;
        $previousInventory->save();
    } else {
        // Create a new inventory record
        $inventory->product_id = $request->product_id;
        $inventory->product_new_stock = $request->input('product_new_stock');
        $inventory->product_old_stock = 0;
        $inventory->product_total_stock = $inventory->product_new_stock;
        $inventory->product_damage_stock = $request->input('product_damage_stock');
        $inventory->save();
    }

    return redirect()->route('admin.product.inventory')->with('message', 'Inventory updated successfully');
}

    public function editProductInventory($inventory) {

        try {
            $inventory = Inventory::findOrFail($inventory);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.product.inventory')->withErrors(['inventory' => 'inventory not found.']);
        }
        $products = Product::all();
        return view('admin.product.edit-inventory', ['products'=>$products,'inventory' =>$inventory]);
    }

    public function updateProductInventory($inventory,Request $request){
      //from the adding of products hahaha. just tinkered as it's already a good logic
        $request->merge([
            'product_new_stock' => strip_tags($request->product_new_stock),
            'product_old_stock' => strip_tags($request->product_old_stock),
            'product_total_stock' => strip_tags($request->product_total_stock),
            'product_damage_stock' => strip_tags($request->product_damage_stock),
            'product_id' => strip_tags($request->product_id),
        ]);

        try {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'product_new_stock' => ['required', 'numeric', 'min:0'],
            'product_old_stock' => ['required', 'numeric', 'min:0'],
            'product_damage_stock' => ['required', 'numeric', 'min:0'],
        ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('admin.product.inventory')->withErrors($e->errors());
        }


        $inventory = Inventory::findOrFail($inventory);

        if (!$inventory) {
            return redirect()->route('admin.product.inventory')->with('error', 'Inventory not found');
        }

        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Check if there's already an inventory record for the current month
        $previousInventory = Inventory::where('product_id', $inventory->product_id)
                            ->whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $currentMonth)
                            ->first();

        if ($previousInventory) {
            // Update the previous inventory record
            $previousInventory->product_old_stock = $request->input('product_old_stock');
            $previousInventory->product_new_stock = $request->input('product_new_stock');
            $previousInventory->product_damage_stock = $request->input('product_damage_stock');
            $previousInventory->product_total_stock = $previousInventory->product_old_stock + $previousInventory->product_new_stock - $previousInventory->product_damage_stock;
            $previousInventory->save();
        }


        return redirect()->route('admin.product.inventory')->with('message', 'Inventory updated successfully');
    }

}

