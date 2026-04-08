<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class PublicInquiryController extends Controller
{
    /**
     * Show enquiry form with dynamic courses
     */
    public function index()
    {
        $courses = Course::orderBy('name')->get();
        return view('contactus', compact('courses')); // lowercase blade filename
    }

    /**
     * Handle enquiry submission
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:20',
            'course_id' => 'required|exists:courses,id',
            'message'   => 'required|string|max:1000',
        ]);

        Inquiry::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'course_id' => $request->course_id,
            'message'   => $request->message,
        ]);

        return back()->with('success', 'Thank you! Your inquiry has been submitted successfully. We will contact you soon.');
    }
}
