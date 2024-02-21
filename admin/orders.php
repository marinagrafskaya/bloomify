<?php
session_start();
include '../assets/connect/db.php';
if ($_SESSION['user']['auth'] != true) {
    header("Location:  ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media.css">

</head>

<body>
    <!-- Шапка -->

    <?php include "templates/header.php"; ?>
    <!-- Шапка -->

    <div class="content">
        <div class="conteiner">
            <div class="order">
                <h2>Заказы</h2>
                <div class="sort-filter">
                    <div class="frame">
                        <select class="sort" onchange="filter(this.value)">
                            <option value="" disabled selected>Фильтрация по статусу заказа:</option>
                            <option value="1">Оформленные</option>
                            <option value="5">Полученные</option>
                            <option value="4">Отмененные</option>

                        </select>

                    </div>

                </div>
                <?php
                $sql = "SELECT * FROM `orders`  ORDER BY id_order DESC;";
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
                        $user_id = $row["user_id"];
                        $cause = $row["cause"];
                        $delivery = $row["delivery"];
                        $address = $row["address"];
                        $sql = "SELECT * FROM `status` WHERE id = $status";
                        $statusresult = $db->query($sql);
                        $statusresult = $statusresult->fetchAll();
                        foreach ($statusresult as $row) {
                            $status2 = $row["status"];
                        }
                        $sql3 = "SELECT `name`, `surname`, `patronymic` FROM `users` WHERE id_user = $user_id ;";
                        $result3 = $db->query($sql3);
                        $result3 = $result3->fetchAll();
                        foreach ($result3 as $row) {
                            $name = $row["name"];
                            $surname = $row["surname"];
                            $patronymic = $row["patronymic"];
                        };
                        $sql2 = "SELECT * FROM `orders_products` WHERE id_order = $orders_id ;";
                        $result2 = $db->query($sql2);
                        $result2 = $result2->fetchAll();
                        echo '
                        <div class="item-order" data-status="' . $status . '">
                        <p> Номер заказа : ' . $number_orders . '</p>
                        <p>Заказчик: ' . $surname . ' '  . $name . ' ' . $patronymic . '</p>
                        <p class="date">' . $date . '</p>
                        <p> Статус : ' . $status2 . '</p>
                        <p>' . $delivery. ': ' . $address . '</p>';
                        if ($status == 1) {
                            $delivery = "'".$delivery."'";
                            echo '<p class="order-remove confirm" onclick="confirmOrders('.$orders_id.','.$delivery.')">'.'Подтвердить</p>';
                            echo '<div class="flex-otmena">';
                            echo '<textarea class="cause"></textarea>';
                            echo '<p class="order-remove cansel" onclick="ordercancel(' . $orders_id  . ')">Отменить</p>';
                            echo '</div>';
                        }
                        if( $status == 2 || $status == 3) {
                        echo '<p class="order-remove confirm" onclick="receivedOrders(' . $orders_id  . ')">Получен</p>';
                        }
                        if ($status == 4) {
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
                                '<div class="img"><img src="../../assets/img/' . $foto . '"></div>'.
                                '<p>'.$price.' ₽</p>'.
                                '<p>'.$quantity.' шт.</p>'
                                .'</div>';
                            }
                        }
                        echo '</div>';
                        echo '<p class="sum"> Сумма : ' . $sum . ' ₽</p>
                        </div>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="notorders" >Пусто</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Товары -->

    <!-- Контент -->

    <?php include 'templates/footer.html'; ?>


    <script src="../assets/js/menu.js"></script>
    <script src="assets/js/orders.js"></script>
    <script>
        

  
    </script>





    </div>
</body>

</html>