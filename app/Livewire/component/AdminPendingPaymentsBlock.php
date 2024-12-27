<?php

namespace App\Livewire\Component;

use App\Models\Payment;
use Livewire\Component;

class AdminPendingPaymentsBlock extends Component
{

    public $pendingPayments;

    public function mount()
    {
        $this->pendingPayments = Payment::where('payment_status', 'pending')->count();
    }
    public function render()
    {
        return view('livewire.component.admin-pending-payments-block');
    }
}