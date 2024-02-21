<?php
include '../assets/connect/db.php';
$addCategory = $_POST["categoty"];
$sql = "INSERT INTO `сategory`(`Сategory`) VALUES ('$addCategory')";
$data = $db->query($sql);
if($data) {
    $response = [
        "message" => "Категория добавлена",
     ];
     echo json_encode($response);
}
?>