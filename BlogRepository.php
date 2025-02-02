<?php

include_once('DBConnection.php');

class BlogRepository
{
    private $connection;
    private $table = 'blogs';

    function __construct()
    {
        $conn = new DBConnection();
        $this->connection = $conn->startConn();
    }

    public function getBlogs()
    {
        $query = "SELECT * FROM " . $this->table;
        $results = $this->connection->query($query);
        $blogs = [];

        while ($row = $results->fetch_assoc()) {
            $blogs[] = $row;
        }
        return $blogs;
    }

    public function addBlogToDatabase($title, $description, $imagePath)
    {
        $query = "INSERT INTO " . $this->table . " (title, description, image) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sss", $title, $description, $imagePath);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteBlogById($id)
    {
        $query = "SELECT image FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $blog = $result->fetch_assoc();

        if ($blog) {
            if (file_exists($blog['image'])) {
                unlink($blog['image']);
            }
        }
        $stmt->close();

        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();

        return $affectedRows > 0;
    }

    public function updateBlog($id, $title, $description, $imagePath)
    {
        $query = "UPDATE " . $this->table . " 
                  SET title = ?, description = ?, image = ? 
                  WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssi", $title, $description, $imagePath, $id);
        $stmt->execute();
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
    
        return $affectedRows > 0;
    }
    
    public function getBlogById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $blog = $result->fetch_assoc();
        $stmt->close();

        return $blog;
    }
}
?>
