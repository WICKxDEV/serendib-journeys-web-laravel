<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        // Get approved reviews with user and tour information
        $reviews = Review::with(['user', 'tour'])
            ->where('rating', '>=', 4) // Only show 4+ star reviews
            ->latest()
            ->take(6)
            ->get();

        // Get featured tours
        $featuredTours = Tour::with('destination')
            ->latest()
            ->take(6)
            ->get();

        // Get popular destinations
        $destinations = Destination::withCount('tours')
            ->orderBy('tours_count', 'desc')
            ->take(8)
            ->get();

        // Get settings for dynamic content
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('common.home', compact('reviews', 'featuredTours', 'destinations', 'settings'));
    }
}
