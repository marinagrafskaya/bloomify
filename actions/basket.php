<?php
session_start();
include '../assets/connect/db.php';
$input = file_get_contents('php://input');
$input = json_decode($input);
$id = $input->id;
$id = json_encode($id);
$id_user = $_SESSION['user']['id'];
    if($_SESSION['cart'][$id_user]) {
    if (!in_array($id, $_SESSION['cart'][$id_user])) {
    array_push($_SESSION['cart'][$id_user], $id);
    $response = [
        "message" => "Добавлено", 
    ];
    } else {
        $response = [
            "message" => "Товар уже в корзине", 
        ];
    }
    } else {
        $_SESSION['cart'][$id_user] = array();
        array_push($_SESSION['cart'][$id_user], $id);
        $response = [
            "message" => "Добавлено", 
        ];
    }
    echo json_encode($response);                 