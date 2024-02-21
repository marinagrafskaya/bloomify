<?php
include "../assets/connect/db.php";
$id = $_POST["id"];
$delivery = $_POST["delivery"];
$sql = "UPDATE `orders` SET `status`= 5 WHERE `id_order` = $id ;";
$data = $db->query($sql);
$sql2 = "SELECT * FROM `orders_products` WHERE `id_order` = $id ;";
$result = $db->query($sql2);
$result = $result->fetchAll();
foreach ($result as $row) {
    $id_product = $row["id_product"];
    $quantity = $row["quantity"];
    $sql3 = "UPDATE `products` SET `quantity`=`quantity`- $quantity  WHERE `id_product` = $id_product ;";
    $db->query($sql3);
}