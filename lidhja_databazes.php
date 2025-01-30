<?php

class DBConnection
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "projekt_furniture_web";

    function startConn()
    {
        if (!$conn = mysqli_connect($this->server, $this->username, $this->password, $this->dbname)) {
            return null;
        } else {
            return $conn;
    }
}
}

?>