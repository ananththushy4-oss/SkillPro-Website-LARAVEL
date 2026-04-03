<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/Studentenquiries.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
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
                <li><a href="{{ route('courses.public') }}">Courses</a></li>
                <li><a href="{{ route('home.news') }}" class="active">News & Events</a></li>
                <li><a href="{{ route('contactus.public') }}"  >Contact Us</a></li>
            </ul>
        </nav>
        <a href="{{ url('/login') }}"><button class="login-btn">Login</button></a>
    </header>
   
  <!-- ===== Hero Section ===== -->
  <section class="hero-section-news">
    <div class="overlay"></div>
    <div class="hero-content">
      <h1>News & Events</h1>
      <p>Stay updated with the latest announcements and events from SkillPro Institute.</p>
    </div>
  </section>

  <!-- ===== Main Content ===== -->
  <section class="news-events-section">
    <div class="container">
      
      <!-- News/Event Cards -->
      <div class="news-list">
        <div class="news-card" data-aos="fade-up">
          <div class="news-date">Oct 10, 2025</div>
          <h3>ICT Workshop for Beginners</h3>
          <p>Join our free ICT workshop to enhance your basic computing skills. Limited seats available!</p>
        </div>

        <div class="news-card" data-aos="fade-up">
          <div class="news-date">Oct 15, 2025</div>
          <h3>Business Management Seminar</h3>
          <p>Learn business strategy and management techniques from experienced industry professionals.</p>
        </div>

        <div class="news-card" data-aos="fade-up">
          <div class="news-date">Oct 20, 2025</div>
          <h3>Graphic Design Expo</h3>
          <p>Explore the latest trends in graphic design and digital creativity at our annual expo.</p>
        </div>

        <div class="news-card" data-aos="fade-up">
          <div class="news-date">Oct 25, 2025</div>
          <h3>Advanced ICT Certification</h3>
          <p>Enroll in our advanced ICT course to become certified and boost your career opportunities.</p>
        </div>

        <div class="news-card" data-aos="fade-up">
          <div class="news-date">Oct 28, 2025</div>
          <h3>Entrepreneurship Meetup</h3>
          <p>Network with young entrepreneurs and learn about starting and scaling a small business.</p>
        </div>

        <div class="news-card" data-aos="fade-up">
          <div class="news-date">Nov 1, 2025</div>
          <h3>Student Annual Day</h3>
          <p>Celebrate achievements of our students, with performances, awards, and fun activities.</p>
        </div>
      </div>

      <!-- Calendar Sidebar -->
      <div class="calendar-sidebar" data-aos="fade-left">
        <h3>Event Calendar</h3>
        <input type="date">
      </div>
    </div>
  </section>

  <!-- ===== Footer ===== -->
  <footer>
    <p>&copy; 2025 SkillPro Institute | All Rights Reserved</p>
  </footer>

  <!-- AOS Animation Library -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ once: true, duration: 1000 });
  </script>

    </body>
</html>