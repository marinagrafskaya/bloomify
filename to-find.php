<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
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
            <h1>Контакты</h1>
            <p class="text-to-find">Вдохновляйтесь красотой цветов и делитесь своими желаниями с нами!</p>
            <div class="wrapper-find">
                <div class="find contacts">
                    <p><b>Адрес: </b><br> г. Москва ул. Уличная, д. 2 </p>

                    <p><b>Номер телефона: </b><br> +7-123-456-78-90 </p>

                    <p><b>Время работы: </b><br>Пн - Сб | 9:00 - 21:00 </p>

                    <p><b>Email: </b><br>  gmail@gmail.com </p>
                </div>
            </div>
            <div class="find">
                <div class="conteiner">
                    <div class="find-img">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d483667.1101949819!2d37.04779869288206!3d55.72725709058419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54afc73d4b0c9%3A0x3d44d6cc5757cf4c!2z0JzQvtGB0LrQstCw!5e0!3m2!1sru!2sru!4v1708193254413!5m2!1sru!2sru"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Контент -->

    <!--Подвал -->


    <?php include 'templates/footer.html'; ?>

    <!--Подвал -->
    <script src="assets/js/menu.js"></script>
</body>

</html>