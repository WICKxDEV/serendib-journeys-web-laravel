<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Destination;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::with(['destination', 'destinations', 'activities'])->get();
        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        $destinations = Destination::all();
        $activities = Activity::where('is_active', true)->get();
        return view('admin.tours.create', compact('destinations', 'activities'));
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
            'additional_destinations' => 'nullable|array',
            'additional_destinations.*' => 'exists:destinations,id',
            'selected_activities' => 'nullable|array',
            'selected_activities.*' => 'exists:activities,id',
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
        $tour = Tour::create($data);

        // Sync additional destinations
        if ($request->has('additional_destinations')) {
            $destinationData = [];
            foreach ($request->additional_destinations as $index => $destinationId) {
                $destinationData[$destinationId] = ['order' => $index + 1];
            }
            $tour->destinations()->sync($destinationData);
        }

        // Sync activities
        if ($request->has('selected_activities')) {
            $activityData = [];
            foreach ($request->selected_activities as $index => $activityId) {
                $activityData[$activityId] = [
                    'order' => $index + 1,
                    'day' => $request->input("activity_day.{$activityId}", 1)
                ];
            }
            $tour->activities()->sync($activityData);
        }
        
        return redirect()->route('admin.tours.index')->with('success', 'Tour created.');
    }

    public function edit(Tour $tour)
    {
        $destinations = Destination::all();
        $activities = Activity::where('is_active', true)->get();
        $tour->load(['destinations', 'activities']);
        return view('admin.tours.edit', compact('tour', 'destinations', 'activities'));
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
            'additional_destinations' => 'nullable|array',
            'additional_destinations.*' => 'exists:destinations,id',
            'selected_activities' => 'nullable|array',
            'selected_activities.*' => 'exists:activities,id',
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

        // Sync additional destinations
        if ($request->has('additional_destinations')) {
            $destinationData = [];
            foreach ($request->additional_destinations as $index => $destinationId) {
                $destinationData[$destinationId] = ['order' => $index + 1];
            }
            $tour->destinations()->sync($destinationData);
        } else {
            $tour->destinations()->detach();
        }

        // Sync activities
        if ($request->has('selected_activities')) {
            $activityData = [];
            foreach ($request->selected_activities as $index => $activityId) {
                $activityData[$activityId] = [
                    'order' => $index + 1,
                    'day' => $request->input("activity_day.{$activityId}", 1)
                ];
            }
            $tour->activities()->sync($activityData);
        } else {
            $tour->activities()->detach();
        }
        
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
