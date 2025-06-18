<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

use App\Models\Tour;
use Illuminate\Http\Request;

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

        Booking::create([
            'user_id' => auth()->id(),
            'tour_id' => $tour->id,
            'status' => 'pending',
            'total_price' => $tour->price * $request->guests,
            'guests' => $request->guests,
        ]);

        return redirect()->route('customer.bookings.index')->with('success', 'Tour booked successfully! Await confirmation.');
    }
}

