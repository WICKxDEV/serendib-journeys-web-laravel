<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::latest()->paginate(9);
        return view('common.package', compact('tours'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        $tour->load('reviews.user'); // Eager load reviews and the user who wrote them
        return view('tours.show', compact('tour'));
    }
}


