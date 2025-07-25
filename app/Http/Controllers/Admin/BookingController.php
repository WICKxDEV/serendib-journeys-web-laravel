<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'tour'])
            ->latest()
            ->paginate(15);
        
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereHas('roles', function($query) {
            $query->where('slug', 'customer');
        })->get();
        $tours = Tour::all();
        $guides = User::whereHas('roles', function($query) {
            $query->where('slug', 'tour-guide');
        })->get();
        return view('admin.bookings.create', compact('users', 'tours', 'guides'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required|date|after:today',
            'guests' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,cancelled',
            'payment_status' => 'required|in:unpaid,paid,refunded',
            'guide_id' => 'nullable|exists:users,id',
        ]);

        Booking::create($request->all());

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load(['user', 'tour']);
        return view('admin.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $users = User::whereHas('roles', function($query) {
            $query->where('slug', 'customer');
        })->get();
        $tours = Tour::all();
        $guides = User::whereHas('roles', function($query) {
            $query->where('slug', 'tour-guide');
        })->get();
        return view('admin.bookings.edit', compact('booking', 'users', 'tours', 'guides'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required|date',
            'guests' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,cancelled',
            'payment_status' => 'required|in:unpaid,paid,refunded',
            'guide_id' => 'nullable|exists:users,id',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    /**
     * Change booking status (approve/cancel/refund)
     */
    public function changeStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:approved,cancelled',
            'payment_status' => 'required|in:paid,refunded',
        ]);

        $booking->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        $statusMessage = $request->status === 'approved' ? 'approved' : 'cancelled';
        
        return redirect()->route('admin.bookings.index')
            ->with('success', "Booking {$statusMessage} successfully.");
    }
}

