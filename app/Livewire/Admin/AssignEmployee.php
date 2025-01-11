<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class AssignEmployee extends Component
{
    /**
     * The state of the if the component is in edit mode
     * @var bool
     */
    public bool $isEditing = false;

    /**
     * The state of the if the component is disabled
     * @var bool
     */
    public bool $isDisabled = false;

    /**
     * The ID of the order to which the employee is assigned.
     *
     * @var int
     */
    public int $orderId;

    /**
     * The name of the employee to be assigned.
     *
     * @var string
     */
    public string $employeeName = '';

    /**
     * Mount the component with the given order ID.
     *
     * This method is called when the component is initialized. It sets the order ID
     * and loads the order details. If the order has an assigned delivery employee,
     * it sets the employee name.
     *
     * @param int $orderId The ID of the order to be loaded.
     * @return void
     */
    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->isDisabled = $this->viabilityCheck();
        // Load the order and check if it has an assigned delivery employee
        $order = Order::find($this->orderId);
        if ($order && $order->delivery_employee) {
            $this->employeeName = $order->delivery_employee;
        }
    }

    /**
     * Assigns an employee to an order.
     *
     * This method validates the employee name, finds the order by its ID,
     * assigns the employee to the order, and saves the changes.
     * It also sets the editing state to false after the assignment.
     *
     * @return void
     */
    public function assignEmployee()
    {
        $this->validate([
            'employeeName' => 'required|string',
        ]);

        $order = Order::find($this->orderId);
        $order->delivery_employee = $this->employeeName;
        $order->save();

        $this->isEditing = false;
    }

    /**
     * Toggles the editing state.
     *
     * This method switches the value of the $isEditing property
     * between true and false. When called, if $isEditing is true,
     * it will be set to false, and vice versa.
     *
     * @return void
     */
    public function toggleEdit()
    {
        $this->isEditing = !$this->isEditing;
    }

    /**
     * Render the Livewire component view for assigning an employee.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.assign-employee');
    }

    /**
     * Check the viability of an order based on its status.
     *
     * This method retrieves an order using the provided order ID and checks if the order exists.
     * It then verifies that the order's status is not one of the disabled statuses:
     * - STATUS_STANDBY
     * - STATUS_TO_PAY
     * - STATUS_COMPLETED
     * - STATUS_CANCELLED
     *
     * @return bool Returns true if the order exists and its status is not one of the disabled statuses, false otherwise.
     */
    private function viabilityCheck(){
        $order = Order::find($this->orderId);
        // Check if the order exists and its status is not one of the disabled statuses
        return $order && !in_array($order->order_status, [
            Order::STATUS_STANDBY,
            Order::STATUS_TO_PAY,
            Order::STATUS_COMPLETED,
            Order::STATUS_CANCELLED
        ]);
    }    
}
