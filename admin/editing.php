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
    <title>Редактировать</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media.css">
    <style>

    </style>
</head>

<body>

    <!-- Шапка -->

    <?php include "templates/header.php"; ?>
    <!-- Шапка -->
    <div class="content">
        <div class='conteiner'>
            <h2>Редактировать</h2>
            <?php
            $id = $_POST["id"];
            $sql = "SELECT * FROM `products` WHERE `id_product` = $id;";
            $result = $db->query($sql);
            $result = $result->fetchAll();
            foreach ($result as $row) {
                $id = $row["id_product"];
                $title = $row["title"];
                $price = $row["price"];
                $foto = $row["foto"];
                $category = $row["category"];
                $country = $row["country"];
                $year = $row["year"];
                $model = $row["model"];
                $quantity = $row["quantity"];
                echo  "
                <input type='hidden' name='id' value='" . $id . "'>
             <div class='grid-characteristics'>
             <div>
             <p>Фото:</p>
             <label for='file' class='foto-editing' >
         <div class='img'><img src='../assets/img/" . $foto . "' alt='Добавьте фото'></div>
         <input type='file' class='file' name='foto' value = '" . $foto . "' id='file' placeholder='Фото' size='400px'>
         </label>
             </div>
             <div>
             <p>Название:</p>
             <p><input type='text' name='title' value='" . $title . "'></p>
             </div> 
             <div>
             <p>Категория:</p>
             <p><select name='category'>";
             echo "<option value='$category'>$category</option>";
             $sql = "SELECT * FROM `сategory` WHERE `Сategory` != '$category';";
             $result = $db->query($sql);
             $result = $result->fetchAll();
             foreach ($result as $row) {
                 $category = $row["Сategory"];
                 echo "<option value='$category'>$category</option>";
             }
            echo "
         </select></p>
             </div> 
             <div>
             <p>Цена (₽):</p>
             <p><input type='number' name='price' value='" . $price . "'></p>
             </div> 
             <div>
             <p>Количество (шт):</p>
             <p><input type='number' name='quantity' min='1' value='" . $quantity . "'></p>
             </div> 
         </div>";
            }
           
          
            ?>
             <div class="editing-product-btn btn">Изменить</div>
        </div>
    </div>

    <!--Подвал -->


    <?php include 'templates/footer.html'; ?>

    <!--Подвал ;-->
    <script src="../assets/js/menu.js"></script>
    <script src="assets/js/editing.js"></script>
</body>

</html>