<?php

 include '../assets/connect/db.php';


   $id = $_POST["removeproduct"];

   $sql = "DELETE FROM `products` WHERE `id_product` = $id ;";
   $data = $db->query($sql);
  
 
?>