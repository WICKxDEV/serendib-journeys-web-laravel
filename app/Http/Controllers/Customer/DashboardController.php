<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Review;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        
        // Get booking statistics
        $totalBookings = Booking::where('user_id', $user->id)->count();
        $activeBookings = Booking::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'pending'])
            ->count();
        
        // Get total spent
        $totalSpent = Booking::where('user_id', $user->id)
            ->where('payment_status', 'paid')
            ->sum('total_price');
        
        // Get reviews count
        $reviewsCount = Review::where('user_id', $user->id)->count();
        
        // Get recent bookings
        $recentBookings = Booking::with(['tour', 'guide'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        // Get recent reviews
        $recentReviews = Review::with('tour')
            ->where('user_id', $user->id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('customer.dashboard', compact(
            'totalBookings',
            'activeBookings', 
            'totalSpent',
            'reviewsCount',
            'recentBookings',
            'recentReviews'
        ));
    }
}
