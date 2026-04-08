<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSearchController;
use App\Http\Controllers\PublicCourseController;
use App\Http\Controllers\StudentEnquiryController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PublicInquiryController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================
// Homepage
// ============================
Route::get('/', function () {
    return view('home');
})->name('home');

// ============================
// Authentication
// ============================
// Registration
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'resetPassword'])->name('forgot.password.submit');

// ============================
// Dashboards
// ============================
Route::get('/admin-dashboard', fn () => view('admin-dashboard'))->name('admin.dashboard');
Route::get('/student-dashboard', fn () => view('student-dashboard'))->name('student.dashboard');
Route::get('/instructor-dashboard', fn () => view('instructor-dashboard'))->name('instructor.dashboard');
Route::get('/admin-instructor', fn () => view('admin-instructor'))->name('admin.instructor');
Route::get('/admin-notice', fn () => view('admin-notice'))->name('admin.notice');
Route::get('/instructor-notice', fn () => view('instructor-notice'))->name('instructor.notice');
Route::get('/instructor-assignments', fn () => view('instructor-assignments'))->name('instructor.assignments');
Route::get('/student-news', fn () => view('student-news'))->name('student.news');
Route::get('/home-news', fn () => view('home-news'))->name('home.news');

// ============================
// Admin: Manage Courses, Categories & Locations
// ============================
Route::get('/manage-courses', [AdminController::class, 'manageCourses'])->name('manage-courses');

// Category CRUD
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{catid}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Location CRUD
Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::post('/locations', [LocationController::class, 'store'])->name('locations.store');
Route::delete('/locations/{locid}', [LocationController::class, 'destroy'])->name('locations.destroy');

// ============================
// Instructor Profile
// ============================
Route::get('/instructor/profile', [InstructorProfileController::class, 'index'])->name('instructor.profile');
Route::post('/instructor/profile', [InstructorProfileController::class, 'store'])->name('instructor.profile.store');
Route::put('/instructor/profile/{id}', [InstructorProfileController::class, 'update'])->name('instructor.profile.update');

// ============================
// Courses (Admin CRUD)
// ============================
Route::resource('courses', CourseController::class);

// ============================
// Public Courses for Students
// ============================
Route::get('/student-course', [CourseSearchController::class, 'index'])->name('student.course');
Route::get('/courses-public', [PublicCourseController::class, 'index'])->name('courses.public');

// ============================
// Public Contact Form (anyone)
// ============================
Route::get('/contact-us', [PublicInquiryController::class, 'index'])->name('contactus.public');
Route::post('/contact-us', [PublicInquiryController::class, 'store'])->name('inquiries.store.public');

// ============================
// Authenticated Routes
// ============================

// Student-specific routes
Route::middleware(['auth'])
    ->prefix('student')->name('student.')->group(function () {
        Route::get('/enquiries', [StudentEnquiryController::class, 'index'])->name('enquiries');
        Route::post('/enquiries', [StudentEnquiryController::class, 'store'])->name('enquiries.store');

        // 🔹 New StudentController Routes
        Route::get('/course-register', [StudentController::class, 'showRegisterForm'])->name('course.register');
        Route::post('/course-register', [StudentController::class, 'storeRegistration'])->name('storeRegistration');
        Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    });

// Admin-specific routes
Route::middleware(['auth'])
    ->prefix('admin')->name('admin.')->group(function () {
        Route::get('/inquiries', [AdminController::class, 'showInquiries'])->name('inquiries');
    });

// Instructor-specific routes
Route::middleware(['auth'])
    ->prefix('instructor')->name('instructor.')->group(function () {
        Route::get('/inquiries', [InstructorController::class, 'showInquiries'])->name('inquiries');
    });
