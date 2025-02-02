<?php
include_once 'BlogRepository.php';
include_once 'DBBlog.php';

class BlogController
{
    private $blogs = [];
    private $errorMessage;
    private $succeedMessage;

    public function __construct()
    {
        $this->blogs = [];
        $this->errorMessage = "";
        $this->succeedMessage = "";
    }

    public function getAllBlogs()
    {
        $repo = new BlogRepository();
        $this->blogs = $repo->getBlogs();
        return $this->blogs; // Ensure this method returns the blogs array
    }

    public function addBlog($title, $description, $image)
    {
        $repo = new BlogRepository();

        if (empty($title) || empty($description)) {
            $this->errorMessage = "All fields are required.";
            return;
        }

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'image/';
            $fileName = basename($image['name']);
            $uploadPath = $uploadDir . $fileName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
                $repo->addBlogToDatabase(htmlspecialchars($title), htmlspecialchars($description), htmlspecialchars($uploadPath));
                $this->succeedMessage = "Blog added successfully.";
            } else {
                $this->errorMessage = "Failed to upload the image.";
            }
        } else {
            $this->errorMessage = "Invalid image file.";
        }
    }

    public function deleteBlog($id)
    {
        $repo = new BlogRepository();

        if (empty($id) || !is_numeric($id)) {
            $this->errorMessage = "Invalid blog ID.";
            return;
        }

        $deleted = $repo->deleteBlogById($id);

        if ($deleted) {
            $this->succeedMessage = "Blog deleted successfully.";
        } else {
            $this->errorMessage = "Failed to delete the blog.";
        }
    }

    public function editBlog($id, $title, $description, $newImage = null)
    {
        $repo = new BlogRepository();

        if (empty($title) || empty($description)) {
            $this->errorMessage = "All fields are required.";
            return;
        }

        $existingBlog = $repo->getBlogById($id);
        if (!$existingBlog) {
            $this->errorMessage = "Blog not found.";
            return;
        }

        $imagePath = $existingBlog['image'];

        if ($newImage && $newImage['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'image/';
            $fileName = basename($newImage['name']);
            $uploadPath = $uploadDir . $fileName;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            if (move_uploaded_file($newImage['tmp_name'], $uploadPath)) {
                $imagePath = $uploadPath;
            } else {
                $this->errorMessage = "Failed to upload the new image.";
                return;
            }
        }

        $updated = $repo->updateBlog($id, htmlspecialchars($title), htmlspecialchars($description), htmlspecialchars($imagePath));

        if ($updated) {
            $this->succeedMessage = "Blog updated successfully.";
        } else {
            $this->errorMessage = "Failed to update the blog.";
        }
    }

    public function getBlogs()
    {
        return $this->blogs;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getSucceedMessage()
    {
        return $this->succeedMessage;
    }
}
?>
