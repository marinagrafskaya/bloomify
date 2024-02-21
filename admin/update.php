<?php

include '../assets/connect/db.php';
$id = $_POST["id"];
 $title = $_POST["title"];
 $price = $_POST["price"];
 $category = $_POST["category"];
 $quantity = $_POST["quantity"];

 $price = preg_replace("/\s+/", "", $price);

if(!empty($_FILES["foto"])) {
   $foto = $_FILES["foto"];
   $name = $foto["name"];
   $pathFile = "../assets/img/".$name;
   move_uploaded_file($foto["tmp_name"], $pathFile);
   $fotosql = "`foto`= '$name',";
}

$sql = "UPDATE `products` SET " . $fotosql . " `title`='$title',`price`='$price',`category`='$category',`quantity`='$quantity' WHERE `id_product` = $id ;";
$data = $db->query($sql);
if($data) {
    $response = [
       "message" => "Товар изменён",
    ];
    echo json_encode($response);
 } 
?>