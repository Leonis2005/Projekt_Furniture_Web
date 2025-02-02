<?php
class DBConnection
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "furniture_web";
    private $connection;

    function startConn()
    {
        // Create a new connection
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        return $this->connection;
    }

    // Add this method
    public function getConnection()
    {
        return $this->connection;
    }
}
?>
