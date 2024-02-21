<?php
include '../assets/connect/db.php';
$removecategoty = $_POST["removecategoty"];
$sql = "DELETE FROM `сategory` WHERE `Сategory` = '$removecategoty';";
$data = $db->query($sql);
if($data) {
    $response = [
        "message" => "Категория удалена",
     ];
     echo json_encode($response);
}
?>