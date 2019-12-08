<?php 
    error_reporting(0);
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
    <?php 
        if($_SESSION['user_info']->admin == 1){
            echo "<a href=\"dashboard.php\">Админ панель</a><br>";
        }
        if($_SESSION['user_info']){
            echo "<a href=\"order_table.php\">Заказать стол</a><br>";
            echo "<a href=\"order_food.php\">Заказать еды</a><br>";
            echo "<a href=\"logout.php\">Выйти</a><br>";
        } else {
            echo "<a href=\"login.php\">Авторизоваться</a><br>";
            echo "<a href=\"signup.php\">Зарегистрироваться</a><br>";
        }
    ?>
</body>
</html>