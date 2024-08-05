<?php
session_start();
include 'assets/connect/db.php';
?>
<header>
    <div class="conteiner">
        <a class="logo" href="index.php"><img src="assets/img/Bloomify-logo.png"></a>
        <div class="menu">
            <div class="btn-menu"><img src='assets/img/4254068.png'></a></div>
            <div class="mein-nav">
                <div>
                    <form id="pick-up-point">
                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['user']['id'] ?>">
                        <select name="pick-up-point">
                            <?php
                            $data = $db->prepare("SELECT * FROM `pick-up-point`");
                            $data->execute();
                            $result = $data->fetchAll();
                            foreach ($result as $row) {
                                $id = $row["id"];
                                $address = $row["address"];
                                echo '<option value="' . $id . '"> ' . $address . '</option>';
                            }
                            ?>
                        </select>
                    </form>
                </div>
                <div><a href="index.php">О нас</a></div>
                <div><a href="catalog.php">Каталог</a></div>
                <div><a href="to-find.php">Контакты</a></div>
            </div>
            <div class="additional-menu">
                <?php
                if (isset($_SESSION['user']) && $_SESSION['user']['auth'] === true) {
                    echo "<div><a href='profile.php'><img src='assets/img/743131.png'><span>Корзина<span></a></div>
                        <div><a href='order.php'><img src='assets/img/3139110.png'><span>Заказы<span></a></div>
                       <div><a href='actions/logout.php'><img src='assets/img/149409.png'><span>Выход<span></a></div>";
                } else {
                    echo "
                     <div><a href='autreg.php'><img src='assets/img/2321232.png'><span>Вход<span></a></div>";
                }
                ?>
            </div>

        </div>
    </div>
</header>