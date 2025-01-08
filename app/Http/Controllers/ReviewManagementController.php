<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OrderRating;
use Illuminate\Http\Request;
use App\Models\ProductRating;

class ReviewManagementController extends Controller
{
    public function showReviews() {
        $productRatings = ProductRating::with('product','user')->get();
        $orderRatings = OrderRating::with('order','user')->get();
        return view('admin.community.review-index',compact('productRatings','orderRatings'));
    }

    public function orderRatingdeactivate($id) {
        $orderRatings = OrderRating::find($id);
        $orderRatings->deactivated_status = 1;
        $orderRatings->save();

        return redirect()->route('admin.reviews', ['tab' => 'orderreviews'])
        ->with('success','Order Rating Deactivated Successfully');

    }

    public function orderRatingactivate($id) {

        $orderRating = OrderRating::find($id);
        $orderRating->deactivated_status = 0;
        $orderRating->save();

        return redirect()->route('admin.reviews', ['tab' => 'orderreviews'])
        ->with('success','Order Rating Activated Successfully');

    }


    public function productRatingdeactivate($id) {

        $productRating = ProductRating::find($id);
        $productRating->deactivated_status = 1;
        $productRating->deactivated_date = now();
        $productRating->save();

        return redirect()->route('admin.reviews', ['tab' => 'productreviews'])
        ->with('success','Product Rating Deactivated Successfully');

    }

    public function productRatingactivate($id) {

        $productRating = ProductRating::find($id);
        $productRating->deactivated_status = 0;
        $productRating->deactivated_date = null;
        $productRating->save();

        return redirect()->route('admin.reviews', ['tab' => 'productreviews'])
        ->with('success','Product Rating Activated Successfully');


    }

    public function viewOrderReview($id) {
         $orderRating = OrderRating::with('order','user')->find($id);
         return view('admin.community.view-order-review',compact('orderRating'));
    }

    public function viewProductReview($id) {
        $productRating = ProductRating::with('product','user')->find($id);
        return view('admin.community.view-product-review',compact('productRating'));
    }

    public function updateProductReview($id, Request $request) {
        // Validate request data
        $request->validate([
            'deactivated_status' => 'required|boolean',
        ]);

        // Find the ProductRating by ID
        $productRating = ProductRating::findOrFail($id);

        // Update the fields
        $productRating->deactivated_status = $request->input('deactivated_status');

        $productRating->deactivated_date = $request->input('deactivated_status') == 1
        ? Carbon::now()
        : null;

    // Save the changes
    $productRating->save();

    // Redirect with success message
    // return redirect()->back()->with('success', 'Product Rating updated successfully!');
    return redirect()->route('admin.reviews', ['tab' => 'productreviews'])
    ->with('success','Product Rating Updated Successfully');

    }

    public function updateOrderReview($id, Request $request) {
        $request->validate([
            'deactivated_status' => 'required|boolean',
        ]);

        // Find the OrderRating by ID
        $orderRating = OrderRating::findOrFail($id);

        // Update the fields
        $orderRating->deactivated_status = $request->input('deactivated_status');
      // Set deactivated_date to current date if deactivated_status is 1, else set it to null
    $orderRating->deactivated_date = $request->input('deactivated_status') == 1
    ? Carbon::now()
    : null;

        // Save the changes
        $orderRating->save();

        // Redirect with success message
        return redirect()->route('admin.reviews', ['tab' => 'orderreviews'])
        ->with('success','Order Rating Updated Successfully');

        // return redirect()->back()->with('success', 'Order Rating updated successfully!');
    }
}
