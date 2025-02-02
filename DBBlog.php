<?php

include_once 'DBConnection.php';
include_once 'BlogEntity.php';

class DBBlog
{
    private $connection;

    function __construct()
    {
        $conn = new DBConnection();
        $this->connection = $conn;
    }

    function insertBlog($blog)
    {
        $conn = $this->connection->startConn();

        $id = $blog->getId();
        $title = $blog->getTitle();
        $image = $blog->getImage();
        $description = $blog->getDescription();

        $sql = "INSERT INTO blogs (id, title, image, description) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $id, $title, $image, $description);  // Using parameterized query to prevent SQL injection

        if ($stmt->execute()) {
            echo 'Blog inserted successfully!';
        } else {
            echo 'This is an ERROR: ' . $stmt->error;
        }
        $stmt->close();
    }

    function getBlogs()
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM blogs";
        $blogs = [];

        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $blogs[] = new BlogEntity(
                    $row['id'],
                    $row['title'],
                    $row['image'],
                    $row['description']
                );
            }
        } else {
            echo 'This is an ERROR: ' . $conn->error;
            return null;
        }
        return $blogs;
    }

    function getBlogByNameAndId($name, $blog_id)
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM blogs WHERE title = ? OR id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $name, $blog_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $blog = $result->fetch_assoc();
            $stmt->close();
            return $blog ? new BlogEntity($blog['id'], $blog['title'], $blog['image'], $blog['description']) : null;
        } else {
            echo 'This is an ERROR: ' . $stmt->error;
            return null;
        }
    }

    function getBlogById($blog_id)
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM blogs WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $blog_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $blog = $result->fetch_assoc();
            $stmt->close();
            return $blog ? new BlogEntity($blog['id'], $blog['title'], $blog['image'], $blog['description']) : null;
        } else {
            echo 'This is an ERROR: ' . $stmt->error;
            return null;
        }
    }
}
?>
