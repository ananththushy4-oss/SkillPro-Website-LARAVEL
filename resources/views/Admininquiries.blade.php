<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Enquiries | SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/manageenquires.css') }}">
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
                <li><a href="{{ route('admin.instructor') }}">Instructor</a></li> {{-- Placeholder --}}
                <li><a href="{{ route('manage-courses') }}">Courses</a></li>
                <li><a href="{{ route('admin.notice') }}">News & Events</a></li> {{-- Placeholder --}}
                <li><a href="{{ route('admin.inquiries') }}" class="active">Inquiries</a></li>
            </ul>
        </nav>
        
        {{-- Logout Form --}}
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="button" class="login-btn" onclick="confirmLogout()">Logout</button>
        </form>
    </header>

    {{-- Enquiries Section --}}
    <section class="admin-container">
        <h2>Visitor / Student Enquiries</h2>

        <div class="enquiries-grid" id="enquiriesGrid">
            @forelse ($inquiries ?? [] as $inquiry)
                <div class="enquiry-card">
                    <div class="card-body">
                        <h3>{{ $inquiry->name }}</h3>
                        <p><strong>Email:</strong> {{ $inquiry->email }}</p>
                        <p><strong>Phone:</strong> {{ $inquiry->phone }}</p>
                        {{-- Correct way: show related course name --}}
                        <p><strong>Course Interested:</strong> {{ $inquiry->course->name ?? 'N/A' }}</p>
                        <p><strong>Message:</strong> {{ $inquiry->message }}</p>
                        <small>Received on: {{ $inquiry->created_at->format('d M Y, h:i A') }}</small>
                    </div>
                    <div class="course-actions">
                        <button class="btn btn-primary btn-sm reply-btn">Reply</button>
                    </div>
                </div>
            @empty
                <div class="enquiry-card">
                    <p>No new inquiries found.</p>
                </div>
            @endforelse
        </div>
    </section>

<script>
    // Reply Button (SweetAlert2)
    document.querySelectorAll('.reply-btn').forEach(button => {
        button.addEventListener('click', function() {
            Swal.fire({
                title: 'Send Reply',
                input: 'textarea',
                inputLabel: 'Your Reply',
                inputPlaceholder: 'Type your message here...',
                showCancelButton: true,
                confirmButtonText: 'Send',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Please write a reply message!';
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Sent!', 'Your reply has been sent.', 'success');
                }
            });
        });
    });

    // Logout Confirmation
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
</body>
</html>
