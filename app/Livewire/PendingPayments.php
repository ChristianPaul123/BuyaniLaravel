<?php

namespace App\Livewire;

use App\Models\Payment;
use Livewire\Component;

class PendingPayments extends Component
{

    public $pendingPayments;

    public function mount()
    {
        $this->pendingPayments = Payment::where('payment_status', 'pending')->count();
    }
    public function render()
    {
        return view('livewire.pending-payments');
    }
}
