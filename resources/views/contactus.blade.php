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
                <li><a href="{{ route('home.news') }}">News & Events</a></li>
                <li><a href="{{ route('contactus.public') }}"  class="active">Contact Us</a></li>
            </ul>
        </nav>
        <a href="{{ url('/login') }}"><button class="login-btn">Login</button></a>
    </header>
     <!-- ===== Hero Section ===== -->
<section class="hero-section">
  <div class="overlay"></div>
  <div class="hero-content">
    <h1>Send Us a Message</h1>
    <p>We’re here to help. Fill out the form or reach us through the contact details below.</p>
  </div>
</section>


 <!-- ===== Contact + Enquiry Layout Section ===== -->
<section class="enquiry-container">
  <div class="contact-left">
    <div class="map-box">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.665780431833!2d80.63689647488297!3d7.293864694741163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae368b8e7ddf4b3%3A0x8e3d1a2b52bb4bc8!2sUniversity%20of%20Peradeniya!5e0!3m2!1sen!2slk!4v1698355153890!5m2!1sen!2slk" 
        width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <div class="info-box">
      <h3>📍 Address</h3>
      <p>123 Main Street, Colombo 01</p>
    </div>

    <div class="info-box">
      <h3>📞 Phone</h3>
      <p>+94 81 224 5618</p>
    </div>

    <div class="info-box">
      <h3>✉️ Email</h3>
      <p>info@skillpro.lk</p>
    </div>

    <div class="info-box">
      <h3>🕒 Office Hours</h3>
      <p>Mon - Fri: 9:00 AM - 6:00 PM<br>Sat: 9:00 AM - 1:00 PM</p>
    </div>
  </div>

<section class="enquiry-section">
        <h2>Ask Your inquiry</h2>
        <p>Fill out the form below and we will get back to you shortly.</p>

        <form id="enquiryForm" action="{{ route('inquiries.store.public') }}" method="POST">
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
                <label for="message">Your Enquiry</label>
                <textarea name="message" id="message" rows="5" placeholder="Type your inquiry here..." required></textarea>
            </div>

            <button type="submit" class="submit-btn">Submit inquiry</button>
        </form>
    </section>



   <script src="{{ asset('js/Studentenquiries.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Submitted Successfully!',
                text: '{{ session('success') }}',
                timer: 3500, // Alert will close automatically after 3.5 seconds
                showConfirmButton: false
            });
        </script>
    @endif

    </body>
</html>