<?php
include "../assets/connect/db.php";
$id = $_POST["id"];
$delivery = $_POST["delivery"];
if($delivery == "Самовывоз") {
    $status = 3;
} else {
    $status = 2;
}
$sql = "UPDATE `orders` SET `status`= $status WHERE `id_order` = $id ;";
$data = $db->query($sql);
