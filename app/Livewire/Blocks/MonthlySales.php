<?php

namespace App\Livewire\Blocks;

use Carbon\Carbon;
use App\Models\Payment;
use Livewire\Component;
use App\Models\ProductSales;

class MonthlySales extends Component
{

    public $pendingPayments;

    public function mount()
    {

       // Get the sum of total_sales grouped by month
       $this->pendingPayments = ProductSales::whereMonth('date', Carbon::now()->month)
       ->whereYear('date', Carbon::now()->year)
       ->sum('total_sales');
    }

    public function render()
    {
        return view('livewire.blocks.monthly-sales');
    }
}
