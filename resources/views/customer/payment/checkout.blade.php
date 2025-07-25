@extends('layouts.customer')

@section('title', 'Payment Checkout')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded-lg border-0" style="border-top: 4px solid #3db320;">
                    <div class="card-header text-white" style="background: #3db320; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                        <h4 class="mb-0 fw-bold">Payment Checkout</h4>
                    </div>
                    <div class="card-body p-4">
                        <!-- Booking Summary -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <h5 class="fw-bold text-success" style="color: #3db320 !important;">Tour Details</h5>
                                <p class="mb-1"><strong>Tour:</strong> {{ $tour->name }}</p>
                                <p class="mb-1"><strong>Date:</strong> {{ $booking->booking_date }}</p>
                                <p class="mb-1"><strong>Guests:</strong> {{ $booking->guests }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="fw-bold text-success" style="color: #3db320 !important;">Payment Summary</h5>
                                <p class="mb-1"><strong>Price per person:</strong> ${{ number_format($tour->price, 2) }}</p>
                                <p class="mb-1"><strong>Total Amount:</strong> <span class="fw-bold" style="color: #3db320;">${{ number_format($booking->total_price, 2) }}</span></p>
                            </div>
                        </div>
                        <hr>
                        <!-- Payment Form -->
                        <form id="payment-form" action="{{ route('customer.payment.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name="payment_intent_id" id="payment_intent_id">
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            <div class="mb-3">
                                <label for="card-element" class="form-label fw-semibold">Credit or debit card</label>
                                <div id="card-element" class="form-control">
                                    <!-- Stripe Elements will be inserted here -->
                                </div>
                                <div id="card-errors" class="text-danger mt-2" role="alert"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-3" id="submit-button" style="background:#3db320; border-color:#3db320; font-weight:600;">
                                <span id="button-text">Pay ${{ number_format($booking->total_price, 2) }}</span>
                                <div class="spinner d-none" id="spinner"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>
<script>
// Initialize Stripe
const stripe = Stripe('{{ config("services.stripe.key") }}');
const elements = stripe.elements();
// Create card element
const card = elements.create('card', {
    style: {
        base: {
            fontSize: '16px',
            color: '#424770',
            '::placeholder': {
                color: '#aab7c4',
            },
        },
        invalid: {
            color: '#9e2146',
        },
    },
});
// Mount the card element
card.mount('#card-element');
// Handle form submission
const form = document.getElementById('payment-form');
const submitButton = document.getElementById('submit-button');
const spinner = document.getElementById('spinner');
const buttonText = document.getElementById('button-text');
form.addEventListener('submit', async (event) => {
    event.preventDefault();
    // Disable the submit button to prevent multiple submissions
    submitButton.disabled = true;
    spinner.classList.remove('d-none');
    buttonText.classList.add('d-none');
    const { paymentIntent, error } = await stripe.confirmCardPayment('{{ $paymentIntent->client_secret }}', {
        payment_method: {
            card: card,
            billing_details: {
                name: '{{ auth()->user()->name }}',
            },
        },
    });
    if (error) {
        // Show error message
        const errorElement = document.getElementById('card-errors');
        errorElement.textContent = error.message;
        // Re-enable the submit button
        submitButton.disabled = false;
        spinner.classList.add('d-none');
        buttonText.classList.remove('d-none');
    } else {
        // Payment succeeded
        document.getElementById('payment_intent_id').value = paymentIntent.id;
        form.submit();
    }
});
// Handle card element errors
card.addEventListener('change', ({error}) => {
    const displayError = document.getElementById('card-errors');
    if (error) {
        displayError.textContent = error.message;
    } else {
        displayError.textContent = '';
    }
});
</script>
<style>
.spinner {
    border: 2px solid #f3f3f3;
    border-top: 2px solid #3db320;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 1s linear infinite;
    display: inline-block;
}
.btn-primary {
    background: #3db320 !important;
    border-color: #3db320 !important;
}
.btn-primary:hover, .btn-primary:focus {
    background: #31991a !important;
    border-color: #31991a !important;
}
#card-element {
    padding: 12px;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
}
</style>
@endsection 