<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Show the course registration page with filters
     */
    public function showRegisterForm(Request $request)
    {
        $user = Auth::user(); // logged-in student

        // Apply filters (search, category, location, duration, instructor)
        $query = Course::query()->with(['instructors', 'categories', 'locations']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('catid', $request->category);
            });
        }

        if ($request->filled('location')) {
            $query->whereHas('locations', function ($q) use ($request) {
                $q->where('locid', $request->location);
            });
        }

        if ($request->filled('duration')) {
            $query->where('duration', $request->duration);
        }

        if ($request->filled('instructor')) {
            $query->whereHas('instructors', function ($q) use ($request) {
                $q->where('id', $request->instructor);
            });
        }

        $courses     = $query->get();
        $categories  = \App\Models\Category::all();
        $locations   = \App\Models\Location::all();
        $instructors = \App\Models\Instructor::all();

        return view('student.course', compact('user', 'courses', 'categories', 'locations', 'instructors'));
    }

    /**
     * Store the selected course(s) for the student
     */
    public function storeRegistration(Request $request)
    {
        $request->validate([
            'course_id'   => 'required|array',
            'course_id.*' => 'exists:courses,id',
        ]);

        $user = Auth::user();

        // Attach multiple courses without removing old ones (no duplicates)
        $user->courses()->syncWithoutDetaching($request->course_id);

        return redirect()->route('student.profile')
                         ->with('success', 'Courses registered successfully!');
    }

    /**
     * Show the student profile with registered courses
     */
    public function profile()
    {
        $user = Auth::user();
        $courses = $user->courses()->with(['instructors', 'categories', 'locations'])->get();

        return view('student-profile', compact('user', 'courses'));
    }
}
