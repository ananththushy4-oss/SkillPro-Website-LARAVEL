<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    {{-- Navbar --}}
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('images/SkillEdge.jpg') }}" alt="SkillPro Institute Logo" class="logo-image">
            <span class="logo-text">Student Dashboard</span>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('student.dashboard') }}">Home</a></li>
                <li><a href="{{ route('student.course') }}">Courses</a></li>
                <li><a href="{{ route('student.news') }}">News & Events</a></li>
                <li><a href="{{ route('student.enquiries') }}">Inquiries</a></li>
                <li><a href="{{ route('student.profile') }}" class="active">Profile</a></li>
            </ul>
        </nav>

        {{-- Logout --}}
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

    {{-- Flash Success Message --}}
    @if(session('success'))
        <div class="alert alert-success" style="margin:20px; padding:10px; background:#d4edda; color:#155724; border-radius:5px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- My Courses Section --}}
    <section class="my-courses">
        <h2>My Registered Courses</h2>

        @if($courses->isEmpty())
            <p>You haven’t registered for any courses yet.</p>
        @else
            <div class="courses-grid">
                @foreach($courses as $course)
                    <div class="course-card"
                         data-id="{{ $course->id }}"
                         data-name="{{ $course->name }}"
                         data-enroll="{{ $course->enroll_option ?? 'N/A' }}"
                         data-duration="{{ $course->duration ?? 'N/A' }}"
                         data-instructor="{{ $course->instructors->pluck('fullname')->implode(', ') ?: 'N/A' }}"
                         data-description="{{ $course->description ?? 'No description available.' }}"
                         data-image="{{ $course->image_url ?? 'https://via.placeholder.com/400x250' }}">
                        <img src="{{ $course->image_url ?? 'https://via.placeholder.com/400x250' }}" alt="{{ $course->name }}">
                        <div class="card-body">
                            <h3>{{ $course->name }}</h3>
                            <p><strong>Instructor:</strong> {{ $course->instructors->pluck('fullname')->implode(', ') ?: 'N/A' }}</p>
                            <p><strong>Duration:</strong> {{ $course->duration ?? 'N/A' }}</p>
                            <button class="view-details-btn">View Details</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Course Popup --}}
    <div id="coursePopup" class="course-popup" style="display:none;">
        <div class="popup-content">
            <button id="closePopup" class="close-btn">×</button>
            <img id="popupImage" src="" alt="Course Image">
            <h3 id="popupTitle"></h3>
            <p><strong>Enroll:</strong> <span id="popupEnroll"></span></p>
            <p><strong>Instructor:</strong> <span id="popupInstructor"></span></p>
            <p><strong>Duration:</strong> <span id="popupDuration"></span></p>
            <p id="popupDescription"></p>
        </div>
    </div>

    <script>
        // Open popup
        document.querySelectorAll('.view-details-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.course-card');

                document.getElementById("popupTitle").textContent = card.dataset.name;
                document.getElementById("popupEnroll").textContent = card.dataset.enroll;
                document.getElementById("popupInstructor").textContent = card.dataset.instructor;
                document.getElementById("popupDuration").textContent = card.dataset.duration;
                document.getElementById("popupDescription").textContent = card.dataset.description;
                document.getElementById("popupImage").src = card.dataset.image;

                document.getElementById("coursePopup").style.display = "flex";
            });
        });

        // Close popup
        document.getElementById("closePopup").addEventListener("click", () => {
            document.getElementById("coursePopup").style.display = "none";
        });
    </script>
</body>
</html>
