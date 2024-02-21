<?php
include '../assets/connect/db.php';
$input = file_get_contents('php://input');
$input = json_decode($input);
$id = $input->id;
$id = json_encode($id);
$sql = "DELETE FROM `orders` WHERE `id_order` = $id";
$result = $db->query($sql);
