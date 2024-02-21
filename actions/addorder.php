<?php
session_start();
include '../assets/connect/db.php';
$input = file_get_contents('php://input');
$input = json_decode($input);
$order = $input->order;
$sum = $input->sum;
$address = $input->address;
$id_user = $_SESSION["user"]["id"];
$number_orders = mt_rand(100, 999);
if ($address != "") {
    $sql = "INSERT INTO `orders`(`user_id`, `number_orders`, `date`, `sum`, `status`, `delivery`, `address`) VALUES ('$id_user','$number_orders', NOW(),'$sum', 1, 'Доставка','$address');";
} else {
    $sql = "INSERT INTO `orders`(`user_id`, `number_orders`, `date`, `sum`, `status`) VALUES ('$id_user','$number_orders', NOW(),'$sum', 1);";
}
$result = $db->query($sql);
echo $sql;
$sql = "SELECT * FROM `orders` ORDER BY id_order DESC LIMIT 1";
$result2 = $db->query($sql);
$result2 = $result2->fetchAll();
foreach ($result2 as $row) {
    $orders_id = $row["id_order"];
    foreach ($order as $row) {
        $idproduct = $row->id;
        $quantity = $row->quantity;
        $sql = "INSERT INTO `orders_products`(`id_order`, `id_product`, `quantity`) VALUES ('$orders_id','$idproduct','$quantity');";
        $result3 = $db->query($sql);
    }
}
echo json_encode("1");
