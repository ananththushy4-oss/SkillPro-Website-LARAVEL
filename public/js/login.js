document.addEventListener('DOMContentLoaded', () => {
    const roleButtons = document.querySelectorAll('.role-btn');
    const backgroundDiv = document.getElementById('role-background');
    const passwordInput = document.getElementById('password');
    const togglePasswordIcon = document.querySelector('.toggle-password i');

    // Function to update background image based on role
    function updateBackgroundImage(role) {
        let imageUrl = '';
        switch (role) {
            case 'student':
                imageUrl = '/images/Student.jpg';
                break;
            case 'admin':
                imageUrl = '/images/Admin.jpg';
                break;
            case 'instructor':
                imageUrl = '/images/Instructor.jpg';
                break;
            default:
                imageUrl = '/images/Student.jpg';
        }
        backgroundDiv.style.backgroundImage = `url('${imageUrl}')`;
    }

    // Handle role button clicks
    roleButtons.forEach(button => {
        button.addEventListener('click', function() {
            roleButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            const selectedRole = this.dataset.role;
            updateBackgroundImage(selectedRole);
             document.getElementById('selectedRole').value = selectedRole.charAt(0).toUpperCase() + selectedRole.slice(1);
        });
    });

    // Toggle password visibility
    window.togglePasswordVisibility = function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordIcon.classList.remove('fa-eye');
            togglePasswordIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            togglePasswordIcon.classList.remove('fa-eye-slash');
            togglePasswordIcon.classList.add('fa-eye');
        }
    };

    // Set initial background image (default to student)
    updateBackgroundImage('student');
});