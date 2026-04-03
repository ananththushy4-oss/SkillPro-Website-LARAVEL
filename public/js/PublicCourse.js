document.addEventListener('DOMContentLoaded', function() {
    // ---- Course Details Popup Logic ----
    const coursePopup = document.getElementById('coursePopup');
    const closePopupBtn = document.getElementById('closePopup');

    // Open Course Details Popup when a card is clicked
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

    // ---- UPDATED: Registration Button Logic ----
    // When the card's "Register" button is clicked, ask the user to log in.
    document.querySelectorAll('.card-register-btn').forEach(button => {
    button.addEventListener('click', (event) => {
        // Stop the click from triggering the card's main click listener, which opens the details popup.
        event.stopPropagation();

        Swal.fire({
            title: 'Login Required',
            text: "To register for this course, you need to log in first. Do you want to proceed to the login page?",
            icon: 'info',
            iconColor: '#008851', 
            showCancelButton: true,
            confirmButtonText: 'Yes, go to Login!',
            cancelButtonText: 'No, cancel',
            confirmButtonColor: '#008851', 
            cancelButtonColor: '#6c757d',  
            background: '#fff',           
            color: '#0d2c1e',             
            customClass: {
                popup: 'swal-custom-popup',
                title: 'swal-custom-title',
                confirmButton: 'swal-custom-confirm-button',
                cancelButton: 'swal-custom-cancel-button'
            }

        }).then((result) => {
            
            if (result.isConfirmed) {
                window.location.href = '/login';
            }
        });
    });
});

    // ---- Course Details Popup Closing Logic ----
    function closeDetailsModal() {
        if (coursePopup) {
            coursePopup.style.display = 'none';
        }
    }

    if (closePopupBtn) {
        closePopupBtn.addEventListener('click', closeDetailsModal);
    }

    // Handle clicking outside the details popup to close it
    window.addEventListener('click', function(event) {
        if (event.target === coursePopup) {
            closeDetailsModal();
        }
    });

    // ---- Existing Filter Form Logic (Unchanged) ----
    const filterForm = document.querySelector('.filter-form');
    if (filterForm) {
        const searchInput = filterForm.querySelector('input[name="search"]');
        const selectInputs = filterForm.querySelectorAll('select');
        let debounceTimer;

        searchInput.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                filterForm.submit();
            }, 500); // Wait 500ms after user stops typing
        });

        selectInputs.forEach(select => {
            select.addEventListener('change', () => {
                filterForm.submit();
            });
        });
    }
});