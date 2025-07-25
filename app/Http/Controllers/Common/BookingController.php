<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Tour;
use App\Notifications\BookingCreatedNotification;
use App\Services\StripeService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Config;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    // Show the public booking form
    public function showForm()
    {
        $tours = Tour::all();
        return view('common.booking', compact('tours'));
    }

    // Handle booking form submission and initiate payment
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'guests' => 'required|integer|min:1',
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required|date|after:today',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        $tour = Tour::findOrFail($validated['tour_id']);
        $totalPrice = $tour->price * $validated['guests'];

        // Create a booking with status unpaid
        $booking = Booking::create([
            'user_id' => null, // guest
            'tour_id' => $tour->id,
            'booking_date' => $validated['booking_date'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'guest_name' => $validated['name'],
            'guest_email' => $validated['email'],
            'guest_phone' => $validated['phone'],
            'special_requests' => $validated['special_requests'] ?? null,
        ]);

        // Create Stripe payment intent
        $paymentIntent = $this->stripeService->createPaymentIntent($booking);
        $stripeKey = config('services.stripe.key');
        return view('common.payment.checkout', compact('booking', 'tour', 'paymentIntent', 'stripeKey'));
    }

    // Handle Stripe webhook or payment confirmation
    public function paymentSuccess(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $booking = Booking::findOrFail($bookingId);
        $booking->update(['payment_status' => 'paid', 'status' => 'completed']);

        // Generate PDF invoice
        $pdf = PDF::loadView('invoices.booking_invoice', compact('booking'));
        $invoicePath = 'invoices/booking_' . $booking->id . '.pdf';
        Storage::put('public/' . $invoicePath, $pdf->output());
        $booking->invoice_path = $invoicePath;
        $booking->save();

        // Send notifications with invoice attached
        $admin = \App\Models\User::whereHas('roles', function($q){ $q->where('slug', 'admin'); })->first();
        $invoiceFullPath = storage_path('app/public/' . $invoicePath);
        // To customer
        \Mail::send([], [], function ($message) use ($booking, $invoiceFullPath) {
            $message->to($booking->guest_email)
                ->subject('Booking Payment Successful')
                ->setBody('Thank you for your payment. Please find your invoice attached.')
                ->attach($invoiceFullPath);
        });
        // To admin
        if ($admin) {
            \Mail::send([], [], function ($message) use ($admin, $booking, $invoiceFullPath) {
                $message->to($admin->email)
                    ->subject('New Booking Payment Completed')
                    ->setBody('A new booking has been completed. Invoice attached.')
                    ->attach($invoiceFullPath);
            });
        }

        return view('common.payment.success', compact('booking', 'invoicePath'));
    }

    public function paymentCancel()
    {
        return view('common.payment.cancel');
    }
} 