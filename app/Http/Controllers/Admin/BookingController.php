<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use App\Models\Guide;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'tour', 'guide']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('guest_name', 'LIKE', "%{$search}%")
                  ->orWhere('guest_email', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%")
                                ->orWhere('email', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('tour', function($tourQuery) use ($search) {
                      $tourQuery->where('title', 'LIKE', "%{$search}%")
                                ->orWhereHas('destination', function($destQuery) use ($search) {
                                    $destQuery->where('name', 'LIKE', "%{$search}%");
                                });
                  });
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Payment status filter
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->where('booking_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('booking_date', '<=', $request->date_to);
        }

        $bookings = $query->latest()->paginate(15);
        
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
        $guides = Guide::where('is_active', true)->get();
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
            'guide_id' => 'nullable|exists:guides,id',
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
        $guides = Guide::where('is_active', true)->get();
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
            'guide_id' => 'nullable|exists:guides,id',
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

