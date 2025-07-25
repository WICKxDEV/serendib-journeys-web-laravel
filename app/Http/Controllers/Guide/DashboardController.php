<?php

namespace App\Http\Controllers\Guide;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('guide_id', Auth::id())->with(['user', 'tour'])->get();
        return view('guide.dashboard', compact('bookings'));
    }
} 