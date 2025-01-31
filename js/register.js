document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting by default

    let isValid = true;
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const usernameError = document.getElementById('usernameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    // Reset error messages
    usernameError.textContent = '';
    emailError.textContent = '';
    passwordError.textContent = '';
    confirmPasswordError.textContent = '';

    // Validate username
    if (!username) {
        usernameError.textContent = 'Username is required';
        isValid = false;
    } else if (!/^[a-zA-Z0-9_]{3,15}$/.test(username)) {
        usernameError.textContent = 'Username must be 3-15 characters long and contain only letters, numbers, and underscores';
        isValid = false;
    }

    // Validate email
    if (!email) {
        emailError.textContent = 'Email is required';
        isValid = false;
    } else if (!validateEmail(email)) {
        emailError.textContent = 'Invalid email format';
        isValid = false;
    }

    // Validate password
    if (!password) {
        passwordError.textContent = 'Password is required';
        isValid = false;
    } else if (!validatePassword(password)) {
        passwordError.textContent = 'Password must be at least 8 characters long and include uppercase letters, lowercase letters, numbers, and special characters';
        isValid = false;
    }

    if (isValid) {
        window.location.href = "home.html"; // Redirect to home page
    }
});

function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(password) {
    const re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).{8,}$/;
    return re.test(String(password));
}
