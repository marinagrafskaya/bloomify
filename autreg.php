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

   <!-- Форма авторизации --> 

   <form class="aut-form">
    <label>Логин</label>
    <div class="border-input"><input type="text" name="login"></div>
    <label>Пароль</label>
    <div class="border-input"><input type="password" name="password"></div>
    <div><input type="submit" class="submit-aut-reg login-button"  value="Войти"></div> 
    <p>У вас нет аккаунта? - <a href="register.php">Зарегистрироваться</a></p>
    <p class="message none"></p>
   </form>

 
<script src="assets/js/aut.js"></script>


</body>
</html>