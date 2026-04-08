<?php

namespace App\Http\Controllers;

use App\Models\Course;   // Import Course model
use App\Models\Inquiry;  // Import Inquiry model
use Illuminate\Http\Request;

class StudentEnquiryController extends Controller
{
    /**
     * Show enquiry form with dynamic courses
     */
    public function index()
    {
        $courses = Course::orderBy('name')->get(); // Fetch courses from DB
        return view('student-enquiries', compact('courses'));
    }

    /**
     * Handle enquiry submission
     */
    public function store(Request $request)
    {
        // Validate inputs
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:20',
            'course_id' => 'required|exists:courses,id', // must match existing course id
            'message'   => 'required|string|max:1000',
        ]);

        // Save enquiry into DB
        Inquiry::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'course_id' => $request->course_id,
            'message'   => $request->message,
        ]);

        // Redirect back with success message
        return back()->with('success', 'Your enquiry has been submitted successfully! We will get back to you soon.');
    }
}
