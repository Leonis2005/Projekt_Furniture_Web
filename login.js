document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    let isValid = true;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    // Reset error messages
    emailError.textContent = '';
    passwordError.textContent = '';

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
        window.location.href = "home.html"; 
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
