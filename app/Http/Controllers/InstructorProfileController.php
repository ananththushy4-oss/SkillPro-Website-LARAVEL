<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;

class InstructorProfileController extends Controller
{
    // Show the form with existing profile (if exists) for logged-in instructor
    public function index()
    {
        $user = Auth::user(); // get currently logged-in user
        $instructor = $user->instructor; // get the instructor profile linked to this user

        return view('instructor-profile', compact('instructor'));
    }

    // Store new profile
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'photo' => 'required|url',
            'description' => 'required|string',
        ]);

        // Link the new profile to the logged-in user
        $user = Auth::user();
        $instructor = new Instructor($validated);
        $instructor->user_id = $user->id; // associate profile with logged-in user
        $instructor->save();

        return redirect()->back()->with('success', 'Profile created successfully!')
                                 ->with('instructor', $instructor);
    }

    // Update existing profile for logged-in instructor
    public function update(Request $request)
    {
        $user = Auth::user();
        $instructor = $user->instructor; // get the profile of logged-in user

        if (!$instructor) {
            return redirect()->back()->with('error', 'Profile not found!');
        }

        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'photo' => 'required|url',
            'description' => 'required|string',
        ]);

        $instructor->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
