<!-- resources/views/instructor-profile.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Instructor Profile - SkillPro Institute</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/intructorprofile.css') }}">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">
      <img src="{{ asset('images/SkillEdge.jpg') }}" alt="SkillPro Institute Logo" class="logo-image">
      <span class="logo-text">Instructor Dashboard</span>
    </div>

    <nav>
      <ul class="nav-links">
        <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
        <li><a href="{{ route('instructor.notice') }}">News & Events</a></li>
        <li><a href="{{ route('instructor.profile') }}" class="active">Profile</a></li>
        <li><a href="{{ route('instructor.inquiries') }}">Inquiries</a></li>
        <li><a href="{{ route('instructor.assignments') }}">Assignments</a></li>
      </ul>
    </nav>

    <!-- Logout Form -->
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

  <!-- Instructor Profile Form -->
  <div class="registration-container" style="margin-top: 100px;">
    <div class="registration-header">
      <h2>Instructor Profile</h2>
      <!-- Default Dummy Profile Logo -->
      <img id="profileImage" 
           src="{{ old('photo', $instructor->photo ?? 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png') }}" 
           alt="Profile Image" 
           class="profile-photo">
      <p>Fill in the details below</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
      <div style="color: green; font-weight: bold; margin-bottom: 15px;">
        {{ session('success') }}
      </div>
    @endif

    <!-- Dynamic Form Action -->
    <form id="profileForm" 
          action="{{ isset($instructor) ? route('instructor.profile.update', $instructor->id) : route('instructor.profile.store') }}" 
          method="POST">
      @csrf
      @if(isset($instructor))
        @method('PUT')
      @endif

      <div class="form-group">
        <div class="icon-input">
          <input type="text" name="fullname" id="fullname" placeholder="Full Name" 
                 value="{{ old('fullname', $instructor->fullname ?? '') }}" required>
        </div>
      </div>
      <div class="form-group">
        <div class="icon-input">
          <input type="text" name="qualification" id="qualification" placeholder="Qualification" 
                 value="{{ old('qualification', $instructor->qualification ?? '') }}" required>
        </div>
      </div>
      <div class="form-group">
        <div class="icon-input">
          <input type="text" name="experience" id="experience" placeholder="Experience" 
                 value="{{ old('experience', $instructor->experience ?? '') }}" required>
        </div>
      </div>
      <div class="form-group">
        <div class="icon-input">
          <input type="url" name="photo" id="photo" placeholder="Photo URL" 
                 value="{{ old('photo', $instructor->photo ?? '') }}" required>
        </div>
      </div>
      <div class="form-group">
        <div class="icon-input">
          <textarea name="description" id="description" placeholder="Description" required>{{ old('description', $instructor->description ?? '') }}</textarea>
        </div>
      </div>

      <!-- Updated Button Text -->
      <button type="submit" class="btn-primary" id="createBtn">
        {{ isset($instructor) ? 'Save Changes' : 'Save Profile' }}
      </button>
    </form>
  </div>

  <!-- JS -->
  <script src="{{ asset('js/intructorprofile.js') }}"></script>
</body>
</html>
