<?php 
    require "db.php";
    $data = $_POST;
    $error = array();

    if(isset($data['do_order'])){
        if(empty($data['table'])){
            $error[] = "Введите номер стола";
        }
        if(empty($data['date'])){
            $error[] = "Выберите дату";
        }
        if(empty($data['time'])){
            $error[] = "Выберите время";
        }
        if(empty($error)){
            $table = R::dispense("ordertable");
            $table->number = $data['table'];
            $table->date = $data['date'];
            $table->time = $data['time'];
            $table->orderedby = $_SESSION['user_info']->id;
            R::store($table);
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
    <title>Заказ стола | Pleasure</title>
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=date]::-webkit-inner-spin-button, 
        input[type=date]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        input[type=time]::-webkit-inner-spin-button, 
        input[type=time]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
    </style>
</head>
<body>
    <div class="order_table">
        <h1>Заказ стола</h1>
        <form action="order_table.php" method="post" id="order_table">
            <label for="table">Введите номер стола</label><br>
            <input type="number" name="table" id="table"><br><br>
            <label for="date">Выберите дату бронирования</label><br>
            <input type="date" name="date" id="date"><br><br>
            <label for="time">Выберите дату бронирования</label><br>
            <input type="time" name="time" id="time"><br><br>
            <button type="submit" name="do_order">Заказать стол</button>
        </form>
    </div>
</body>
</html>