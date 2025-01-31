<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['useremail'])) {
  header('Location:index.php');
  exit;
}
require_once 'registerController.php';

$registerController = new RegisterController();
$registerController->RegisterController();
$errorMsg = $registerController->getErrorMessage();
$succedMsg = $registerController->getSuccedMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/register.css">
    <style>
        .error {
            color: red;
            margin-top: 0.5rem;
            font-size: 1.4rem;
        }
    </style>
</head>
<body>

    <!-- Register Form -->
    <div class="form-container" id="registerPage">
            <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <h3>Create Your Account</h3>
            <input type="text" id="username" placeholder="Enter your username" class="box" name ="username">
            <span id="usernameError" class="error"></span>
            <input type="email" id="email" placeholder="Enter your email" class="box " name ="password">
            <span id="emailError" class="error"></span>
            <input type="password" id="password" placeholder="Enter your password" class="box">
            <span id="passwordError" class="error"></span>
            <input type="password" id="confirmPassword" placeholder="Confirm your password" class="box" name ="password">
            <span id="confirmPasswordError" class="error"></span>
            <input type="text" id="address" placeholder="Enter your address" class="box">
            <input type="date" id="birthDate" class="box">
            <input type="submit" value="Register Now" class="btn" name ="registerBtn"> 
            <p>Already have an account? <a href="login.html" id="login-link">Login now</a></p>
        </form>
    </div>

    <script src="js/register.js"></script>
</body>
</html>
