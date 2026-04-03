<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard - SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('images/SkillEdge.jpg') }}" alt="SkillPro Institute Logo" class="logo-image">
            <span class="logo-text">Instructor Dashboard</span>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('instructor.dashboard') }}" class="active">Home</a></li>
                <li><a href="{{ route('instructor.notice') }}">News & Events</a></li>
                <li><a href="{{ route('instructor.profile') }}">Profile</a></li>
                <li><a href="{{ route('instructor.inquiries') }}">Inquiries</a></li>
                <li><a href="{{ route('instructor.assignments') }}">Assignments</a></li>
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
                    iconColor: '#008851', // custom green for icon
                    background: '#f9f9f9', // light background
                    color: '#333', // text color
                    showCancelButton: true,
                    confirmButtonColor: '#008851', // purple confirm button
                    cancelButtonColor: '#6c757d', // gray cancel button
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
            <h1>Welcome, Instructor!</h1>
            <p> Manage your classes, view inquiries, and update your profile.</p>
        </div>
    </section>

    <section class="stats-section-dashboard">
        <div class="stat-card">
            <h3>Students</h3>
            <p class="stat-number">452</p>
        </div>
        <div class="stat-card">
            <h3>Courses</h3>
            <p class="stat-number">18</p>
        </div>
        <div class="stat-card">
            <h3>Enquiries</h3>
            <p class="stat-number">34</p>
        </div>
        <div class="stat-card">
            <h3>Announcement</h3>
            <p class="stat-number">12</p>
        </div>
    </section>

    <section class="chart-section">
        <h2>Monthly Classes</h2>
        <canvas id="enrolmentsChart"></canvas>
    </section>

    <section class="activities-section">
        <h2>Recent Activities</h2>
        <div class="activities-grid">
            <div class="activity-card">
                <h4>New Student Registered</h4>
                <p>John Doe has enrolled in ICT Fundamentals.</p>
            </div>
            <div class="activity-card">
                <h4>Course Updated</h4>
                <p>Business Management course schedule updated.</p>
            </div>
            <div class="activity-card">
                <h4>New Enquiry</h4>
                <p>Mary Smith sent an enquiry about Business Analytics.</p>
            </div>
            <div class="activity-card">
                <h4>News Added</h4>
                <p>New workshop on Graphic Design announced.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 SkillPro Institute | All Rights Reserved</p>
    </footer>

    <script>
        const ctx = document.getElementById('enrolmentsChart').getContext('2d');
        const enrolmentsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Students Enrolled',
                    data: [12, 19, 14, 23, 18, 20],
                    backgroundColor: 'rgba(0, 200, 120, 0.7)',
                    borderColor: 'rgba(0, 200, 120, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>