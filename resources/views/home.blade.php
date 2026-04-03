<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro Institute</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li><a href="{{ route('courses.public') }}">Courses</a></li>
                <li><a href="{{ route('home.news') }}">News & Events</a></li>
                 <li><a href="{{ route('contactus.public') }}">Contact Us</a></li>
            </ul>
        </nav>
        <a href="{{ url('/login') }}"><button class="login-btn">Login</button></a>
    </header>
 <!-- Hero Section -->
  <main class="hero-section">
    <div class="overlay"></div>
    <div class="hero-content">
      <h1>Build Your Future with <br /><span class="highlight">SkillPro Institute</span></h1>
      <p>Sri Lanka's premier vocational training institute offering industry-relevant courses with modern facilities, expert instructors, and guaranteed job placement support.</p>
      <div class="search-container">
        <button class="explore-btn">Explore Courses →</button>
        <input type="text" placeholder="Search for courses..." />
      </div>
    </div>
  </main>

  <!-- Stats Section -->
  <section class="stats-section">
    <div class="stat-item">
      <span class="stat-number">5,000+</span>
      <p class="stat-text">Students Trained</p>
    </div>
    <div class="stat-item">
      <span class="stat-number">95%</span>
      <p class="stat-text">Job Placement Rate</p>
    </div>
    <div class="stat-item">
      <span class="stat-number">25+</span>
      <p class="stat-text">Professional Courses</p>
    </div>
  </section>

  <!-- Future Plans Section -->
  <section class="future-plans">
    <h2>Future Plans</h2>
    <div class="plans-cards">
      <div class="plan-card">
        <h3>New Courses</h3>
        <p>Launching AI, IoT, and advanced Hospitality courses.</p>
      </div>
      <div class="plan-card">
        <h3>Platform Enhancements</h3>
        <p>Interactive quizzes, live sessions, and forum discussions.</p>
      </div>
      <div class="plan-card">
        <h3>Workshops & Seminars</h3>
        <p>Monthly instructor workshops and professional seminars.</p>
      </div>
    </div>
  </section>

  <!-- Our Success Journey Section -->
  <section class="success-journey">
    <h2>Our Success Journey</h2>
    <div class="timeline">
      <div class="timeline-item">
        <span class="year">2019</span>
        <p>Trained 100 students in IT and Hospitality courses.</p>
      </div>
      <div class="timeline-item">
        <span class="year">2020</span>
        <p>Expanded branches to Colombo, Kandy, and Matara.</p>
      </div>
      <div class="timeline-item">
        <span class="year">2021</span>
        <p>Awarded TVEC recognition for excellence in vocational training.</p>
      </div>
      <div class="timeline-item">
        <span class="year">2024</span>
        <p>500+ graduates placed in top companies across Sri Lanka.</p>
      </div>
    </div>
  </section>

  <!-- Job Opportunities Section -->
  <section class="job-opportunities">
    <h2>Job Opportunities</h2>
    <div class="jobs-cards">
      <div class="job-card">
        <h3>IT Instructor</h3>
        <p>Roles: Web Developer, Software Trainer, AI Educator.</p>
      </div>
      <div class="job-card">
        <h3>Hotel Management Instructor</h3>
        <p>Roles: Hospitality Trainer, Event Coordinator, Management Tutor.</p>
      </div>
      <div class="job-card">
        <h3>Welding / Plumbing Instructor</h3>
        <p>Roles: Technical Trainer, Workshop Supervisor, Skills Coach.</p>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h3>SkillPro Institute</h3>
        <p>Empowering individuals with practical skills and knowledge for a brighter future. Join thousands of successful graduates who have transformed their careers with us.</p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <div class="footer-section">
        <h4>Quick Links</h4>
        <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Courses</a></li>
          <li><a href="#">Instructors</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>

      <div class="footer-section">
        <h4>Popular Courses</h4>
        <ul>
          <li>ICT & Software Development</li>
          <li>Plumbing & Construction</li>
          <li>Electrical Engineering</li>
          <li>Automotive Technology</li>
          <li>Business Management</li>
          <li>Digital Marketing</li>
        </ul>
      </div>

      <div class="footer-section">
        <h4>Our Branches</h4>
        <ul>
          <li><strong>Colombo:</strong> 123 Main Street, Colombo 01<br />
            <i class="fas fa-phone-alt" style="color: white;"></i> +94 11 224 5618 </li>
          <li><strong>Kandy:</strong> 456 Hill Street, Kandy<br /> 
            <i class="fas fa-phone-alt" style="color: white;"></i> +94 81 224 5618</li>
          <li><strong>Matara:</strong> 789 Beach Road, Matara<br />
            <i class="fas fa-phone-alt" style="color: white;"></i> +94 41 224 5618</li>
          <li> info@skillpro.lk</li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2024 SkillPro Institute. All rights reserved. TVEC Registered.</p>
      <p><a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a></p>
    </div>
  </footer>


    <!-- JS -->
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
