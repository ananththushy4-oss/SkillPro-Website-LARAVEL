<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SkillPro Institute</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('images/SkillEdge.jpg') }}" alt="SkillPro Institute Logo" class="logo-image">
            <span class="logo-text">Admin Dashboard</span>
        </div>
        <nav>
            <ul class="nav-links">
                <li><a href="{{ route('admin.dashboard') }}" >Home</a></li>
                <li><a href="{{ route('admin.instructor') }}" class="active">Instructor</a></li>
                <li><a href="{{ route('manage-courses') }}">Courses</a></li>
                <li><a href="{{ route('admin.notice') }}">News & Events</a></li>
                <li><a href="{{ route('admin.inquiries') }}">Inquiries</a></li>
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

   <!-- Add Instructor Button -->
<section class="instructor-top">
    <button class="btn-add" id="addInstructorBtn">Add Instructor</button>
  </section>
  
  <!-- Popup Modal Form (same as before) -->
  <div class="modal" id="instructorModal">
    <div class="modal-content">
      <span class="close-btn" id="closeModal">&times;</span>
      <form id="instructorForm">
        <h2 id="modalTitle">Add Instructor</h2>
        <div class="form-row">
          <div class="form-group">
            <label>Instructor Image URL</label>
            <input type="text" name="image" placeholder="Image URL" required>
          </div>
          <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="John Doe" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Instructor ID</label>
            <input type="text" name="id" placeholder="INST001" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="john@example.com" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••" required>
          </div>
          <div class="form-group">
            <label>Employment Type</label>
            <select name="employment" required>
              <option value="Full Time">Full Time</option>
              <option value="Part Time">Part Time</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Education Qualification</label>
          <input type="text" name="education" placeholder="BSc in IT" required>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn-submit">Save</button>
        </div>
      </form>
    </div>
  </div>
  
  <section class="instructors-grid" id="instructorsGrid">

    <!-- Instructor 1 -->
    <div class="instructor-card">
      <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Instructor Image" class="profile-pic">
      <div class="card-body">
        <h3>John Doe</h3>
        <p><strong>ID:</strong> INST001</p>
        <p><strong>Email:</strong> john@example.com</p>
        <p><strong>Password:</strong> ••••••</p>
        <p><strong>Employment:</strong> Full Time</p>
        <p><strong>Education:</strong> BSc IT</p>
        <div class="card-buttons">
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Delete</button>
        </div>
      </div>
    </div>
  
    <!-- Instructor 2 -->
    <div class="instructor-card">
      <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Instructor Image" class="profile-pic">
      <div class="card-body">
        <h3>Mary Smith</h3>
        <p><strong>ID:</strong> INST002</p>
        <p><strong>Email:</strong> mary@example.com</p>
        <p><strong>Password:</strong> ••••••</p>
        <p><strong>Employment:</strong> Part Time</p>
        <p><strong>Education:</strong> MSc Data Science</p>
        <div class="card-buttons">
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Delete</button>
        </div>
      </div>
    </div>
  
    <!-- Instructor 3 -->
    <div class="instructor-card">
      <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="Instructor Image" class="profile-pic">
      <div class="card-body">
        <h3>David Lee</h3>
        <p><strong>ID:</strong> INST003</p>
        <p><strong>Email:</strong> david@example.com</p>
        <p><strong>Password:</strong> ••••••</p>
        <p><strong>Employment:</strong> Full Time</p>
        <p><strong>Education:</strong> BSc Computer Engineering</p>
        <div class="card-buttons">
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Delete</button>
        </div>
      </div>
    </div>
  
    <!-- Instructor 4 -->
    <div class="instructor-card">
      <img src="https://randomuser.me/api/portraits/women/4.jpg" alt="Instructor Image" class="profile-pic">
      <div class="card-body">
        <h3>Linda Brown</h3>
        <p><strong>ID:</strong> INST004</p>
        <p><strong>Email:</strong> linda@example.com</p>
        <p><strong>Password:</strong> ••••••</p>
        <p><strong>Employment:</strong> Part Time</p>
        <p><strong>Education:</strong> BA Marketing</p>
        <div class="card-buttons">
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Delete</button>
        </div>
      </div>
    </div>
  
    <!-- Instructor 5 -->
    <div class="instructor-card">
      <img src="https://randomuser.me/api/portraits/men/5.jpg" alt="Instructor Image" class="profile-pic">
      <div class="card-body">
        <h3>Michael Johnson</h3>
        <p><strong>ID:</strong> INST005</p>
        <p><strong>Email:</strong> michael@example.com</p>
        <p><strong>Password:</strong> ••••••</p>
        <p><strong>Employment:</strong> Full Time</p>
        <p><strong>Education:</strong> MSc AI</p>
        <div class="card-buttons">
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Delete</button>
        </div>
      </div>
    </div>
  
    <!-- Instructor 6 -->
    <div class="instructor-card">
      <img src="https://randomuser.me/api/portraits/women/6.jpg" alt="Instructor Image" class="profile-pic">
      <div class="card-body">
        <h3>Emma Wilson</h3>
        <p><strong>ID:</strong> INST006</p>
        <p><strong>Email:</strong> emma@example.com</p>
        <p><strong>Password:</strong> ••••••</p>
        <p><strong>Employment:</strong> Part Time</p>
        <p><strong>Education:</strong> BSc Software Engineering</p>
        <div class="card-buttons">
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Delete</button>
        </div>
      </div>
    </div>
  
  </section>
  
  
  <script>
  const addBtn = document.getElementById('addInstructorBtn');
  const modal = document.getElementById('instructorModal');
  const closeModal = document.getElementById('closeModal');
  const instructorForm = document.getElementById('instructorForm');
  const instructorsGrid = document.getElementById('instructorsGrid');
  let editingCard = null;
  
  // Open Add Modal
  addBtn.addEventListener('click', () => {
    editingCard = null;
    document.getElementById('modalTitle').innerText = 'Add Instructor';
    instructorForm.reset();
    modal.style.display = 'flex';
  });
  
  // Close Modal
  closeModal.addEventListener('click', () => modal.style.display = 'none');
  window.addEventListener('click', e => { if(e.target === modal) modal.style.display='none'; });
  
  // Edit Instructor
  instructorsGrid.addEventListener('click', e => {
    if(e.target.classList.contains('btn-edit')) {
      editingCard = e.target.closest('.instructor-card');
      document.getElementById('modalTitle').innerText = 'Edit Instructor';
      const cardBody = editingCard.querySelector('.card-body');
      const fields = instructorForm.elements;
      fields.image.value = editingCard.querySelector('img').src;
      fields.name.value = cardBody.querySelector('h3').innerText;
      fields.id.value = cardBody.querySelectorAll('p')[0].innerText.replace('ID: ','');
      fields.email.value = cardBody.querySelectorAll('p')[1].innerText.replace('Email: ','');
      fields.password.value = '';
      fields.employment.value = cardBody.querySelectorAll('p')[3].innerText.replace('Employment: ','');
      fields.education.value = cardBody.querySelectorAll('p')[4].innerText.replace('Education: ','');
      modal.style.display = 'flex';
    }
  
    // Delete Instructor
    if(e.target.classList.contains('btn-delete')) {
      const card = e.target.closest('.instructor-card');
      Swal.fire({
        title: 'Are you sure?',
        text: "This instructor will be removed!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          card.remove();
          Swal.fire('Deleted!', 'Instructor has been deleted.', 'success');
        }
      })
    }
  });
  
  // Submit Form
  instructorForm.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(instructorForm);
    if(editingCard) {
      editingCard.querySelector('img').src = formData.get('image');
      const p = editingCard.querySelectorAll('.card-body p');
      editingCard.querySelector('.card-body h3').innerText = formData.get('name');
      p[0].innerHTML = `<strong>ID:</strong> ${formData.get('id')}`;
      p[1].innerHTML = `<strong>Email:</strong> ${formData.get('email')}`;
      p[2].innerHTML = `<strong>Password:</strong> ••••••`;
      p[3].innerHTML = `<strong>Employment:</strong> ${formData.get('employment')}`;
      p[4].innerHTML = `<strong>Education:</strong> ${formData.get('education')}`;
      Swal.fire('Success', 'Instructor updated successfully!', 'success');
    } else {
      const card = document.createElement('div');
      card.classList.add('instructor-card');
      card.innerHTML = `
        <img src="${formData.get('image')}" alt="Instructor Image" class="profile-pic">
        <div class="card-body">
          <h3>${formData.get('name')}</h3>
          <p><strong>ID:</strong> ${formData.get('id')}</p>
          <p><strong>Email:</strong> ${formData.get('email')}</p>
          <p><strong>Password:</strong> ••••••</p>
          <p><strong>Employment:</strong> ${formData.get('employment')}</p>
          <p><strong>Education:</strong> ${formData.get('education')}</p>
          <div class="card-buttons">
            <button class="btn-edit">Edit</button>
            <button class="btn-delete">Delete</button>
          </div>
        </div>
      `;
      instructorsGrid.appendChild(card);
      Swal.fire('Success', 'Instructor added successfully!', 'success');
    }
    instructorForm.reset();
    modal.style.display='none';
  });
  </script>
</body>

</html>