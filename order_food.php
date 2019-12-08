<?php 
    error_reporting(0);
    require "db.php";
    $data = $_POST;
    $error = array();

    if(isset($data['do_order_food'])){
        if(empty($data['quantity'])){
            $error[] = "Введите количество еды";
        }
        if(empty($data['food'])){
            $error[] = "Выберите еду";
        }
        if(empty($data['table'])){
            $error[] = "Выберите стол";
        }
        if(empty($error)){
            $dish = R::dispense("orderfood");
            $meal = R::findOne("dishes","name = ?", array($data['food']));
            $dish->dishid = $meal->id;
            $dish->tablenumber = $data['table'];
            $dish->quantity = $data['quantity'];
            $dish->orderedby = $_SESSION['user_info']->id;
            R::store($dish);
            $_SESSION['cost'] += $data['quantity'] * $meal->price;
            echo "Общая цена вашего заказа составляет: &nbsp;" . $_SESSION['cost'];
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
    <title>Заказ еды | Pleasure</title>
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
    </style>
</head>
<body>
    <div class="order_food">
        <h1>Заказ еды</h1>
        <form action="order_food.php" id="order_food" method="post">
            <select name="food" id="food">
                <?php 
                    $foods = R::findAll("dishes");

                    foreach($foods as $food){
                        echo "<option value = '$food->name'> $food->name ($food->price тг)</option>";
                    }
                ?>
            </select>
            <br><br>
            <select name="table" id="table">
                <?php
                    $tables = R::find("ordertable","orderedby = ?",array($_SESSION['user_info']->id));

                    foreach($tables as $table){
                        echo "<option value = '$table->number'> $table->number </option>";
                    }
                ?>
            </select>
            <br><br>
            <label for="quantity">Введите количество</label><br><br>
            <input type="number" name="quantity" id="quantity">
            <br><br>
            <button type="submit" name="do_order_food">Заказать еды</button>
        </form>
    </div>
</body>
</html>