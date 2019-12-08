<?php 
    require "db.php";
    $data = $_POST;
    $error = array();

    if(isset($data['do_login'])){
        if(empty(trim($data['email']))){
            $error[] = "Введите e-mail";
        }
        if(empty(trim($data['password']))){
            $error[] = "Введите пароль";
        }
        if(empty($error)){
            $user = R::findOne("users","email = ?", array($data['email']));
            if($user){
                if(password_verify($data['password'], $user->password)){
                    $_SESSION['user_info'] = $user;
                    header("Location: index.php");
                    die();
                } else {
                    echo "<div style=\"color: red; font-size: 16px;\">Не правильно введен пароль</div>";
                }
            } else {
                echo "<div style=\"color: red; font-size: 16px;\">Пользователь с таким e-mail не зарегистрирован</div>";
            }
        } else {
            echo "<div style=\"color: red; font-size: 16px;\">".array_shift($error)."</div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация | Pleasure</title>
</head>
<body>
    <div class="login">
        <h1>Авторизация</h1>
        <form action="login.php" method="post">
            <label for="email">Введите e-mail</label><br>
            <input type="email" name="email" id="email"><br><br>
            <label for="password">Введите пароль</label><br>
            <input type="password" name="password" id="password"><br><br>
            <button type="submit" name="do_login">Авторизация</button>
        </form>
    </div>
</body>
</html>