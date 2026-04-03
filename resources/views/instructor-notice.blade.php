<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard - SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
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
                <li><a href="{{ route('instructor.notice') }}" class="active">News & Events</a></li>
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

  <!-- News & Events Section -->
  <section class="admin-container">
    <h2>Manage News & Events</h2>
    <div class="form-actions">
      <button class="btn btn-primary" id="openModalBtn">+ Publish News/Event</button>
    </div>

    <div class="news-events-grid" id="newsEventsGrid">
      <!-- Dummy News & Events -->
      <div class="news-card">
        <div class="card-body">
          <h3>Orientation Program 2025</h3>
          <p><strong>Type:</strong> Event</p>
          <p><strong>Date:</strong> 2025-10-10</p>
          <p>Welcome all new students! Join us for a fun and informative orientation session.</p>
        </div>
      </div>

      <div class="news-card">
        <div class="card-body">
          <h3>Holiday Notice</h3>
          <p><strong>Type:</strong> Notice</p>
          <p><strong>Date:</strong> 2025-10-12</p>
          <p>SkillPro Institute will remain closed on 12th October for a public holiday.</p>
        </div>
      </div>

      <div class="news-card">
        <div class="card-body">
          <h3>Workshop on AI</h3>
          <p><strong>Type:</strong> Event</p>
          <p><strong>Date:</strong> 2025-10-18</p>
          <p>Join our interactive workshop to learn about AI and machine learning basics.</p>
        </div>
      </div>

      <div class="news-card">
        <div class="card-body">
          <h3>Fee Payment Reminder</h3>
          <p><strong>Type:</strong> Notice</p>
          <p><strong>Date:</strong> 2025-10-20</p>
          <p>All students are reminded to pay the 2nd semester fees before the 25th of October.</p>
        </div>
      </div>

      <div class="news-card">
        <div class="card-body">
          <h3>Guest Lecture on Digital Marketing</h3>
          <p><strong>Type:</strong> Event</p>
          <p><strong>Date:</strong> 2025-10-25</p>
          <p>Renowned industry expert will give a lecture on the latest trends in digital marketing.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal Popup -->
  <div class="modal" id="newsModal">
    <div class="modal-content">
      <span class="close-btn" id="closeModal">&times;</span>
      <h3>Publish Notice / Event</h3>

      <div class="tab-buttons">
        <button class="tab-btn active" data-tab="notice">Notice</button>
        <button class="tab-btn" data-tab="event">Event</button>
      </div>

      <div class="tab-content active" id="notice">
        <input type="text" id="noticeTitle" placeholder="Notice Heading">
        <textarea id="noticeMessage" placeholder="Notice Message"></textarea>
        <input type="date" id="noticeDate">
        <button class="btn btn-primary" id="publishNotice">Publish Notice</button>
      </div>

      <div class="tab-content" id="event">
        <input type="text" id="eventTitle" placeholder="Event Heading">
        <textarea id="eventMessage" placeholder="Event Message"></textarea>
        <input type="date" id="eventDate">
        <button class="btn btn-primary" id="publishEvent">Publish Event</button>
      </div>
    </div>
  </div>

  <script>
    // Modal open/close
    const modal = document.getElementById("newsModal");
    const openModalBtn = document.getElementById("openModalBtn");
    const closeModalBtn = document.getElementById("closeModal");

    openModalBtn.addEventListener("click", () => modal.style.display = "flex");
    closeModalBtn.addEventListener("click", () => modal.style.display = "none");
    window.addEventListener("click", (e) => { if (e.target === modal) modal.style.display = "none"; });

    // Tab switching
    document.querySelectorAll(".tab-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
        document.querySelectorAll(".tab-content").forEach(tc => tc.classList.remove("active"));
        btn.classList.add("active");
        document.getElementById(btn.dataset.tab).classList.add("active");
      });
    });

    // Publish functions
    function createCard(type, title, message, date) {
      const grid = document.getElementById("newsEventsGrid");
      const card = document.createElement("div");
      card.classList.add("news-card");

      card.innerHTML = `
        <div class="card-body">
          <h3>${title}</h3>
          <p><strong>Type:</strong> ${type}</p>
          <p><strong>Date:</strong> ${date}</p>
          <p>${message}</p>
        </div>
      `;
      grid.prepend(card);
    }

    document.getElementById("publishNotice").addEventListener("click", () => {
      const title = document.getElementById("noticeTitle").value;
      const message = document.getElementById("noticeMessage").value;
      const date = document.getElementById("noticeDate").value;
      if(title && message && date) {
        createCard("Notice", title, message, date);
        modal.style.display = "none";
        Swal.fire("Published!", "Notice has been published.", "success");
      }
    });

    document.getElementById("publishEvent").addEventListener("click", () => {
      const title = document.getElementById("eventTitle").value;
      const message = document.getElementById("eventMessage").value;
      const date = document.getElementById("eventDate").value;
      if(title && message && date) {
        createCard("Event", title, message, date);
        modal.style.display = "none";
        Swal.fire("Published!", "Event has been published.", "success");
      }
    });
  </script>
</body>

</html>