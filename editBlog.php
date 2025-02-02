<?php
include_once 'BlogController.php'; 
if (session_status() === PHP_SESSION_NONE) { 
    session_start(); 
} 
if (!isset($_SESSION['adminemail'])) { 
    header('Location: login.php'); 
    exit; 
} 
$blogController = new BlogController(); 
$blog = null; 

// Check if editing a blog
if (isset($_GET['id'])) { 
    $blog = (new BlogRepository())->getBlogById($_GET['id']); 
    if (!$blog) { 
        die("Blog not found."); 
    } 
} 

// Handle update request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) { 
    $id = $_POST['id']; 
    $title = $_POST['title']; 
    $description = $_POST['description']; 
    $newImage = $_FILES['image']; 
    $blogController->editBlog($id, $title, $description, $newImage); 
    $blog = (new BlogRepository())->getBlogById($id); 
    header('Location: adminBlogs.php'); 
    exit; 
} 

$errMessage = $blogController->getErrorMessage(); 
$succeedMessage = $blogController->getSucceedMessage(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <div class="sidebar">
        <h2>FitProShop</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="AdminUser.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="adminBlogs.php"><i class="fa-solid fa-blog"></i> Blogs</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Support</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Edit Blog</h1>
            <div class="actions">
                <i class="fas fa-bell"></i>
                <i class="fas fa-user-circle"></i>

                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>


        <?php if (!empty($errMessage)): ?>
            <div class="error-message">
                <?php echo $errMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($succeedMessage)): ?>
            <div class="success-message">
                <?php echo $succeedMessage; ?>
            </div>
        <?php endif; ?>

        <?php if ($blog): ?>
            <div class="add-blog-container">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($blog['id']); ?>">

                    <label for="title">Blog Title:</label>
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>"
                        required>

                    <label for="description">Description:</label>
                    <input type="text" id="description" name="description"
                        value="<?php echo htmlspecialchars($blog['description']); ?>" required>

                    <label>Current Image:</label>
                    <img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="Current Image"
                        style="width: 100px; height: 100px;">

                    <label for="image">Replace Image:</label>
                    <input type="file" id="image" name="image" accept="image/*">

                    <input class="submit" type="submit" name="update" value="Update Blog">
                </form>
            </div>
        <?php else: ?>
            <p>Blog not found.</p>
        <?php endif; ?>
</body>

</html>
