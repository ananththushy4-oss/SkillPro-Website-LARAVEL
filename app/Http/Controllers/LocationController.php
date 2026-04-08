<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Show all locations
    public function index()
    {
        $locations = Location::all();
        return view('manage-courses', compact('locations')); 
        
    }

    // Store new location
    public function store(Request $request)
    {
        $request->validate([
            'locid' => 'required|unique:locations,locid',
            'location' => 'required',
            'image_url' => 'nullable|url'
        ]);

        Location::create([
            'locid' => $request->locid,
            'location' => $request->location,
            'image_url' => $request->image_url
        ]);

        return redirect()->back()->with('success', 'Location added successfully!');
    }

    // Delete location
    public function destroy($locid)
    {
        $location = Location::findOrFail($locid);
        $location->delete();

        return redirect()->back()->with('success', 'Location deleted!');
    }
}
