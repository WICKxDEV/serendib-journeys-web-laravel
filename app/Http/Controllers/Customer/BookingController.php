<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Notifications\BookingCreatedNotification;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('tour')->get();
        return view('customer.bookings', compact('bookings'));
    }

    public function store(Request $request, Tour $tour)
    {
        $request->validate([
            'guests' => 'required|integer|min:1'
        ]);

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'tour_id' => $tour->id,
            'status' => 'pending',
            'total_price' => $tour->price * $request->guests,
            'guests' => $request->guests,
        ]);

        // Notify customer
        $booking->user->notify(new BookingCreatedNotification($booking));
        // Notify admin (first admin user)
        $admin = \App\Models\User::whereHas('roles', function($q){ $q->where('slug', 'admin'); })->first();
        if ($admin) {
            $admin->notify(new BookingCreatedNotification($booking));
        }

        return redirect()->route('customer.bookings.index')->with('success', 'Tour booked successfully! Await confirmation.');
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('customer.booking_show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        $this->authorize('update', $booking);
        if (in_array($booking->status, ['pending', 'approved'])) {
            $booking->update(['status' => 'cancelled']);
            return redirect()->route('customer.bookings.index')->with('success', 'Booking cancelled successfully.');
        }
        return redirect()->route('customer.bookings.index')->with('error', 'Cannot cancel this booking.');
    }

    public function create(Request $request, $tour = null)
    {
        $tourModel = null;
        if ($tour) {
            $tourModel = \App\Models\Tour::find($tour);
        }
        return view('customer.booking_create', ['tour' => $tourModel]);
    }
}

