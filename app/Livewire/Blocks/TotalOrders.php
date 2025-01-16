<?php

namespace App\Livewire\Blocks;

use App\Models\Order;
use Livewire\Component;

class TotalOrders extends Component
{
    public $totalOrders;

    public function mount()
    {

        //this changes to order deliver
        $this->totalOrders = Order::where('order_status', 1)
                                  ->count();
    }
    public function render()
    {
        return view('livewire.blocks.total-orders');
    }
}
