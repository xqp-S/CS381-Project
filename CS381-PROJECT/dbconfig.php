<?php

class db {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cinema_db"; // do not change database name
    public $conn;

    function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if($this->conn->connect_error) {
            die("Connection failed: ". $this->conn->connect_error);
        }

        return $this->conn;
    }

    function get_records($sql) {
        $result = $this->conn->query($sql);
        $arr = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arr[] = (object) $row;
            }
            return $arr;
        } else {
            return false;
        }
    }

    function insert($sql) {
        $this->conn->query($sql);
    }

    function close() {
        $this->conn->close();
    }


}