document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registerForm');
    const username = document.getElementById('username');
    const usernameError = document.getElementById('usernameError');
    const email = document.getElementById('email');
    const emailError = document.getElementById('emailError');
    const password = document.getElementById('password');
    const passwordError = document.getElementById('passwordError');
    
    form.addEventListener('submit', function (e) {
        let isValid = true;

        // Clear previous error messages
        usernameError.textContent = '';
        emailError.textContent = '';
        passwordError.textContent = '';

        // Validate username
        if (username.value.trim() === '') {
            usernameError.textContent = 'Username is required.';
            isValid = false;
        }

        // Validate email
        if (email.value.trim() === '') {
            emailError.textContent = 'Email is required.';
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            emailError.textContent = 'Please enter a valid email address.';
            isValid = false;
        }

        // Validate password
        if (password.value.trim() === '') {
            passwordError.textContent = 'Password is required.';
            isValid = false;
        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}$/.test(password.value.trim())) {
            passwordError.textContent = 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
