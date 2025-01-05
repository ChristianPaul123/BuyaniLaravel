{{-- bootstrap cdn --}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
{{-- stripe js --}}

<form id="payment-form" action="/charge" method="POST">
    @csrf
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="amount">Amount:</label>
    <input type="number" id="amount" name="amount" required>

    <label for="card-element">Credit or Debit Card:</label>
    <div class="form-control w-50" id="card-element"></div>
    {{-- <div id="card-element"></div> --}}
    <div id="card-errors" role="alert"></div>

    <button type="submit">Submit Payment</button>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ $stripeKey }}");
    const elements = stripe.elements();
    const card = elements.create("card");
    card.mount("#card-element");

    const form = document.getElementById("payment-form");
    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const { token, error } = await stripe.createToken(card);

        if (error) {
            // Display error in the form
            document.getElementById("card-errors").textContent = error.message;
        } else {
            // Add the token to the form and submit
            const hiddenInput = document.createElement("input");
            hiddenInput.setAttribute("type", "hidden");
            hiddenInput.setAttribute("name", "stripeToken");
            hiddenInput.setAttribute("value", token.id);
            form.appendChild(hiddenInput);

            form.submit();
        }
    });
</script>
