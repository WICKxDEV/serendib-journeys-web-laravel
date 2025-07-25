<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Create a payment intent for a booking
     */
    public function createPaymentIntent(Booking $booking)
    {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $booking->total_price * 100, // Convert to cents
                'currency' => 'usd',
                'metadata' => [
                    'booking_id' => $booking->id,
                    'tour_id' => $booking->tour_id,
                    'user_id' => $booking->user_id,
                ],
            ]);

            return $paymentIntent;
        } catch (ApiErrorException $e) {
            Log::error('Stripe payment intent creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Process a successful payment
     */
    public function processPayment($paymentIntentId, Booking $booking)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
            
            if ($paymentIntent->status === 'succeeded') {
                // Update booking payment status
                $booking->update([
                    'payment_status' => 'paid',
                    'status' => 'approved'
                ]);

                // Create payment record
                Payment::create([
                    'booking_id' => $booking->id,
                    'amount' => $booking->total_price,
                    'payment_method' => 'stripe',
                    'transaction_id' => $paymentIntentId,
                    'status' => 'completed',
                    'stripe_payment_intent_id' => $paymentIntentId,
                ]);

                return true;
            }

            return false;
        } catch (ApiErrorException $e) {
            Log::error('Stripe payment processing failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get payment intent details
     */
    public function getPaymentIntent($paymentIntentId)
    {
        try {
            return PaymentIntent::retrieve($paymentIntentId);
        } catch (ApiErrorException $e) {
            Log::error('Stripe payment intent retrieval failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Refund a payment
     */
    public function refundPayment($paymentIntentId, $amount = null)
    {
        try {
            $refundData = ['payment_intent' => $paymentIntentId];
            
            if ($amount) {
                $refundData['amount'] = $amount * 100; // Convert to cents
            }

            $refund = \Stripe\Refund::create($refundData);
            
            return $refund;
        } catch (ApiErrorException $e) {
            Log::error('Stripe refund failed: ' . $e->getMessage());
            throw $e;
        }
    }
} 