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

    <div class="content">
        <div class="conteiner">
            <div class="basket">
                <?php
                $id_user = $_SESSION['user']['id'];
                if ($_SESSION['cart'][$id_user]) {
                    echo "<input type='hidden' name='cart' value='true'>";
                    $cart = implode(',', $_SESSION['cart'][$id_user]);
                    echo "<div class='basket-product'>";
                    $sql = "SELECT * FROM `products` WHERE `id_product` IN($cart)";
                    $result = $db->query($sql);
                    $result = $result->fetchAll();
                    foreach ($result as $row) {
                        $id = $row["id_product"];
                        $title = $row["title"];
                        $price = $row["price"];
                        $foto = $row["foto"];
                        $quantity = $row["quantity"];
                        echo '<div class="itembasket">
                        <input type="hidden" name="id" value="' . $id . '" />
                            <div class="img"><img src="assets/img/' . $foto . '"></div>
                            <h3>' . $title . '</h3>
                            <p class="price-product" data-price="' . $price . '">' . $price . ' ₽</p>
                            <p class="button-basket" onclick="removeproduct(' . $id . ')">x</p>
                            <p class="quantity"><span class="minus">-</span><span class="out">1</span><span class="plus" data-max="' . $quantity . '">+</span></p>
                            </div>
                            ';
                    }
                    echo '</div>';
                    echo '<div class="make-an-order">
                        <div class="btn-zakaz" >Заказать</div>
                      <div class="sum-zakaz" >Итого: <span></span> ₽</div></div>
                      </div>';
                      echo 
                      '<div class="tabs">
                          <div class="tab-2">
                              <label for="tab2-1">Доставка</label>
                              <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
                              <div>
                                      <p>
                                          Мы хотели бы обратить ваше внимание на важный момент при оформлении заказа - пожалуйста,
                                          убедитесь, что вы указали точный и корректный адрес доставки.
                                      </p>
                                      <p>
                                          При оформлении заказа необходимо указывать полный адрес с указанием номера дома,
                                          квартиры,
                                          подъезда и других необходимых деталей. Это позволит нам оперативно доставить ваш заказ и
                                          избежать возможных ошибок.
                                      </p>
                                      <p>
                                          Пожалуйста, помните, что некорректно указанный адрес может привести к отмене заказа. Мы
                                          стремимся обеспечить вас лучшим сервисом и качественной доставкой, поэтому просим вас
                                          быть
                                          внимательными при заполнении информации о доставке.
                                      </p>
                                  <label>Укажите адрес доставки:</label>
                                  <textarea class="address_delivery" name="address"></textarea>
                              </div>
                          </div>
                          <div class="tab-2">
                              <label for="tab2-2">Самовывоз</label>
                              <input id="tab2-2" name="tabs-two" type="radio">
                              <div>
                                  <p>
                                      Мы рады предложить вам удобный способ получения вашего заказа - забрать его самостоятельно по
                                      указанному адресу.
                                  </p>
          
                                  <p>
                                      При оформлении заказа, если вы не укажите адрес доставки, то вы автомататически выбираете опцию самовывоза и можете забрать свои покупки в удобное для
                                      вас время по адресу - <b>г. Москва ул. Уличная, д. 2</b>.
                                  </p>
          
                                  <p>
                                      Самовывоз - это отличная возможность сэкономить время на доставку и забрать заказ лично,
                                      наслаждаясь удобством и комфортом.
                                  </p>
          
                                  <p>
                                      Необходимо только приехать за вашим заказом и назвать номер заказа. Мы будем
                                      ждать вас с радостью!
                                  </p>
                                 <p>
                                      Номер телефона:
              
                                      <b>+7-123-456-78-90</b>
                                 </p>
          
                                 <p>
                                      Время работы:
              
                                      <b>Пн - Сб | 9:00 - 21:00</b>
                                 </p>
                              </div>
                          </div>
                      </div>';
                } else {
                    echo "<p class='noproduct'>Пусто</p>";
                    echo "<input type='hidden' name='cart' value='false'>";
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
    <script src="assets/js/profile.js"></script>


</body>

</html>