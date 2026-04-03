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
                <li><a href="{{ route('instructor.dashboard') }}">Home</a></li>
                <li><a href="{{ route('instructor.notice') }}">News & Events</a></li>
                <li><a href="{{ route('instructor.profile') }}">Profile</a></li>
                <li><a href="{{ route('instructor.inquiries') }}">Inquiries</a></li>
                <li><a href="{{ route('instructor.assignments') }}" class="active">Assignments</a></li>
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
            <h1>Instructor Assignments</h1>
            <p> Manage assignments for your courses and streams. Add, view, and update assignments easily.</p>
             <button class="btn btn-primary" id="openModalBtn">+ Add Assignment</button>
        </div>
    </section>

    
<!-- Filters -->
<section class="filter-section">
    <button class="filter-btn active" data-stream="all">All Streams</button>
    <button class="filter-btn" data-stream="IT & Software">IT & Software</button>
    <button class="filter-btn" data-stream="Data Science & AI">Data Science & AI</button>
    <button class="filter-btn" data-stream="Digital Marketing">Digital Marketing</button>
    <button class="filter-btn" data-stream="Cybersecurity">Cybersecurity</button>
    <button class="filter-btn" data-stream="Business Management">Business Management</button>
    <button class="filter-btn" data-stream="Graphic Design & Multimedia">Graphic Design & Multimedia</button>
</section>

<!-- Assignments Section -->
<section class="assignments-section">
    <h2>Current Assignments</h2>
    <div class="assignments-grid" id="assignmentsGrid">
        <!-- Dummy assignments -->
        <div class="assignment-card" draggable="true" data-stream="IT & Software" data-due="2025-10-10">
            <h3>JavaScript Basics</h3>
            <span class="badge stream">IT & Software</span>
            <span class="badge due">2025-10-10</span>
            <p>Complete exercises on DOM manipulation and events.</p>
        </div>
        <div class="assignment-card" draggable="true" data-stream="Data Science & AI" data-due="2025-10-15">
            <h3>AI Prediction Project</h3>
            <span class="badge stream">Data Science & AI</span>
            <span class="badge due">2025-10-15</span>
            <p>Build a machine learning model to predict housing prices.</p>
        </div>
        <div class="assignment-card" draggable="true" data-stream="Digital Marketing" data-due="2025-10-20">
            <h3>Social Media Campaign</h3>
            <span class="badge stream">Digital Marketing</span>
            <span class="badge due">2025-10-20</span>
            <p>Create a one-week campaign for a new product launch.</p>
        </div>
    </div>
</section>

<!-- Modal Popup -->
<div class="modal" id="assignmentModal">
  <div class="modal-content">
    <span class="close-btn" id="closeModal">&times;</span>
    <h3>Add New Assignment</h3>
    <input type="text" id="assignmentTitle" placeholder="Assignment Title">
    <input type="text" id="assignmentCourse" placeholder="Course Name">
    <input type="text" id="assignmentStream" placeholder="Stream/Badge">
    <input type="date" id="assignmentDue">
    <textarea id="assignmentDescription" placeholder="Assignment Description"></textarea>
    <button class="btn btn-primary" id="publishAssignment">Add Assignment</button>
  </div>
</div>

<footer>
    &copy; 2025 SkillPro Institute. All Rights Reserved.
</footer>

<script>
const modal = document.getElementById("assignmentModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModal");
const assignmentsGrid = document.getElementById("assignmentsGrid");
const publishBtn = document.getElementById("publishAssignment");

openModalBtn.addEventListener("click", () => modal.style.display = "flex");
closeModalBtn.addEventListener("click", () => modal.style.display = "none");
window.addEventListener("click", (e) => { if(e.target === modal) modal.style.display = "none"; });

// Add Assignment
publishBtn.addEventListener("click", () => {
    const title = document.getElementById("assignmentTitle").value;
    const course = document.getElementById("assignmentCourse").value;
    const stream = document.getElementById("assignmentStream").value;
    const due = document.getElementById("assignmentDue").value;
    const desc = document.getElementById("assignmentDescription").value;

    if(title && course && stream && due && desc){
        const card = document.createElement("div");
        card.classList.add("assignment-card");
        card.setAttribute("draggable", "true");
        card.setAttribute("data-stream", stream);
        card.setAttribute("data-due", due);
        card.innerHTML = `
            <h3>${title}</h3>
            <span class="badge stream">${stream}</span>
            <span class="badge due">${due}</span>
            <p>${desc}</p>
        `;
        assignmentsGrid.prepend(card);
        modal.style.display = "none";
        Swal.fire("Added!", "Assignment has been added successfully.", "success");
        updateBadges();
        enableDragDrop();

        // Clear inputs
        document.getElementById("assignmentTitle").value='';
        document.getElementById("assignmentCourse").value='';
        document.getElementById("assignmentStream").value='';
        document.getElementById("assignmentDue").value='';
        document.getElementById("assignmentDescription").value='';
    } else {
        Swal.fire("Error!", "Please fill all fields.", "error");
    }
});

// Badge Colors for Due Dates
function updateBadges(){
    document.querySelectorAll(".assignment-card").forEach(card => {
        const dueDate = new Date(card.getAttribute("data-due"));
        const today = new Date();
        const badge = card.querySelector(".badge.due");
        badge.classList.remove("due-upcoming","due-soon","due-late");

        if(dueDate > today) badge.classList.add("due-upcoming");
        else if(dueDate.toDateString() === today.toDateString()) badge.classList.add("due-soon");
        else badge.classList.add("due-late");
    });
}
updateBadges();

// Drag & Drop
let dragged;
function enableDragDrop(){
    const cards = document.querySelectorAll(".assignment-card");
    cards.forEach(card => {
        card.addEventListener("dragstart", () => dragged = card);
        card.addEventListener("dragover", e => e.preventDefault());
        card.addEventListener("drop", function() {
            if(dragged !== this){
                let all = Array.from(assignmentsGrid.children);
                let draggedIndex = all.indexOf(dragged);
                let targetIndex = all.indexOf(this);
                if(draggedIndex < targetIndex) this.after(dragged);
                else this.before(dragged);
            }
        });
    });
}
enableDragDrop();

// Stream Filters
document.querySelectorAll(".filter-btn").forEach(btn => {
    btn.addEventListener("click", () => {
        document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        const stream = btn.getAttribute("data-stream");
        document.querySelectorAll(".assignment-card").forEach(card => {
            if(stream === "all" || card.getAttribute("data-stream") === stream) card.style.display = "block";
            else card.style.display = "none";
        });
    });
});
</script>
</body>

</html>