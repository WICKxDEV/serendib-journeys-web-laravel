<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Tour;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function checkout(Tour $tour, Request $request)
    {
        $request->validate(['guests' => 'required|integer|min:1']);

        $price = $tour->price * $request->guests;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => $tour->title],
                    'unit_amount' => $tour->price * 100,
                ],
                'quantity' => $request->guests,
            ]],
            'mode' => 'payment',
            'success_url' => route('customer.payment.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('customer.payment.cancel', [], true),
        ]);

        // Temp store in session or DB for later use:
        session(['booking_data' => [
            'tour_id' => $tour->id,
            'guests' => $request->guests,
            'total_price' => $price
        ]]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $bookingData = session('booking_data');

        Booking::create([
            'user_id' => auth()->id(),
            'tour_id' => $bookingData['tour_id'],
            'status' => 'confirmed',
            'total_price' => $bookingData['total_price'],
            'guests' => $bookingData['guests'],
        ]);

        session()->forget('booking_data');

        return redirect()->route('customer.bookings.index')->with('success', 'Payment successful! Booking confirmed.');
    }

    public function cancel()
    {
        return redirect()->route('customer.bookings.index')->with('error', 'Payment canceled.');
    }
}
