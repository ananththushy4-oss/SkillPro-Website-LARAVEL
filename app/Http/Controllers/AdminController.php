<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Location;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Inquiry; // Import Inquiry model

class AdminController extends Controller
{
    /**
     * Display the admin manage courses page.
     */
    public function manageCourses()
    {
        // Fetch all categories, locations, instructors, and courses
        $categories  = Category::all();
        $locations   = Location::all();
        $instructors = Instructor::all();
        $courses     = Course::with(['instructors', 'locations', 'categories'])->get();

        // Pass all data to the view
        return view('manage-courses', compact('categories', 'locations', 'instructors', 'courses'));
    }

    /**
     * Display all inquiries for admin (newest first).
     */
    public function showInquiries()
    {
        // Fetch all inquiries with course relation
        $inquiries = Inquiry::with('course')->latest()->get();

        // Return to admin inquiries blade file
        return view('Admininquiries', ['inquiries' => $inquiries]);
    }
}
