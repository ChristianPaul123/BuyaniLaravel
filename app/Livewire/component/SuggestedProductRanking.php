<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\SuggestProduct;
use Livewire\Attributes\On;

class SuggestedProductRanking extends Component
{
    public $chartLabels = [];
    public $chartData = [];

    public function mount()
    {
        $this->updateChartData();
    }

    #[On('update_charts')]
    public function updateChartData()
    {
        // Fetch products sorted by vote count
        // Fetch products sorted by vote count, exclude products with 0 votes
    $products = SuggestProduct::where('total_vote_count', '>', 0)
    ->orderBy('total_vote_count', 'desc')
    ->get();

        // Prepare chart data
        $this->chartLabels = $products->pluck('suggest_name')->toArray();
        $this->chartData = $products->pluck('total_vote_count')->toArray();


        // dispatch data for the chart to the chart js
        $this->dispatch('chartUpdated', $this->chartLabels, $this->chartData);
    }

    // #[On('update_charts')]
    // public function chartUpdateLoad() {
    //     $this->updateChartData();
    // }

    public function render()

    {

        return view('livewire.component.suggested-product-ranking');
    }
}
