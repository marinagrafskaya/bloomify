<?php
session_start();
$input = file_get_contents('php://input');
$input = json_decode($input);
$id = $input->id;
$id = json_encode($id);
$id_user = $_SESSION['user']['id'];
$key = array_search($id, $_SESSION['cart'][$id_user]);
unset($_SESSION['cart'][$id_user][$key]);
