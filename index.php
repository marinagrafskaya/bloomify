<?php
session_start();
include 'assets/connect/db.php';
if ($_SESSION['user']['auth'] === true) {
  echo "<div class='auth' data-auth='true'></div>";
} else {
  echo "<div class='auth' data-auth='false'></div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Главная</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/media.css">
</head>

<body>
  <!-- Шапка -->

  <?php include "templates/header.php"; ?>
  <!-- Шапка -->

  <!-- Контент -->

  <div class="content">

    <section class="slideshow">
      <div class="slideshow-inner">
        <div class="slides">
          <div class="slide is-active ">
            <div class="slide-content">
              <div class="caption">
                <div class="title">Двойная радость</div>
                <div class="text">
                  <p>При заказе букета цветов получите скидку 20% на следующий заказ доставки.</p>
                </div>
                <a href="" class="btn btn-order">
                  <span class="btn-inner">Заказать</span>
                </a>
              </div>
            </div>
            <div class="image-container">
              <img src="assets/img/slide1.png" alt="" class="image" />
            </div>
          </div>
          <div class="slide">
            <div class="slide-content">
              <div class="caption">
                <div class="title">Сюрприз дня</div>
                <div class="text">
                  <p>Каждый день случайный букет цветов со скидкой для быстрых покупателей.</p>
                </div>
                <a href="" class="btn btn-order">
                  <span class="btn-inner">Заказать</span>
                </a>
              </div>
            </div>
            <div class="image-container">
              <img src="assets/img/slide2.png" alt="" class="image" />
            </div>
          </div>
          <div class="slide">
            <div class="slide-content">
              <div class="caption">
                <div class="title">Специальное предложение</div>
                <div class="text">
                  <p>Для новых клиентов: первый заказ с доставкой цветов со скидкой 10%.</p>
                </div>
                <a href="" class="btn btn-order">
                  <span class="btn-inner">Заказать</span>
                </a>
              </div>
            </div>
            <div class="image-container">
              <img src="assets/img/slide3.jpg" alt="" class="image" />
            </div>
          </div>
          <div class="slide">
            <div class="slide-content">
              <div class="caption">
                <div class="title">Букет недели</div>
                <div class="text">
                  <p>Каждую неделю выбирайте один из самых популярных букетов со скидкой.</p>
                </div>
                <a href="" class="btn btn-order">
                  <span class="btn-inner">Заказать</span>
                </a>
              </div>
            </div>
            <div class="image-container">
              <img src="assets/img/slide4.jpg" alt="" class="image" />
            </div>
          </div>
        </div>
        <div class="pagination">
          <div class="item is-active">
            <span class="icon">1</span>
          </div>
          <div class="item">
            <span class="icon">2</span>
          </div>
          <div class="item">
            <span class="icon">3</span>
          </div>
          <div class="item">
            <span class="icon">4</span>
          </div>
        </div>
        <div class="arrows">
          <div class="arrow prev">
            <div class="svg svg-arrow-left">
              <img src='assets/img/2735072.png'>
              <span class="alt sr-only"></span>
            </div>
          </div>
          <div class="arrow next">
            <div class="svg svg-arrow-right">
              <img src='assets/img/2735071.png'>
              <span class="alt sr-only"></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="features">

      <div class="conteiner">

        <div class="features-item">
          <div class="features-img"><img src="assets/img/7615749.png"></div>
          <diV class="features-text">Бесплатная доставка</diV>
        </div>

        <div class="features-item">
          <div class="features-img"><img src="assets/img/482541.png"></div>
          <diV class="features-text">Оплата при получении</diV>
        </div>

        <div class="features-item">
          <div class="features-img"><img src="assets/img/4098381.png"></div>
          <diV class="features-text">Только свежие цветы</diV>
        </div>

        <div class="features-item">
          <div class="features-img"><img src="assets/img/13368107.png"></div>
          <diV class="features-text">Фото цветов перед отправкой</diV>
        </div>

      </div>

    </section>
    <div class="conteiner">
      <section id="product">
        <?php
        $page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $limit = 6;
        $offset = $limit * ($page - 1);
        $data1 = $db->prepare("SELECT COUNT(*) FROM `products`");
        $data1->execute();
        $result = $data1->fetchColumn();
        $total_pages = ceil($result / $limit);
        $data2 = $db->prepare("SELECT * FROM `products` LIMIT $limit OFFSET $offset");
        $data2->execute();
        $result = $data2->fetchAll();
        foreach ($result as $row) {
          $id = $row["id_product"];
          $title = $row["title"];
          $price = $row["price"];
          $foto = $row["foto"];
          $quantity = $row["quantity"];
          $category = $row["category"];
          echo '<div class="itemproduct">
              <input type="hidden" name="tovar" value="' . $id . '">
              <input type="hidden" name="category" value="' . $category . '">
              <input type="hidden" name="quantity" value="' . $quantity . '">
              <div class="img""><img src="assets/img/' . $foto . '"></div>
              <h3>' . $title . '</h3>
              <div class="infoproduct">
                <p class="product-price">' . $price . ' ₽</p>';
          if ($_SESSION['user']['auth'] === true) {
            if ($quantity > 0) {
              echo '<p class="button-basket auth-b" onclick="reset(' . $id . ', event )">В корзину</p>';
            } else {
              echo '<p class="auth-b">Нет в наличии</p>';
            }
          }
          echo "</div>";
          echo "</div>";
        }
        ?>

      </section>
      <div class="wrapper-pagination">
        <ul class="pagination">
          <?php if ($page > 1): ?>
            <li>
              <a href="?page=<?php echo ($page - 1); ?>"><img src="assets/img/8045240.png"></a>
            </li>
          <?php endif; ?>
          <?php if ($page < $total_pages): ?>
            <li>
              <a href="?page=<?php echo ($page + 1); ?>"><img src="assets/img/8045249.png"></a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

  </div>
  <!--Подвал -->


  <?php include 'templates/footer.html'; ?>

  <!--Подвал ;-->
  <script src="assets/js/menu.js"></script>
  <script src="assets/js/product.js"></script>
  <script src="assets/js/jquery-1.10.1.js"></script>
  <script src="assets/js/TweenMax.min.js"></script>
  <script src="assets/js/slider.js"></script>
  <script src="assets/js/addbasket.js"></script>
  <script src="assets/js/filter.js"></script>
</body>

</html>