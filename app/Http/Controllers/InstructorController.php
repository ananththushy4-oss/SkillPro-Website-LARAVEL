<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    /**
     * Display inquiries related to the courses taught by the logged-in instructor.
     */
    public function showInquiries()
    {
        // 1. Get logged-in user’s instructor profile
        $instructor = Auth::user()->instructor;

        if (!$instructor) {
            abort(403, 'You are not registered as an instructor.');
        }

        // 2. Get the IDs of the courses this instructor teaches
        $courseIds = $instructor->courses()->pluck('courses.id');

        // 3. Fetch inquiries for those courses
        $inquiries = Inquiry::with('course')
                            ->whereIn('course_id', $courseIds)
                            ->latest()
                            ->get();

        // 4. Return the inquiries view
        return view('instructorinquiries', compact('inquiries'));
    }
}
