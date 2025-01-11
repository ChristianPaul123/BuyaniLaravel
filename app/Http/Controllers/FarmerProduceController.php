<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\FarmerProduce;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreFarmerProduceRequest;
use App\Http\Requests\UpdateFarmerProduceRequest;

class FarmerProduceController extends Controller
{


    public function showFarmerSupplyProduct() {
        if (!Auth::guard('user')->check()) {
            // If not authenticated, flush the session and redirect to user index with a message
            Session::flush();
            return redirect()->route('user.index')->with('message', 'Please log in or sign up to view this page');
        }

            // **************** NEW CODE: Fetch low stock products ****************
            $lowStockProducts = Product::with('inventory')
            ->whereHas('inventory', function($query) {
                $query->where('product_total_stock', '<', 50);
            })->get();
            // ->take(10) // or ->limit(10)
            


        // get all farmer produce
        $farmerProduce = FarmerProduce::where('user_id', Auth::guard('user')->user()->id)->get();

        return view('user.farmer.farmerproduce.show', compact('farmerProduce','lowStockProducts'));
    }

    public function saveFarmerSupplyProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produce_name' => 'required',
            'produce_description' => 'required',
            'produce_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'suggested_price' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $farmerProduce = new FarmerProduce();
        $farmerProduce->produce_name = $request->produce_name;
        $farmerProduce->produce_description = $request->produce_description;
        $farmerProduce->user_id = Auth::guard('user')->user()->id;
        $farmerProduce->suggested_price = $request->suggested_price;

        if ($request->hasFile('produce_image')) {
            $image = $request->file('produce_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/farmer_produce_images');

            // Check if the directory exists, and create it if it doesn't
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $name);
            $farmerProduce->produce_image = $name;
        }

        $farmerProduce->save();

        return response()->json(['success' => 'Product added successfully!']);
    }

    public function editProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:farmer_produces,id', // Validate if the product ID exists
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Fetch the farmer product by ID
        $farmerProduce = FarmerProduce::findOrFail($request->id);

        // Return the product data as JSON
        return response()->json([
            'produce_name' => $farmerProduce->produce_name,
            'produce_description' => $farmerProduce->produce_description,
            'suggested_price' => $farmerProduce->suggested_price,
            'produce_image' => $farmerProduce->produce_image,
        ]);
    }

    public function saveEditProduct(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:farmer_produces,id',
            'produce_name' => 'required',
            'produce_description' => 'required',
            'produce_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'suggested_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the farmer product
        $farmerProduce = FarmerProduce::findOrFail($request->id);

        // Update product details
        $farmerProduce->produce_name = $request->produce_name;
        $farmerProduce->produce_description = $request->produce_description;
        $farmerProduce->suggested_price = $request->suggested_price;

        // If a new image is uploaded, handle the image update
        if ($request->hasFile('produce_image')) {
            // Delete the old image if it exists
            if ($farmerProduce->produce_image && File::exists(public_path('farmer_produce_images/' . $farmerProduce->produce_image))) {
                File::delete(public_path('farmer_produce_images/' . $farmerProduce->produce_image));
            }

            // Handle the new image upload
            $image = $request->file('produce_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/farmer_produce_images');

            // Check if the directory exists, create it if it doesn't
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $name);
            $farmerProduce->produce_image = $name;
        }

        // Save the updated product
        $farmerProduce->save();

        // Return a success response
        return response()->json(['success' => 'Product updated successfully!']);
    }

    public function deleteProduct(Request $request)
    {
        // Validate the product ID is provided
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:farmer_produces,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the product by ID
        $farmerProduce = FarmerProduce::findOrFail($request->id);

        // Check if there's an image and delete it
        if ($farmerProduce->produce_image && File::exists(public_path('farmer_produce_images/' . $farmerProduce->produce_image))) {
            File::delete(public_path('farmer_produce_images/' . $farmerProduce->produce_image));
        }

        // Delete the product
        $farmerProduce->delete();

        return response()->json(['success' => 'Product deleted successfully!']);
    }
}
