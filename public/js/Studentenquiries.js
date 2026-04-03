// ===== Get Elements =====
const filterCategory = document.getElementById('filterCategory');
const filterLocation = document.getElementById('filterLocation');
const filterDuration = document.getElementById('filterDuration');
const filterInstructor = document.getElementById('filterInstructor');
const resetBtn = document.getElementById('resetFilters');
const searchCourse = document.getElementById('searchCourse');
const searchBtn = document.getElementById('searchBtn');

const coursesGrid = document.getElementById('coursesGrid');
const courses = Array.from(coursesGrid.getElementsByClassName('course-card'));
const noCoursesMessage = document.getElementById('noCoursesMessage');

// ===== Filter Function =====
function filterCourses() {
    const category = filterCategory.value.toLowerCase();
    const location = filterLocation.value.toLowerCase();
    const duration = filterDuration.value.toLowerCase();
    const instructor = filterInstructor.value.toLowerCase();
    const searchText = searchCourse.value.toLowerCase();

    let visibleCount = 0;

    courses.forEach(course => {
        const title = course.querySelector('h3').textContent.toLowerCase();
        const matchesCategory = !category || course.dataset.category.toLowerCase() === category;
        const matchesLocation = !location || course.dataset.location.toLowerCase() === location;
        const matchesDuration = !duration || course.dataset.duration.toLowerCase() === duration;
        const matchesInstructor = !instructor || course.dataset.instructor.toLowerCase() === instructor;
        const matchesSearch = !searchText || title.includes(searchText);

        if (matchesCategory && matchesLocation && matchesDuration && matchesInstructor && matchesSearch) {
            course.style.display = 'block';
            visibleCount++;
        } else {
            course.style.display = 'none';
        }
    });

    // Show or hide "No courses available" message
    if (visibleCount === 0) {
        noCoursesMessage.style.display = 'block';
    } else {
        noCoursesMessage.style.display = 'none';
    }
}

// ===== Event Listeners =====
// Filters
filterCategory.addEventListener('change', filterCourses);
filterLocation.addEventListener('change', filterCourses);
filterDuration.addEventListener('change', filterCourses);
filterInstructor.addEventListener('change', filterCourses);

// Search input (real-time)
searchCourse.addEventListener('input', filterCourses);


// Reset button
resetBtn.addEventListener('click', () => {
    filterCategory.value = '';
    filterLocation.value = '';
    filterDuration.value = '';
    filterInstructor.value = '';
    searchCourse.value = '';
    filterCourses();
});

// ===== Prevent popup on Register button =====
const registerButtons = document.querySelectorAll('.register-btn');
registerButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.stopPropagation(); // Stop popup
        e.preventDefault(); // Prevent default # action
        // Optional: redirect can be added later
        alert("Redirect to register page"); 
    });
});

// ===== Popup Functionality =====
const coursePopup = document.getElementById('coursePopup');
const closePopup = document.getElementById('closePopup');
const popupImage = document.getElementById('popupImage');
const popupTitle = document.getElementById('popupTitle');
const popupEnroll = document.getElementById('popupEnroll');
const popupInstructor = document.getElementById('popupInstructor');
const popupDuration = document.getElementById('popupDuration');
const popupDescription = document.getElementById('popupDescription');

// Sample descriptions
const courseDescriptions = {
    "ICT Fundamentals": "Learn the basics of Information and Communication Technology. Gain practical skills in computer systems and software. Perfect for beginners starting in ICT.",
    "Business Management": "Understand essential business concepts and management techniques. Learn to plan, organize, and lead teams effectively. Suitable for aspiring managers.",
    "Graphic Design Basics": "Introduction to visual design principles, typography, and color theory. Learn to create simple graphics using popular tools. Great for creative beginners.",
    "Advanced ICT": "Deep dive into advanced ICT topics including networking and databases. Build real-world projects to enhance your skills. Ideal for ICT learners with basic knowledge.",
    "Business Strategy": "Learn strategic planning, market analysis, and decision-making skills. Develop critical thinking for business growth. Best for future business leaders.",
    "UX Design Fundamentals": "Explore user experience design concepts and processes. Create intuitive and user-friendly interfaces. Perfect for aspiring UX/UI designers."
};

// Open popup on course click
courses.forEach(course => {
    course.addEventListener('click', () => {
        popupImage.src = course.querySelector('img').src;
        popupTitle.textContent = course.querySelector('h3').textContent;
        popupEnroll.textContent = course.querySelector('p:nth-of-type(1)').textContent.replace("Enroll: ", "");
        popupInstructor.textContent = course.querySelector('p:nth-of-type(2)').textContent.replace("Instructor: ", "");
        popupDuration.textContent = course.querySelector('p:nth-of-type(3)').textContent.replace("Duration: ", "");
        popupDescription.textContent = courseDescriptions[popupTitle.textContent] || "No description available.";

        coursePopup.style.display = 'flex';
    });
});

// Close popup
closePopup.addEventListener('click', () => {
    coursePopup.style.display = 'none';
});

// Close popup when clicking outside content
window.addEventListener('click', (e) => {
    if (e.target === coursePopup) {
        coursePopup.style.display = 'none';
    }
});

   // Handle enquiry form submission with SweetAlert2
        document.getElementById('enquiryForm').addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Enquiry Submitted!',
                text: 'Your enquiry has been sent successfully.',
                icon: 'success',
                confirmButtonColor: '#008851',
            }).then(() => {
                this.submit();
            });
        });
