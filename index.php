<?php 
    require "db.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ресторан "Pleasure"</title>
</head>
<body>
    <a href="login.php">Авторизоваться</a><br>
    <a href="signup.php">Зарегистрироваться</a><br>
    <?php 
        if($_SESSION['user_info']->admin == 1){
            echo "<a href=\"dashboard.php\">Админ панель</a><br>";
        }
        if($_SESSION['user_info']){
            echo "<a href=\"order.php\">Заказать стол</a><br>";
        }
    ?>
</body>
</html>