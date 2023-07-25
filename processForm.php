<?php

require_once 'DB.php';

$server = "localhost";
$username = "root";
$password = "";
$dbname = "app_db";

//if (!CreateDatabase::$created) {    // можно использовать для создания бд
//    $db = new CreateDatabase($server, $username, $password, $dbname);
//}



$db = new Database($server, $username, $password, $dbname);



$pattern = '/^\+7\d{10}$/'; // паттерн проверки корректности номера

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    if (!preg_match($pattern, $phone)) echo "Телефонный номер некорректный.";

    elseif (empty($name) || empty($email) || empty($phone)) {
        echo "Пожалуйста, заполните все поля.";
    } else {
        if ($db->add($name, $email, $phone) !== false) {
            echo "Данные успешно сохранены в базе данных.";
        }
        else echo "Ошибка при выполнении запроса";
    }
}