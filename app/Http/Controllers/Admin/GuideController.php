<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guides = Guide::orderBy('name')->paginate(10);
        return view('admin.guides.index', compact('guides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'languages' => 'nullable|array',
            'languages.*' => 'string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'specializations' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('guides', 'public');
            $data['profile_photo'] = $path;
        }

        Guide::create($data);

        return redirect()->route('admin.guides.index')
            ->with('success', 'Guide created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guide $guide)
    {
        return view('admin.guides.show', compact('guide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guide $guide)
    {
        return view('admin.guides.edit', compact('guide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guide $guide)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'languages' => 'nullable|array',
            'languages.*' => 'string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'specializations' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($guide->profile_photo) {
                Storage::disk('public')->delete($guide->profile_photo);
            }
            $path = $request->file('profile_photo')->store('guides', 'public');
            $data['profile_photo'] = $path;
        }

        $guide->update($data);

        return redirect()->route('admin.guides.index')
            ->with('success', 'Guide updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guide $guide)
    {
        // Check if guide has any bookings
        if ($guide->bookings()->count() > 0) {
            return redirect()->route('admin.guides.index')
                ->with('error', 'Cannot delete guide with existing bookings.');
        }

        // Delete profile photo if exists
        if ($guide->profile_photo) {
            Storage::disk('public')->delete($guide->profile_photo);
        }

        $guide->delete();

        return redirect()->route('admin.guides.index')
            ->with('success', 'Guide deleted successfully.');
    }
}
