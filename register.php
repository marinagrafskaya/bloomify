<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Авторизация и Регистрация</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/style-aut-reg.css">
</head>

<body>

<p class="mainstr"><a href='index.php'><span>Вернуться на главную</span></a></p>

  <!-- Форма регистрации -->

  <form class="aut-form">
    <label>Имя</label>
    <div class="border-input"><input type="text" name="name"></div>
    <label>Фамилия</label>
    <div class="border-input"><input type="text" name="surname" ></div>
    <label>Отчество</label>
    <div class="border-input"><input type="text" name="patronymic" ></div>
    <label>Логин</label>
    <div class="border-input"><input type="text" name="login" ></div>
    <label>Пароль</label>
    <div class="border-input"><input type="password" name="password" ></div>
    <label>Подтверждение пароля</label>
    <div class="border-input"><input type="password" name="password_confir" ></div>
    <div><input type="submit" class="submit-aut-reg register-btn" value="ОК"></div>
    <p>У вас уже есть аккаунт? - <a href="autreg.php">Авторизироваться</a></p>
    <p class="message none"></p>
    <p class="img-loading none"></p>
  </form>

  <script src="assets/js/reg.js"></script>
</body>

</html>