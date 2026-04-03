<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses | SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/studentcourse.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('images/SkillEdge.jpg') }}" alt="SkillPro Institute Logo" class="logo-image">
            <span class="logo-text">SkillPro Institute</span>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('courses.public') }}" class="active">Courses</a></li>
                <li><a href="{{ route('home.news') }}">News & Events</a></li>
                <li><a href="{{ route('contactus.public') }}">Contact Us</a></li>
            </ul>
        </nav>
        <a href="{{ url('/login') }}"><button class="logout-btn">Login</button></a>
    </header>

    <section class="filter-section">
        <h2>Find Your Perfect Course</h2>
        <form action="{{ route('courses.public') }}" method="GET" class="filter-form">
            <div class="search-bar-container">
                <input type="text" name="search" placeholder="Search courses by name..." value="{{ request('search') }}">
            </div>
            <div class="filter-controls">
                <select name="category">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->catid }}" {{ request('category') == $category->catid ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
                <select name="location">
                    <option value="">All Locations</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->locid }}" {{ request('location') == $location->locid ? 'selected' : '' }}>
                            {{ $location->location }}
                        </option>
                    @endforeach
                </select>
                <select name="duration">
                    <option value="">All Durations</option>
                    <option value="1 month" {{ request('duration') == '1 month' ? 'selected' : '' }}>1 Month</option>
                    <option value="3 months" {{ request('duration') == '3 months' ? 'selected' : '' }}>3 Months</option>
                    <option value="6 months" {{ request('duration') == '6 months' ? 'selected' : '' }}>6 Months</option>
                    <option value="12 months" {{ request('duration') == '12 months' ? 'selected' : '' }}>12 Months</option>
                </select>
                <select name="instructor">
                    <option value="">All Instructors</option>
                    @foreach($instructors as $instructor)
                        <option value="{{ $instructor->id }}" {{ request('instructor') == $instructor->id ? 'selected' : '' }}>
                            {{ $instructor->fullname }}
                        </option>
                    @endforeach
                </select>
               <a href="{{ route('courses.public') }}" class="reset-btn">Reset</a>
            </div>
        </form>
    </section>

    <main class="courses-grid">
        @if($courses->isEmpty())
            <div class="no-courses">
                <p>No courses found for the selected filters. Try resetting the filters.</p>
            </div>
        @else
            @foreach($courses as $course)
                <div class="course-card"
                     data-name="{{ $course->name }}"
                     data-enroll="{{ $course->enroll_option ?? 'N/A' }}"
                     data-duration="{{ $course->duration ?? 'N/A' }}"
                     data-instructor="{{ $course->instructors->pluck('fullname')->implode(', ') ?: 'N/A' }}"
                     data-category="{{ $course->categories->pluck('category')->implode(', ') ?: 'N/A' }}"
                     data-location="{{ $course->locations->pluck('location')->implode(', ') ?: 'N/A' }}"
                     data-description="{{ $course->description ?? 'No description available for this course.' }}"
                     data-image="{{ $course->image_url ?? 'https://via.placeholder.com/400x250' }}">
                    <img src="{{ $course->image_url ?? 'https://via.placeholder.com/400x250' }}" alt="{{ $course->name }}">
                    <div class="card-body">
                        <div>
                            <h3>{{ $course->name }}</h3>
                            <p><strong>Category:</strong> {{ $course->categories->pluck('category')->implode(', ') ?: 'N/A' }}</p>
                            <p><strong>Duration:</strong> {{ $course->duration ?? 'N/A' }}</p>
                            <p><strong>Location:</strong> {{ $course->locations->pluck('location')->implode(', ') ?: 'N/A' }}</p>
                        </div>
                        <div class="card-actions">
                            <button class="card-register-btn">Register</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </main>

    <div id="coursePopup" class="popup-modal">
        <div class="popup-content">
            <button id="closePopup" class="close-btn">&times;</button>
            <img id="popupImage" src="" alt="Course Image">
            <h3 id="popupTitle"></h3>
            <div class="popup-details">
                <p><strong>Category:</strong> <span id="popupCategory"></span></p>
                <p><strong>Duration:</strong> <span id="popupDuration"></span></p>
                <p><strong>Location:</strong> <span id="popupLocation"></span></p>
                <p><strong>Enrollment:</strong> <span id="popupEnroll"></span></p>
                <p><strong>Instructor(s):</strong> <span id="popupInstructor"></span></p>
            </div>
            <div id="popupDescriptionTitle">Course Description</div>
            <p id="popupDescription"></p>
        </div>
    </div>

    <script src="{{ asset('js/PublicCourse.js') }}"></script>
</body>
</html>
