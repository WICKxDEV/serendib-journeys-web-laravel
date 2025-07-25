<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Services\StripeService;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function checkout(Tour $tour, Request $request)
    {
        $request->validate([
            'guests' => 'required|integer|min:1|max:10',
            'booking_date' => 'required|date|after:today',
        ]);

        try {
            DB::beginTransaction();

            // Create booking first
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'tour_id' => $tour->id,
                'booking_date' => $request->booking_date,
                'guests' => $request->guests,
                'total_price' => $tour->price * $request->guests,
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            // Create payment intent
            $paymentIntent = $this->stripeService->createPaymentIntent($booking);

            DB::commit();

            return view('customer.payment.checkout', compact('booking', 'tour', 'paymentIntent'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment checkout failed: ' . $e->getMessage());
            
            return redirect()->back()->with('error', 'Unable to process payment. Please try again.');
        }
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_intent_id' => 'required|string',
            'booking_id' => 'required|exists:bookings,id'
        ]);

        try {
            $booking = Booking::findOrFail($request->booking_id);
            
            // Verify the booking belongs to the authenticated user
            if ($booking->user_id !== auth()->id()) {
                return redirect()->route('customer.bookings.index')->with('error', 'Unauthorized access.');
            }

            // Process the payment
            $success = $this->stripeService->processPayment($request->payment_intent_id, $booking);

            if ($success) {
                return redirect()->route('customer.payment.success')->with('success', 'Payment successful! Your booking has been confirmed.');
            } else {
                return redirect()->route('customer.payment.cancel')->with('error', 'Payment failed. Please try again.');
            }

        } catch (\Exception $e) {
            Log::error('Payment processing failed: ' . $e->getMessage());
            return redirect()->route('customer.payment.cancel')->with('error', 'Payment processing failed. Please contact support.');
        }
    }

    public function success(Request $request)
    {
        return view('customer.payment.success');
    }

    public function cancel()
    {
        return view('customer.payment.cancel');
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\Exception $e) {
            Log::error('Webhook signature verification failed: ' . $e->getMessage());
            return response('Webhook signature verification failed', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $this->handlePaymentSucceeded($paymentIntent);
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                $this->handlePaymentFailed($paymentIntent);
                break;
            default:
                Log::info('Unhandled event type: ' . $event->type);
        }

        return response('Webhook received', 200);
    }

    private function handlePaymentSucceeded($paymentIntent)
    {
        try {
            $bookingId = $paymentIntent->metadata->booking_id ?? null;
            
            if ($bookingId) {
                $booking = Booking::find($bookingId);
                if ($booking) {
                    $this->stripeService->processPayment($paymentIntent->id, $booking);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error handling payment succeeded webhook: ' . $e->getMessage());
        }
    }

    private function handlePaymentFailed($paymentIntent)
    {
        try {
            $bookingId = $paymentIntent->metadata->booking_id ?? null;
            
            if ($bookingId) {
                $booking = Booking::find($bookingId);
                if ($booking) {
                    $booking->update([
                        'payment_status' => 'failed',
                        'status' => 'cancelled'
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error handling payment failed webhook: ' . $e->getMessage());
        }
    }
}
