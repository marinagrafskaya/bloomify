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
    <title>Товары</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media.css">
</head>

<body>
    <!-- Шапка -->

    <?php include "templates/header.php"; ?>
    <!-- Шапка -->

    <div class="content">
        <div class="conteiner">
            <div class="add-product">
                <h2>Добавить товар</h2>
                <div class="grid-add-product">
                    <label for="foto" class="foto-add">
                        <div class="img"><img src="" alt="Добавьте фото"></div>
                        <input type="file" class="file" id="foto" name="foto" placeholder="Фото" size="400px">
                    </label>
                    <div class="left-add-colum">
                        <div class="frame">
                            <input type="text" name="title" placeholder="Название товара">
                        </div>
                        <div class="frame">
                            <input type="text" name="price" placeholder="Цена">
                        </div>
                        <div class="frame">
                            <input type="text" name="quantity" placeholder="Количество">
                        </div>
                        <div class="frame">
                        <select name="category">
                            <option value="" selected disabled>Категория</option>
                            <?php
                            $sql = "SELECT * FROM `сategory`";
                            $data = $db->query($sql);
                            $result = $data->fetchAll();
                            foreach ($result as $row) {
                                $category = $row["Сategory"];
                                echo "<option value='$category'>$category</option>";
                            }
                            ?>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="add-product-btn btn">Добавить</div>
            </div>

            <div class="category">
                <h2>Добавить категорию</h2>
                <div>
                    <div class="frame">
                        <input type="text" name="categoty" placeholder="Категория">
                    </div>
                    <div class="add-category-btn btn">Добавить</div>
                </div>
                <h2>Удалить категорию</h2>
                <div>
                    <div class="frame">
                        <select name="removecategoty">
                            <?php
                            $sql = "SELECT * FROM `сategory`";
                            $result = $db->query($sql);
                            $result = $result->fetchAll();
                            foreach ($result as $row) {
                                $category = $row["Сategory"];
                                echo "<option value='$category'>$category</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="remove-category-btn btn">Удалить</div>
                </div>
            </div>
                
            <div id="product">
                <h2>Товары</h2>
                <div class="product-table">
                    <?php
                    $sql = "SELECT * FROM `products`";
                    $result = $db->query($sql);
                    $result = $result->fetchAll();
                    foreach ($result as $row) {
                        $id = $row["id_product"];
                        $title = $row["title"];
                        $price = $row["price"];
                        $foto = $row["foto"];
                        $category = $row["category"];
                        $quantity = $row["quantity"];
                        echo '
                        <div><span>ID:</span><span> ' . $id . '</span></div>  
                     <div><span>Название:</span><span> ' . $title . '</span></div>
                     <div><span>Цена:</span><span> ' . $price . ' ₽</span></div>
                     <div class="img"><img src="../assets/img/' . $foto . '"></div>
                     <div><span>Категория:</span><span> ' . $category . '</span></div>
                     <div><span>Кол-во:</span><span> ' . $quantity . ' шт</span></div>
                     <div><form>
                     <input type="submit" data-idproduct="'.$id.'" class="removeproduct" value="Удалить">
                     </form>
                     <form action="editing.php" method="post" class="form-editing">
                     <input type="hidden" name="id" value="' . $id . '">
                     <input type="submit" value="Редактировать" >
                     </form></div>
                     ';
                    }
                    ?>
                </div>
            </div>
       
        </div>
    </div>

    <!-- Товары -->

    <!-- Контент -->

    <?php include "templates/footer.html"; ?>

    
    <script src="../assets/js/menu.js"></script>
    <script src="assets/js/index.js"></script>


</body>

</html>