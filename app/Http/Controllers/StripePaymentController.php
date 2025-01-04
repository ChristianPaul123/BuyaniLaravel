<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class StripePaymentController extends Controller
{
    public function charge(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
            'stripeToken' => 'required',
        ]);

        // Set the Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create or retrieve a Stripe customer
            $customer = Customer::create([
                'email' => $request->email,
                'source' => $request->stripeToken, // Token from the frontend
            ]);

            // Charge the customer
            Charge::create([
                'customer' => $customer->id,
                'amount' => $request->input('amount') * 100, // Amount in cents
                'currency' => 'php', // Set currency to PHP (Philippine Peso)
                'description' => 'Payment for Order',
            ]);

            return response()->json(['message' => 'Payment successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment failed: ' . $e->getMessage()], 500);
        }
    }

    public function showForm()
    {
        // Pass the Stripe public key to the view
        return view('charge', ['stripeKey' => env('STRIPE_KEY')]);
    }
}
