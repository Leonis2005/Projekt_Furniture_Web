<?php
session_start();

if (!isset($_SESSION['adminemail'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furnitia - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<div class="sidebar">
        <h2>Furnitia</h2>
        <ul>
            
            <li><a href="AdminUser.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="adminProducts.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="adminBlogs.php"><i class="fa-solid fa-blog"></i> Blogs</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Support</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Welcome, Admin!</h1>
            <div class="actions">
                <i class="fas fa-bell"></i>
                <i class="fas fa-user-circle"></i>

                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="cards">
            <div class="card">
                <h3>100</h3>
                <p>Active Users</p>
            </div>
            <div class="card">
                <h3>20</h3>
                <p>Products</p>
            </div>
            <div class="card">
                <h3>15</h3>
                <p>Orders Today</p>
            </div>
            <div class="card">
                <h3>$1500</h3>
                <p>Total Revenue</p>
            </div>
        </div>
    </div>

</body>

</html>