<?php
session_start();
include 'assets/connect/db.php';
if (!$_SESSION['user']['auth'] === true) {
    header("Location:  index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media.css">
</head>

<body>
    <!-- Шапка -->

    <?php include "templates/header.php"; ?>

    <!-- Шапка -->

    <!-- Контент -->

    <!-- Шапка -->
    <div class="content">
        <div class='conteiner'>
            <div class="order">
                <?php
                $id = $_SESSION['user']['id'];
                $sql = "SELECT * FROM `orders` WHERE `user_id` = $id ORDER BY `id_order` DESC;";
                $result = $db->query($sql);
                $result = $result->fetchAll();
                if ($result) {
                    echo '<div class="orders">';
                    foreach ($result as $row) {
                        $orders_id = $row["id_order"];
                        $number_orders = $row["number_orders"];
                        $date = $row["date"];
                        $status = $row["status"];
                        $sum = $row["sum"];
                        $cause = $row["cause"];
                        $delivery = $row["delivery"];
                        $address = $row["address"];
                        $sql = "SELECT * FROM `status` WHERE id = $status";
                        $statusresult = $db->query($sql);
                        $statusresult = $statusresult->fetchAll();
                        foreach ($statusresult as $row) {
                            $status2 = $row["status"];
                        }
                        $sql = "SELECT * FROM `orders_products` WHERE id_order = $orders_id ;";
                        $result2 = $db->query($sql);
                        $result2 = $result2->fetchAll();
                        echo '
                        <div class="item-order">
                        <p> Номер заказа : ' . $number_orders . '</p>
                        <p class="date">' . $date . '</p>
                        <p> Статус : ' . $status2 . '</p>'.
                        '<p>' .$delivery. ': ' . $address . '</p>';
                        if ($status == 1) {
                            echo '<p class="order-remove" onclick="remove(' . $orders_id . ')">Удалить</p>';
                        }
                        if ($status == 'Отменен') {
                            echo '<p>Причина отмены : ' . $cause . '</p>';
                        }
                        $sumq = 0;
                        echo '<div class="wrapper-orders_products">';
                        foreach ($result2 as $row) {
                            $product = $row["id_product"];
                            $quantity = $row["quantity"];
                            $sql = "SELECT * FROM `products` WHERE id_product = $product;";
                            $result3 = $db->query($sql);
                            $result3 = $result3->fetchAll();
                            foreach ($result3 as $row) {
                                $foto = $row["foto"]; 
                                $price = $row["price"]; 
                                echo  '<div class="orders_products">'.
                                '<div class="img"><img src="assets/img/' . $foto . '"></div>'.
                                '<p>'.$price.' ₽</p>'.
                                '<p>'.$quantity.' шт.</p>'
                                .'</div>';
                            }
                        }
                        echo '</div>';
                        echo '<p class="sum"> Сумма : ' . $sum . ' ₽</p>';

                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo "<div class='notorders'>Пусто</div>";
                }
                ?>

            </div>

        </div>
    </div>

    <!-- Контент -->

    <!--Подвал -->


    <?php include 'templates/footer.html'; ?>

    <!--Подвал -->
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/order.js"></script>

</body>

</html>