
   

    // Location form
    const locationForm = document.getElementById("locationForm");
    const locationsGrid = document.getElementById("locationsGrid");

   
    // Course form
    const courseForm = document.getElementById("courseForm");
    const coursesGrid = document.getElementById("coursesGrid");

    courseForm.addEventListener("submit", function(e) {
      e.preventDefault();
      const cid = document.getElementById("courseCID").value.trim();
      const name = document.getElementById("courseName").value.trim();
      const image = document.getElementById("imageURL").value.trim();
      const enroll = document.getElementById("enrollOption").value;
      const instructor = document.getElementById("instructor").value.trim();
      const location = document.getElementById("location").value.trim();
      const category = document.getElementById("category").value.trim();
      const duration = document.getElementById("duration").value.trim();
      const desc = document.getElementById("description").value.trim();

      const card = document.createElement("div");
      card.classList.add("course-card");
      card.innerHTML = `
        <img src="${image}" alt="${escapeHtml(name)}">
        <div class="card-body">
          <h3>${escapeHtml(name)}</h3>
          <p><strong>CID:</strong> ${escapeHtml(cid)}</p>
          <p><strong>Enroll:</strong> ${escapeHtml(enroll)}</p>
          <p><strong>Instructor:</strong> ${escapeHtml(instructor)}</p>
          <p><strong>Duration:</strong> ${escapeHtml(duration)}</p>
        </div>
        <div class="course-actions">
          <span class="view-details" onclick="alert(${JSON.stringify(desc)})">View More</span>
          <div>
            <button class="btn btn-warning btn-sm">Update</button>
            <button class="btn btn-danger btn-sm">Delete</button>
          </div>
        </div>
      `;
      coursesGrid.appendChild(card);
      courseForm.reset();
    });

    // escape HTML helper
    function escapeHtml(text) {
      if (!text) return '';
      return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
    }


