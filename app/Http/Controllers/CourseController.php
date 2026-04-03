<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Location;
use App\Models\Category;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // CORRECTED: Fetches all data required by the manage-courses view.
        $courses = Course::with(['instructors', 'locations', 'categories'])->get();
        $instructors = Instructor::all();
        $locations = Location::all();
        $categories = Category::all();

        // CORRECTED: Passes all variables to the view using compact().
        return view('manage-courses', compact('courses', 'instructors', 'locations', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = Instructor::all();
        $locations = Location::all();
        $categories = Category::all();

        return view('courses.create', compact('instructors', 'locations', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|unique:courses',
            'name' => 'required',
            'image_url' => 'nullable',
            'enroll_option' => 'required',
            'duration' => 'required',
            'description' => 'required',
            'instructors' => 'required|array',
            'locations' => 'required|array',
            'categories' => 'required|array',
        ]);

        // Create the course
        $course = Course::create($validated);

        // Attach relationships
        $course->instructors()->attach($request->instructors);
        $course->locations()->attach($request->locations);
        $course->categories()->attach($request->categories);

        return redirect()->route('manage-courses')->with('success', 'Course added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with(['instructors', 'locations', 'categories'])->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::with(['instructors', 'locations', 'categories'])->findOrFail($id);
        $instructors = Instructor::all();
        $locations = Location::all();
        $categories = Category::all();

        return view('manage-courses', compact('course', 'instructors', 'locations', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'course_id' => 'required|unique:courses,course_id,' . $course->id,
            'name' => 'required',
            'image_url' => 'nullable',
            'enroll_option' => 'required',
            'duration' => 'required',
            'description' => 'required',
            'instructors' => 'required|array',
            'locations' => 'required|array',
            'categories' => 'required|array',
        ]);

        $course->update($validated);

        // Sync relationships
        $course->instructors()->sync($request->instructors);
        $course->locations()->sync($request->locations);
        $course->categories()->sync($request->categories);

        return redirect()->route('manage-courses')->with('success', 'Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->instructors()->detach();
        $course->locations()->detach();
        $course->categories()->detach();
        $course->delete();

        return redirect()->route('manage-courses')->with('success', 'Course deleted successfully');
    }
}