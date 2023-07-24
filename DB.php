<?php

class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        try {
            $this->conn = new mysqli($servername, $username, $password, $dbname);
            if ($this->conn->connect_error) {
                throw new Exception("Ошибка соединения с базой данных: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Ошибка: " . $e->getMessage());
        }


    }


    public function add($name, $email, $phone) {
        $query = "INSERT INTO app_db.users (name, email, phone) VALUES ('$name', '$email', $phone)";
        $this->query($query);
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function __destruct() {
        $this->conn->close();
    }
}

