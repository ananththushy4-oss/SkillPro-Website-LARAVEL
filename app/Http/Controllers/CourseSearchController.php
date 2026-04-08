<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Location;
use App\Models\Instructor;

class CourseSearchController extends Controller
{
    /**
     * Display a listing of courses with search and filters.
     */
    public function index(Request $request)
    {
        // Eager load the PLURAL relationships as defined in your models
        $query = Course::with(['instructors', 'categories', 'locations']);

        // Handle name search
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        // Handle category filter using whereHas
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                // Filter by the primary key 'catid' from your Category model
                $q->where('categories.catid', $request->category);
            });
        }

        // Handle location filter using whereHas
        if ($request->filled('location')) {
            $query->whereHas('locations', function ($q) use ($request) {
                // Filter by the primary key 'locid' from your Location model
                $q->where('locations.locid', $request->location);
            });
        }

        // Handle instructor filter using whereHas
        if ($request->filled('instructor')) {
            $query->whereHas('instructors', function ($q) use ($request) {
                // Filter by the primary key 'id' from your Instructor model
                $q->where('instructors.id', $request->instructor);
            });
        }

        // Handle duration filter
        if ($request->filled('duration')) {
            $query->where('duration', $request->duration);
        }

        // Fetch the results
        $courses = $query->get();

        // Fetch data for the dropdowns
        $categories = Category::all();
        $locations = Location::all();
        $instructors = Instructor::all();

        return view('student-course', compact(
            'courses',
            'categories',
            'locations',
            'instructors'
        ));
    }
}