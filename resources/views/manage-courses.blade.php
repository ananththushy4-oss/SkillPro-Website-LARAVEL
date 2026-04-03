<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Courses | SkillPro Institute</title>

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    {{-- Navbar --}}
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('images/SkillEdge.jpg') }}" alt="SkillPro Institute Logo" class="logo-image">
            <span class="logo-text">Admin Dashboard</span>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li><a href="{{ route('admin.instructor') }}">Instructor</a></li>
                <li><a href="{{ route('manage-courses') }}" class="active">Courses</a></li>
                <li><a href="{{ route('admin.notice') }}">News & Events</a></li>
                <li><a href="{{ route('admin.inquiries') }}">Inquiries</a></li>
            </ul>
        </nav>
       
        <!-- Logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="button" class="login-btn" onclick="confirmLogout()">Logout</button>
        </form>

        <script>
            function confirmLogout() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be logged out.",
                    icon: 'warning',
                    iconColor: '#008851',
                    background: '#f9f9f9',
                    color: '#333',
                    showCancelButton: true,
                    confirmButtonColor: '#008851',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, logout',
                    cancelButtonText: 'No, stay here'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        </script>
    </header>

    {{-- SWEETALERT SUCCESS MESSAGE --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#008851',
                background: '#f9f9f9',
                color: '#333'
            });
        </script>
    @endif

    {{-- Admin Category Management Section --}}
    <section class="admin-container">
        <h2>Manage Categories</h2>

        <!-- Category Form -->
        <form class="course-form" id="categoryForm" method="POST" action="{{ route('categories.store') }}">
            @csrf
            <input type="text" name="catid" placeholder="CatID (e.g. CAT001)" required>
            <input type="text" name="category" placeholder="Category (e.g. ICT, Business)" required>
            <input type="text" name="image_url" placeholder="Image URL (optional)">
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>

        <!-- Display Categories -->
        <div class="categories-grid" id="categoriesGrid">
            @foreach($categories as $cat)
                <div class="category-card">
                    <img src="{{ $cat->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $cat->category }}">
                    <div class="card-body">
                        <h3>{{ $cat->category }}</h3>
                        <p>ID: {{ $cat->catid }}</p>
                    </div>
                    <div class="course-actions">
                        <!-- Delete button -->
                        <form action="{{ route('categories.destroy', $cat->catid) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Admin Location Management Section --}}
    <section class="admin-container">
        <h2>Manage Locations</h2>

        <!-- Location Form -->
        <form class="course-form" id="locationForm" method="POST" action="{{ route('locations.store') }}">
            @csrf
            <input type="text" name="locid" placeholder="LID (e.g. LOC001)" required>
            <input type="text" name="location" placeholder="Location (e.g. Jaffna, Colombo)" required>
            <input type="text" name="image_url" placeholder="Image URL (optional)">
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add Location</button>
            </div>
        </form>

        <!-- Display Locations -->
        <div class="locations-grid" id="locationsGrid">
            @foreach($locations as $loc)
                <div class="location-card">
                    <img src="{{ $loc->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $loc->location }}">
                    <div class="card-body">
                        <h3>{{ $loc->location }}</h3>
                        <p>ID: {{ $loc->locid }}</p>
                    </div>
                    <div class="course-actions">
                        <form action="{{ route('locations.destroy', $loc->locid) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Admin Course Management Section --}}
    <section class="admin-container">
        <h2>Manage Courses</h2>

        <!-- Course Form -->
        <form class="course-form" method="POST" action="{{ route('courses.store') }}">
            @csrf

            <input type="text" name="course_id" placeholder="Course ID (CID)" required>
            <input type="text" name="name" placeholder="Course Name" required>
            <input type="text" name="image_url" placeholder="Course Image URL">

            <!-- Enrollment Mode -->
            <select name="enroll_option" required>
                <option value="">Select Mode</option>
                <option value="Online">Online</option>
                <option value="On-site">On-site</option>
                <option value="Online/On-site">Online/On-site</option>
            </select>

            <!-- Instructor (multiple select) -->
            <select name="instructors[]" multiple required>
                @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->fullname }}</option>
                @endforeach
            </select>

            <!-- Location (multiple select) -->
            <select name="locations[]" multiple required>
                @foreach($locations as $location)
                    <option value="{{ $location->locid }}">{{ $location->location }}</option>
                @endforeach
            </select>

            <!-- Category (multiple select) -->
            <select name="categories[]" multiple required>
                @foreach($categories as $category)
                    <option value="{{ $category->catid }}">{{ $category->category }}</option>
                @endforeach
            </select>

            <!-- Duration -->
            <select name="duration" required>
                <option value="">Select Duration</option>
                <option value="1 Month">1 Month</option>
                <option value="3 Months">3 Months</option>
                <option value="6 Months">6 Months</option>
                <option value="12 Months">12 Months</option>
            </select>

            <!-- Description -->
            <textarea name="description" placeholder="Course Description" required></textarea>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add Course</button>
            </div>
        </form>

        <!-- Display Existing Courses -->
        <div class="courses-grid" id="coursesGrid">
            @forelse($courses as $course)
                <div class="course-card">
                    <img src="{{ $course->image_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $course->name }}">
                    <div class="card-body">
                        <h3>{{ $course->name }}</h3>
                        <p><strong>Enroll:</strong> {{ $course->enroll_option }}</p>
                        <p><strong>Duration:</strong> {{ $course->duration }}</p>
                        <p><strong>Instructors:</strong> {{ $course->instructors->pluck('fullname')->join(', ') }}</p>
                        <p><strong>Locations:</strong> {{ $course->locations->pluck('location')->join(', ') }}</p>
                        <p><strong>Categories:</strong> {{ $course->categories->pluck('category')->join(', ') }}</p>
                        <p>{{ $course->description }}</p>
                    </div>

                    <div class="course-actions">
                        <!-- Update button removed -->
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No courses found.</p>
            @endforelse
        </div>
    </section>

    <script src="{{ asset('js/manage.js') }}"></script>

    {{-- DELETE CONFIRMATION SCRIPT --}}
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                let form = this.closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'warning',
                    iconColor: '#d33',
                    background: '#f9f9f9',
                    color: '#333',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'No, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
