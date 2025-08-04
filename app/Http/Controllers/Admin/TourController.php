<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tours', 'public');
                $images[] = $path;
            }
        }

        $data['images'] = $images;
        Tour::create($data);
        
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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $images = $tour->images_array ?? [];

        if ($request->hasFile('images')) {
            // Delete old images if new ones are uploaded
            foreach ($images as $oldImage) {
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('tours', 'public');
                $images[] = $path;
            }
        }

        $data['images'] = $images;
        $tour->update($data);
        
        return redirect()->route('admin.tours.index')->with('success', 'Tour updated.');
    }

    public function destroy(Tour $tour)
    {
        // Delete associated images
        if ($tour->images) {
            foreach ($tour->images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $tour->delete();
        return redirect()->route('admin.tours.index')->with('success', 'Tour deleted.');
    }
}
