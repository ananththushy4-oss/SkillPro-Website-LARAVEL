<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
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
                <li><a href="{{ route('student.dashboard') }}" class="active">Home</a></li>
                <li><a href="{{ route('student.course') }}">Courses</a></li>
                <li><a href="{{ route('student.news') }}">News & Events</a></li>
                <li><a href="{{ route('student.enquiries') }}">Inquiries</a></li>
                <li><a href="{{ route('student.profile') }}">Profile</a></li>
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
   
    <section class="hero-section-dashboard">
        <div class="hero-content">
            <h1>Welcome, {{ Auth::user()->name ?? 'Student' }}</h1>
            <p>Explore your enrolled courses, updates, and submit inquiries.</p>
        </div>
    </section>
 <!-- Courses Carousel -->
  <section class="carousel-section">
    <h2>Our Courses</h2>
    <div class="carousel-wrapper">
      <div class="carousel-track">
        <!-- Duplicated cards for seamless infinite loop -->
        <div class="course-card">
          <img src="https://plus.unsplash.com/premium_photo-1678565869434-c81195861939?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Web Development">
          <h3>Web Development Bootcamp</h3>
          <p>Instructor: John Doe | Duration: 3 Months</p>
        </div>
        <div class="course-card">
          <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Data Science">
          <h3>Data Science Mastery</h3>
          <p>Instructor: Jane Smith | Duration: 4 Months</p>
        </div>
        <div class="course-card">
          <img src="https://images.unsplash.com/photo-1657812670261-7b76ba04525c?q=80&w=1286&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Digital Marketing">
          <h3>Digital Marketing Essentials</h3>
          <p>Instructor: Mike Johnson | Duration: 2 Months</p>
        </div>
        <div class="course-card">
          <img src="https://plus.unsplash.com/premium_photo-1720210118039-47390f1158a5?q=80&w=1304&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="UI/UX Design">
          <h3>UI/UX Design Fundamentals</h3>
          <p>Instructor: Sarah Lee | Duration: 2 Months</p>
        </div>
        <!-- Duplicate for infinite loop -->
        <div class="course-card">
          <img src="https://images.unsplash.com/photo-1593720213428-28a5b9e94613?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Web Development">
          <h3>Web Development Bootcamp</h3>
          <p>Instructor: John Doe | Duration: 3 Months</p>
        </div>
        <div class="course-card">
          <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?q=80&w=764&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Data Science">
          <h3>Data Science Mastery</h3>
          <p>Instructor: Jane Smith | Duration: 4 Months</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Programs -->
  <section class="programs">
    <h2>Our Programs</h2>
    <div class="programs-grid">
      <div class="program-card">
        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=400" alt="IT Training">
        <h3>Professional IT Training</h3>
        <p>Upskill yourself with hands-on IT programs for industry readiness.</p>
      </div>
      <div class="program-card">
        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=400" alt="Soft Skills">
        <h3>Soft Skills Workshops</h3>
        <p>Enhance communication, teamwork, and leadership skills.</p>
      </div>
      <div class="program-card">
        <img src="https://plus.unsplash.com/premium_photo-1661430951944-36f5afcf6254?q=80&w=1169&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Entrepreneurship">
        <h3>Entrepreneurship Guidance</h3>
        <p>Learn business planning and start-up essentials from experts.</p>
      </div>
    </div>
  </section>

  <!-- Job Opportunities -->
  <section class="jobs">
    <h2>Job Opportunities</h2>
    <div class="jobs-grid">
      <div class="job-card">
        <h3>Frontend Developer</h3>
        <p>Company: ABC Tech | Location: Colombo | Apply Now</p>
      </div>
      <div class="job-card">
        <h3>Data Analyst</h3>
        <p>Company: DataCorp | Location: Kandy | Apply Now</p>
      </div>
      <div class="job-card">
        <h3>Digital Marketing Executive</h3>
        <p>Company: MarketHub | Location: Galle | Apply Now</p>
      </div>
    </div>
  </section>

  <!-- Past Events Carousel -->
  <section class="carousel-section">
    <h2>Our Past Events</h2>
    <div class="carousel-wrapper">
      <div class="carousel-track">
        <div class="event-card">
          <img src="https://plus.unsplash.com/premium_photo-1734215281802-81a2422ae943?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tech Fest">
          <h3>Annual Tech Fest 2024</h3>
        </div>
        <div class="event-card">
          <img src="https://images.unsplash.com/photo-1593642532973-d31b6557fa68?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=400" alt="AI Workshop">
          <h3>Workshop on AI</h3>
        </div>
        <div class="event-card">
          <img src="https://images.unsplash.com/photo-1755548413928-4aaeba7c740e?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Career Seminar">
          <h3>Career Guidance Seminar</h3>
        </div>
        <!-- Duplicate for infinite loop -->
        <div class="event-card">
          <img src="https://plus.unsplash.com/premium_photo-1734215281802-81a2422ae943?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tech Fest">
          <h3>Annual Tech Fest 2024</h3>
        </div>
        <div class="event-card">
          <img src="https://images.unsplash.com/photo-1593642532973-d31b6557fa68?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=400" alt="AI Workshop">
          <h3>Workshop on AI</h3>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
