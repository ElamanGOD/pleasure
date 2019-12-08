<?php 
    require "db.php";
    $data = $_POST;
    $error = array();

    if(isset($data['do_signup'])){
        if(empty(trim($data['name']))){
            $error[] = "Введите имя";
        }
        if(empty(trim($data['surname']))){
            $error[] = "Введите фамилию";
        }
        if(empty(trim($data['email']))){
            $error[] = "Введите e-mail";
        }
        $find_email = R::findOne("users","email = ?",array($data['email']));
        if($find_email){
            $error[] = "Пользователь с таким e-mail зарегистрирован";
        }
        if(empty($data['password1'])){
            $error[] = "Введите пароль";
        }
        if(strlen($data['password1']) < 8){
            $error[] = "Минимальная длина пароля 8 символов";
        }
        if(($data['password1']) != ($data['password2'])){
            $error[] = "Пароли не совпадают";
        }
        if(empty(trim($data['phone']))){
            $error[] = "Введите номер телефона";
        }

        if(empty($error)){
            $user = R::dispense("users");
            $user->name = $data['name'];
            $user->surname = $data['surname'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password1'], PASSWORD_DEFAULT);
            $user->phone = "+7" . $data['phone'];
            $user->admin = false;
            R::store($user);
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
    <title>Регистрация | Pleasure</title>
    <style>
        #code{
            display: inline-block;
            width:20px;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
    </style>
</head>
<body>
    <div class="registration">
        <h1>Регистрация</h1>
        <form action="signup.php" method="post">
            <label for="name">Введите ваше имя</label><br>
            <input type="text" name="name"><br><br>
            <label for="surname">Введите вашу фамилию</label><br>
            <input type="text" name="surname"><br><br>
            <label for="email">Введите ваш e-mail</label><br>
            <input type="email" name="email" id="email"><br><br>
            <label for="password1">Введите ваш пароль</label><br>
            <input type="password" name="password1" id="password1"><br><br>
            <label for="password2">Повторно введите ваш пароль</label><br>
            <input type="password" name="password2" id="password2"><br><br>
            <label for="phone">Введите ваш номер телефона</label><br>
            <input type="text" value="+7" readonly id="code"><input type="number" name="phone" id="phone"><br><br>
            <button type="submit" name="do_signup">Регистрация</button>
        </form>
    </div>
</body>
</html>