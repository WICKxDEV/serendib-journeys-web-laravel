<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ServiceController extends Controller
{
    public function index()
    {
        // Get approved reviews with user and tour information
        $reviews = Review::with(['user', 'tour'])
            ->where('rating', '>=', 4) // Only show 4+ star reviews
            ->latest()
            ->take(6)
            ->get();

        return view('common.service', compact('reviews'));
    }
} 