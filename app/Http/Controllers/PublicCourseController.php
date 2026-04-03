<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Location;
use App\Models\Instructor; // Using your dedicated Instructor model

class PublicCourseController extends Controller
{
    /**
     * Display a public listing of courses with search and filters.
     */
    public function index(Request $request)
    {
        // Call the private method to get the filtered courses
        $courses = $this->getFilteredCourses($request);

        // Fetch data for the dropdowns
        $categories = Category::orderBy('category')->get();
        $locations = Location::orderBy('location')->get();
        $instructors = Instructor::orderBy('fullname')->get(); // Assuming 'fullname' is a column

        // Return the PUBLIC view we created earlier ('courses.blade.php')
        return view('courses', compact(
            'courses',
            'categories',
            'locations',
            'instructors'
        ));
    }

    /**
     * Private helper method to contain the core filtering logic.
     * This keeps the 'index' method clean and the logic reusable.
     */
    private function getFilteredCourses(Request $request)
    {
        // Eager load relationships
        $query = Course::with(['instructors', 'categories', 'locations']);

        // Handle name search
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        // Handle category filter
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.catid', $request->category);
            });
        }

        // Handle location filter
        if ($request->filled('location')) {
            $query->whereHas('locations', function ($q) use ($request) {
                $q->where('locations.locid', $request->location);
            });
        }

        // Handle instructor filter
        if ($request->filled('instructor')) {
            $query->whereHas('instructors', function ($q) use ($request) {
                $q->where('instructors.id', $request->instructor);
            });
        }

        // Handle duration filter
        if ($request->filled('duration')) {
            $query->where('duration', $request->duration);
        }

        // Fetch and return the results
        return $query->get();
    }
}