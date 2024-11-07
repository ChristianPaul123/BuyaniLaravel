@extends('layouts.app') <!-- Extending the parent layout -->

@section('title', 'Show Cart Page') <!-- Defining a title for this view -->

@push('styles')
<style>
    .small-input {
        width: 80px; /* Adjust this value to change the width */
    }
</style>
@endpush
@section('content')
     @include('user.includes.navbar-consumer')

    <!-- Placeholder for AJAX Messages -->
    @livewire('user-cart',['cart' => $cart]);
@endsection

@section('scripts')
{{-- <script>
    function updateQuantity(cartItemId, action) {
        let inputField = document.getElementById('numberInput' + cartItemId);
        let currentQuantity = parseInt(inputField.value);
        // Determine new quantity based on action
        let newQuantity = action === 'increment' ? currentQuantity + 1 : currentQuantity - 1;
        // Ensure new quantity is at least 1
        if (newQuantity < 1) return;

        // Calculate total weight
        let totalWeight = calculateTotalWeight();

        // Check if adding exceeds the limit
        if (totalWeight + {{ $item->product_specification->product_kg }} > 25) {
            alert('Only 25 kg per customer is available');
            return;
        }

        // Send AJAX request to update cart item
        fetch(`/user/consumer/cart/item/${cartItemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                quantity: newQuantity
            })
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Failed to update quantity');
            }
        })
        .then(data => {
            if (data.success) {
                inputField.value = newQuantity;
                showMessage(data.message);  // Display success message
            } else {
                showMessage(data.message, 'danger');  // Display error message if any
            }})
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function calculateTotalWeight() {
        let totalWeight = 0;
        document.querySelectorAll('[id^="numberInput"]').forEach(input => {
            let quantity = parseInt(input.value);
            let productWeight = {{ $item->product_specification->product_kg }};
            totalWeight += quantity * productWeight;
        });
        return totalWeight;
    }

    // Function to show the message in an alert div
    function showMessage(message, type = 'success') {
        let messageDiv = document.getElementById('ajaxMessage');
        if (!messageDiv) {
            messageDiv = document.createElement('div');
            messageDiv.id = 'ajaxMessage';
            messageDiv.className = 'alert alert-' + type;
            messageDiv.innerHTML = `
                <button type="button" class="close btn btn-${type}" onclick="hideMessage()">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span id="messageContent"></span>
            `;
            document.body.prepend(messageDiv);  // Insert the message at the top
        }
        document.getElementById('messageContent').textContent = message;
        messageDiv.classList.remove('d-none');
        setTimeout(hideMessage, 5000);  // Hide after 5 seconds
    }

    function hideMessage() {
        const messageDiv = document.getElementById('ajaxMessage');
        if (messageDiv) messageDiv.classList.add('d-none');
    }
</script> --}}
@endsection
