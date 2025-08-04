<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::orderBy('created_at', 'desc')->get();
        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        Activity::create($request->all());

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        $activity->load('tours');
        return view('admin.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $activity->update($request->all());

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        // Check if activity is used in any tours
        if ($activity->tours()->count() > 0) {
            return redirect()->route('admin.activities.index')
                ->with('error', 'Cannot delete activity as it is being used in ' . $activity->tours()->count() . ' tour(s).');
        }

        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity deleted successfully.');
    }

    /**
     * Toggle the status of the activity
     */
    public function toggleStatus(Activity $activity)
    {
        $activity->update(['is_active' => !$activity->is_active]);

        $status = $activity->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.activities.index')
            ->with('success', "Activity {$status} successfully.");
    }
}