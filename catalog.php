<?php
session_start();
include 'assets/connect/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Каталог</title>
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
      <div class="sort-filter">
        <div class="search">
        <input type="text" name="search" placeholder="Поиск...">
      </div>
        <div class="border-input">
          <select class="sort">
            <option value="" disabled selected>Сортировка:</option>
            <option value="Title">Наименование</option>
            <option value="Price">Цена</option>

          </select>
        </div>
        <div class="border-input">
          <select class="filter">
            <option value="" selected disabled>Фильтрация по категориям</option>
            <?php
            $data = $db->prepare("SELECT * FROM `сategory`");
            $data->execute();
            $result = $data->fetchAll();
            foreach ($result as $row) {
              $сategory = $row["Сategory"];
              echo '<option value="' . $сategory . '"> ' . $сategory . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div id="product">
        <?php
        $data = $db->prepare("SELECT * FROM `products`");
        $data->execute();
        $result = $data->fetchAll();
        foreach ($result as $row) {
          $id = $row["id_product"];
          $title = $row["title"];
          $price = $row["price"];
          $foto = $row["foto"];
          $quantity = $row["quantity"];
          $category = $row["category"];
          echo '<div class="itemproduct" data-search="'. $title .'">
              <input type="hidden" name="tovar" value="' . $id . '">
              <input type="hidden" name="category" value="' . $category . '">
              <input type="hidden" name="quantity" value="' . $quantity . '">
              <div class="img""><img src="assets/img/' . $foto . '"></div>
              <h3>' . $title . '</h3>
              <div class="infoproduct">
                <p class="product-price">' . $price . ' ₽</p>';
                if ($_SESSION['user']['auth'] === true) {
                if($quantity > 0) {
                  echo '<p class="button-basket auth-b" onclick="reset(' . $id . ', event )">В корзину</p>';
                } else {
                  echo '<p class="auth-b">Нет в наличии</p>';
                }
              }
                echo "</div>";
                echo "</div>";
        }
        ?>
      </div>
    </div>
  </div>


  <!--Контент -->

  <!--Подвал -->

  <?php include 'templates/footer.html'; ?>


  <!--Подвал -->
  <script src="assets/js/menu.js"></script>
  <script src="assets/js/filter.js"></script>
  <script src="assets/js/addbasket.js"></script>
  <script src="assets/js/search.js"></script>
</body>

</html>