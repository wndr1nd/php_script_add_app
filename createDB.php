<?php
class CreateDatabase {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public static $created;

    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        CreateDatabase::$created = true;

        $this->conn = new mysqli($servername, $username, $password);

        if ($this->conn->connect_error) {
            die("Ошибка соединения с сервером MySQL: " . $this->conn->connect_error);
        }

        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        if ($this->conn->query($sql) === TRUE) {
            echo "База данных успешно создана или уже существует.";
        } else {
            echo "Ошибка при создании базы данных: " . $this->conn->error;
        }

        $this->conn->close();

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Ошибка соединения с базой данных: " . $this->conn->connect_error);
        }
    }

    public function createTable($name) {
        $sql = "CREATE TABLE IF NOT EXISTS $name (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            phone VARCHAR(20) NOT NULL UNIQUE
        )";

        if ($this->conn->query($sql) === TRUE) {
            echo "Таблица $name успешно создана или уже существует.";
        } else {
            echo "Ошибка при создании таблицы: " . $this->conn->error;
        }

        $this->conn->close();
        // После создания закрываем соединение
    }

}

