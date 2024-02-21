<?php
include '../assets/connect/db.php';

$name = $_POST["name"];
$surname = $_POST["surname"];
$patronymic = $_POST["patronymic"];
$login = $_POST["login"];
$password = $_POST["password"];
$password_confir = $_POST["password_confir"];

$error_fields = [];

if ($name === '') {
    $error_fields[] = "name";
}
if ($surname === '') {
    $error_fields[] = "surname";
}
if ($patronymic === '') {
    $error_fields[] = "patronymic";
}
if ($login === '') {
    $error_fields[] = "login";
}
if ($password === '') {
    $error_fields[] = "password";
}
if ($password_confir === '') {
    $error_fields[] = "password_confir";
}
if (!empty($error_fields)) {
    $respons = [
        "status" => false,
        "message" => "Заполните все поля",
        "fields" => $error_fields
    ];
    echo json_encode($respons);
    die();
}


$sql = "SELECT `login` FROM `users` WHERE `login` = '$login';";
$result = $db->query($sql);
$result = $result->fetchAll();
if ($result) {
    $error_fields[] = "login";
    $respons = [
        "status" => false,
        "message" => "Такой логин уже существует",
        "fields" => $error_fields
    ];
    echo json_encode($respons);
    die();
}

if ($password != $password_confir) {
    $error_fields[] = "password";
    $error_fields[] = "password_confir";
    $respons = [
        "status" => false,
        "message" => "Пароли не совпадают",
        "fields" => $error_fields
    ];
    echo json_encode($respons);
    die();
}

$password = md5($password);
$sql = "INSERT INTO `users`(`name`, `surname`, `patronymic`, `login`, `password`, `role`) VALUES ('$name','$surname','$patronymic','$login','$password','Пользователь')";
$result = $db->query($sql);
$result = $result->fetchAll();
$respons = [
    "status" => true
];
echo json_encode($respons);
