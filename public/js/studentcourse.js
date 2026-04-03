document.addEventListener('DOMContentLoaded', function() {
    // Popups
    const coursePopup = document.getElementById('coursePopup');
    const registrationPopup = document.getElementById('registrationPopup');

    // Buttons
    const closePopupBtn = document.getElementById('closePopup');
    const closeRegPopupBtn = document.getElementById('closeRegPopup');
    const cancelRegBtn = document.getElementById('cancelRegBtn');

    // Forms
    const registrationForm = document.getElementById('registrationForm');
    const formCourseName = document.getElementById('formCourseName');
    const formCourseId = document.getElementById('formCourseId');

    // ----- Open Course Details Popup when card is clicked -----
    document.querySelectorAll('.course-card').forEach(card => {
        card.addEventListener('click', () => {
            document.getElementById('popupTitle').textContent = card.dataset.name;
            document.getElementById('popupImage').src = card.dataset.image;
            document.getElementById('popupDescription').textContent = card.dataset.description;
            document.getElementById('popupCategory').textContent = card.dataset.category;
            document.getElementById('popupEnroll').textContent = card.dataset.enroll;
            document.getElementById('popupDuration').textContent = card.dataset.duration;
            document.getElementById('popupLocation').textContent = card.dataset.location;
            document.getElementById('popupInstructor').textContent = card.dataset.instructor;
            coursePopup.style.display = 'flex';
        });
    });

    // ----- Open Registration Popup when Register button is clicked -----
    document.querySelectorAll('.card-register-btn').forEach(button => {
        button.addEventListener('click', (event) => {
            event.stopPropagation(); // prevent opening details popup

            const card = event.target.closest('.course-card');
            if (card) {
                // Set course ID and name in the form
                formCourseId.value = card.dataset.id;
                formCourseName.value = card.dataset.name;

                // Show registration popup
                registrationPopup.style.display = 'flex';
            }
        });
    });

    // ----- Close Popups -----
    function closeDetailsModal() { coursePopup.style.display = 'none'; }
    function closeRegistrationModal() {
        registrationPopup.style.display = 'none';
        registrationForm.reset();
    }

    closePopupBtn.addEventListener('click', closeDetailsModal);
    closeRegPopupBtn.addEventListener('click', closeRegistrationModal);
    cancelRegBtn.addEventListener('click', closeRegistrationModal);

    // Close popup if clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === coursePopup) closeDetailsModal();
        if (event.target === registrationPopup) closeRegistrationModal();
    });

    // ----- Optional SweetAlert before form submission -----
    registrationForm.addEventListener('submit', function(event) {
        // Let form submit normally (no preventDefault)
        // Show alert after submission via Laravel session flash (recommended)
    });

    // ----- Filter Form Logic (existing) -----
    const filterForm = document.querySelector('.filter-form');
    if (filterForm) {
        const searchInput = filterForm.querySelector('input[name="search"]');
        const selectInputs = filterForm.querySelectorAll('select');
        let debounceTimer;
        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => { filterForm.submit(); }, 500);
        });
        selectInputs.forEach(select => {
            select.addEventListener('change', () => { filterForm.submit(); });
        });
    }
});
