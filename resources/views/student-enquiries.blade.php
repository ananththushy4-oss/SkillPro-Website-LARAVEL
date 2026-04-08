<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask Enquiries | SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/Studentenquiries.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('images/SkillEdge.jpg') }}" alt="SkillPro Institute Logo" class="logo-image">
            <span class="logo-text">Student Dashboard</span>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('student.dashboard') }}">Home</a></li>
                <li><a href="{{ route('student.course') }}">Courses</a></li>
                <li><a href="{{ route('student.news') }}'">News & Events</a></li>
                <li><a href="{{ route('student.enquiries') }}" class="active">Inquiries</a></li>
                <li><a href="{{ route('student.profile') }}">Profile</a></li>
            </ul>
        </nav>

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

    <section class="enquiry-section">
        <h2>Ask Your inquiry</h2>
        <p>Fill out the form below and we will get back to you shortly.</p>

        <form id="enquiryForm" action="{{ route('student.enquiries.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" required>
            </div>

           <div class="form-group">
    <label for="course_id">Course Interested In</label>
    <select name="course_id" id="course_id" required>
        <option value="">Select a course</option>
        @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->name }}</option>
        @endforeach
    </select>
</div>

            <div class="form-group">
                <label for="message">Your inquiry</label>
                <textarea name="message" id="message" rows="5" placeholder="Type your inquiry here..." required></textarea>
            </div>

            <button type="submit" class="submit-btn">Submit inquiry</button>
        </form>
    </section>

   <script src="{{ asset('js/Studentenquiries.js') }}"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'inquiry Sent!',
                text: '{{ session('success') }}',
                timer: 3000, // Closes automatically
                showConfirmButton: false
            });
        </script>
    @endif
    </body>
</html>