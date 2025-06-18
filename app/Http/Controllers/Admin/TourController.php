<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with('destination')->get();
        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        $destinations = Destination::all();
        return view('admin.tours.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'itinerary' => 'required',
            'available_from' => 'required|date',
            'available_to' => 'required|date|after_or_equal:available_from',
        ]);

        Tour::create($request->all());
        return redirect()->route('admin.tours.index')->with('success', 'Tour created.');
    }

    public function edit(Tour $tour)
    {
        $destinations = Destination::all();
        return view('admin.tours.edit', compact('tour', 'destinations'));
    }

    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'itinerary' => 'required',
            'available_from' => 'required|date',
            'available_to' => 'required|date|after_or_equal:available_from',
        ]);

        $tour->update($request->all());
        return redirect()->route('admin.tours.index')->with('success', 'Tour updated.');
    }

    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('admin.tours.index')->with('success', 'Tour deleted.');
    }
}
