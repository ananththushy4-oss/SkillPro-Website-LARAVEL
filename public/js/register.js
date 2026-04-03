document.addEventListener('DOMContentLoaded', () => {
    const registrationForm = document.getElementById('registrationForm');
    const userRoleSelect = document.getElementById('userRole');
    const registerCodeGroup = document.getElementById('registerCodeGroup');
    const phoneNumberInput = document.getElementById('phoneNumber');
    const registerCodeInput = document.getElementById('registerCode');

    // Toggle password visibility
    window.togglePasswordVisibility = function(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const toggleIcon = passwordInput.parentElement.querySelector('.toggle-password i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    };

    // Show/hide Register Code field based on user role
    userRoleSelect.addEventListener('change', () => {
        if (userRoleSelect.value === 'Admin' || userRoleSelect.value === 'Instructor') {
            registerCodeGroup.style.display = 'block';
            registerCodeInput.setAttribute('required', 'required');
        } else {
            registerCodeGroup.style.display = 'none';
            registerCodeInput.removeAttribute('required');
        }
    });

    // Form submission and validation
    registrationForm.addEventListener('submit', (event) => {
        event.preventDefault();
        
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const phoneNumber = phoneNumberInput.value.trim();
        const registerCode = registerCodeInput.value.trim();
        const forgotPin = document.getElementById('forgotPin').value.trim();

        // 1. Check for empty required fields
        const requiredFields = registrationForm.querySelectorAll('input[required]');
        for (let field of requiredFields) {
            if (!field.value.trim()) {
                alert('Please fill out all required fields.');
                return;
            }
        }

        // 2. Password match
        if (password !== confirmPassword) {
            alert('Password and Confirm Password do not match!');
            return;
        }

        // 3. Phone number validation
        const phonePattern = /^(0|94|\+94)?[0-9]{9}$/;
        if (!phonePattern.test(phoneNumber)) {
            alert('Please enter a valid phone number (e.g., 07XXXXXXXX).');
            return;
        }

        // 4. Register Code validation for Admin/Instructor
        if (userRoleSelect.value === 'Admin' || userRoleSelect.value === 'Instructor') {
            const lastFourDigits = phoneNumber.slice(-4);
            if (registerCode !== lastFourDigits) {
                alert('Invalid Register Code. .');
                return;
            }
        }

        // 5. Forgot Pin validation (4 digits)
        if (!/^\d{4}$/.test(forgotPin)) {
            alert('Forgot Pin must be a 4-digit number.');
            return;
        }

       

        // Submit the form to backend
        registrationForm.submit();
    });
});
