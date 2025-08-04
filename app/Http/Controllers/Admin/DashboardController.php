<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;
use App\Models\Blog;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Get basic statistics
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $approvedBookings = Booking::where('status', 'approved')->count();
        $totalRevenue = Booking::where('payment_status', 'paid')->sum('total_price');
        $totalUsers = User::whereHas('roles', function($query) {
            $query->where('slug', 'customer');
        })->count();
        $totalTours = Tour::count();
        $totalBlogs = Blog::count();
        $totalGuides = Guide::where('is_active', true)->count();

        // Get monthly booking data for chart
        $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // Fill in missing months with 0
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $monthlyBookings[$i] ?? 0;
        }

        // Get monthly revenue data
        $monthlyRevenue = Booking::selectRaw('MONTH(created_at) as month, SUM(total_price) as revenue')
            ->whereYear('created_at', date('Y'))
            ->where('payment_status', 'paid')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('revenue', 'month')
            ->toArray();

        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[] = $monthlyRevenue[$i] ?? 0;
        }

        // Get booking status distribution
        $bookingStatusData = Booking::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Get recent bookings
        $recentBookings = Booking::with(['user', 'tour'])
            ->latest()
            ->take(5)
            ->get();

        // Get top tours by bookings
        $topTours = Tour::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'approvedBookings',
            'totalRevenue',
            'totalUsers',
            'totalTours',
            'totalBlogs',
            'totalGuides',
            'monthlyData',
            'revenueData',
            'bookingStatusData',
            'recentBookings',
            'topTours'
        ));
    }
}
