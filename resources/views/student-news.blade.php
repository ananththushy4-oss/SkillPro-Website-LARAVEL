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
                <li><a href="{{ route('student.news') }}" class="active">News & Events</a></li>
                <li><a href="{{ route('student.enquiries') }}" >Inquiries</a></li>
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

  <!-- Announcements Section -->
  <section class="announcements">
    <h2>Latest Announcements</h2>
    <div class="announcements-grid">
      <div class="announcement-card">
        <h3>New Course Launch: Advanced Python</h3>
        <p>We are excited to announce the launch of our Advanced Python course starting next month.</p>
        <span class="date">Sep 20, 2025</span>
      </div>
      <div class="announcement-card">
        <h3>Campus Job Fair 2025</h3>
        <p>Join our annual job fair to meet top companies and explore career opportunities.</p>
        <span class="date">Sep 25, 2025</span>
      </div>
      <div class="announcement-card">
        <h3>Scholarship Program Open</h3>
        <p>Apply now for our merit-based scholarships available for top-performing students.</p>
        <span class="date">Oct 01, 2025</span>
      </div>
      <div class="announcement-card">
        <h3>AI Workshop</h3>
        <p>Hands-on Artificial Intelligence workshop conducted by industry experts.</p>
        <span class="date">Oct 05, 2025</span>
      </div>
      <div class="announcement-card">
        <h3>Annual Tech Fest 2025</h3>
        <p>Participate in our Annual Tech Fest with competitions, tech talks, and networking events.</p>
        <span class="date">Oct 10, 2025</span>
      </div>
      <div class="announcement-card">
        <h3>Web Development Bootcamp</h3>
        <p>Enroll in our intensive 3-month Web Development Bootcamp to kickstart your career.</p>
        <span class="date">Oct 15, 2025</span>
      </div>
    </div>
  </section>

    </body>
</html>