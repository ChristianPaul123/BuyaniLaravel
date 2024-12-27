<?php

namespace App\Livewire\Blocks;

use App\Models\Payment;
use Livewire\Component;

class AdminPendingPayments extends Component
{

    public $pendingPayments;

    public function mount()
    {
        $this->pendingPayments = Payment::where('payment_status', 'pending')->count();
    }
    public function render()
    {
        return view('livewire.blocks.admin-pending-payments');
    }
}
