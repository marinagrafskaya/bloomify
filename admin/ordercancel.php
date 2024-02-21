<?php
include "../assets/connect/db.php";
$id = $_POST["id"];
$cause = $_POST["cause"];
if($cause != "") {
 $sql = "UPDATE `orders` SET `status`=4 , `cause` = '$cause' WHERE `id_order` = $id ;";   
} else {
    $sql = "UPDATE `orders` SET `status`=4  WHERE `id_order` = $id ;";   
}

$data = $db->query($sql);
?>