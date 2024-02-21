<?php

include '../assets/connect/db.php';

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
}

$sql = "INSERT INTO `products`(`foto`, `title`, `price`, `category`, `quantity`) VALUES ('$name','$title','$price','$category','$quantity');";
$data = $db->query($sql);
if($data) {
   $response = [
      "message" => "Товар добавлен",
   ];
   echo json_encode($response);
} 
?>
