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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    $blogController->addBlog($title, $description, $image);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete'])) {
    $blogId = $_GET['delete'];

    $blogController->deleteBlog($blogId);
    header('Location: adminBlogs.php');
    exit;
}

$blogs = $blogController->getAllBlogs();
$errMessage = $blogController->getErrorMessage();
$succeedMessage = $blogController->getSucceedMessage();

if (!$blogs) {
    $blogs = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Blogs</title>
    <link rel="stylesheet" href="css/adminBlogs.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="sidebar">
        <h2>Furnitia</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="AdminUser.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="adminProducts.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-question-circle"></i> Support</a></li>
        </ul>
    </div>
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Blogs</h1>
            <div class="actions">
                <i class="fas fa-bell"></i>
                <i class="fas fa-user-circle"></i>

                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
        
        <div class="add-blog-container">
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Blog Title" required>
                <input type="text" name="description" placeholder="Description" required>
                <input class="file" type="file" name="image" accept="image/*">
                <input class="submit" type="submit" name="add" value="Add Blog">
            </form>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($blogs as $blog): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($blog['id']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($blog['image']); ?>" alt="Blog Image"></td>
                        <td><?php echo htmlspecialchars($blog['title']); ?></td>
                        <td><?php echo htmlspecialchars($blog['description']); ?></td>
                        <td class="action-buttons">
                            <a href="adminBlogs.php?delete=<?php echo $blog['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this blog?')"><i class="fas fa-trash"></i> Delete</a>
                            <a href="editBlog.php?id=<?php echo $blog['id']; ?>" class="edit"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
