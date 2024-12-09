<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SuggestProduct;
use Illuminate\Support\Facades\Auth;

class ProductVotingSystem extends Component
{
    public $suggestedProducts = []; // Hold suggested products data
    public $productName, $category, $description, $image; // Input fields for the form

    //backend logic for the canvas js
    public $chartLabels = [];
    public $chartData = [];
    public function mount()
    {
        // Fetch all suggested products
        $this->suggestedProducts = SuggestProduct::orderBy('total_vote_count', 'desc')->get();
        // $this->loadChartData();
        $this->updateChartData();
    }

    public function updateChartData()
    {
        // Fetch products sorted by vote count
        $products = SuggestProduct::orderBy('total_vote_count', 'desc')->get();
        $this->suggestedProducts = $products;

        // Prepare chart data
        $this->chartLabels = $products->pluck('suggest_name');
        $this->chartData = $products->pluck('total_vote_count');

        // Emit data for the chart
        $this->dispatch('chartUpdated', $this->chartLabels, $this->chartData);
    }

    // public function loadChartData()
    // {
    //     $products = SuggestProduct::orderBy('total_vote_count', 'desc')->get();

    //     $this->suggestedProducts = $products;

    //     $labels = $products->pluck('suggest_name')->toArray();
    //     $data = $products->pluck('total_vote_count')->toArray();

    //     $this->dispatch('chartUpdated', $labels, $data);
    // }

    public function submitSuggestion()
    {
        // Validate inputs
        $this->validate([
            'productName' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Image is optional
        ]);

        // Store the suggested product
        SuggestProduct::create([
            'user_id' => Auth::guard('user')->id(),
            'verified_by' => null, // Initially null
            'suggest_name' => $this->productName,
            'suggest_description' => $this->description,
            'suggest_image' => $this->image ? $this->image->store('suggestions') : null,
            'total_vote_count' => 0, // Default vote count
            'is_accepted' => false, // Default status
        ]);

        // Refresh the list of suggested products
        $this->mount();

        // Clear form inputs
        $this->reset(['productName', 'category', 'description', 'image']);

        // Add success message
        session()->flash('message', 'Product suggested successfully!');
    }

    public function render()
    {
        return view('livewire.product-voting-system', [
            'suggestedProducts' => $this->suggestedProducts,
        ]);
    }
}
