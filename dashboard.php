<?php 
    error_reporting(0);
    require "db.php";
    $data = $_POST;
    $error = array();

    function output_table(){
        echo "<table border=\"1px\">
            <caption style = \"font-size:28px\">Заказанные столы</caption>
            <tr>
                <th>Номер стола</th>
                <th>Дата</th>
                <th>Время</th>
                <th>Фамилия и имя заказчика</th>
                <th>Телефон</th>
            </tr>";
        $tables = R::findAll("ordertable");
        foreach($tables as $table){
            $user = R::findOne("users","id = ?",array($table->orderedby));
            echo "<tr><td>$table->number</td><td>$table->date</td><td>$table->time</td><td>$user->surname $user->name</td><td>$user->phone</td></tr>";
        }
    }

    function output_food(){
        echo "<table border=\"1px\">
            <caption style = \"font-size:28px\">Заказанные еда</caption>
            <tr>
                <th>Название</th>
                <th>Количество</th>
                <th>Номер стола</th>
                <th>Фамилия и имя заказчика</th>
                <th>Телефон</th>
            </tr>";
        $foods = R::findAll("orderfood");
        foreach($foods as $food){
            $meal = R::findOne("dishes","id = ?",array($food->dishid));
            $user = R::findOne("users","id = ?",array($food->orderedby));
            echo "<tr><td>$meal->name</td><td>$food->quantity</td><td>$food->tablenumber</td><td>$user->surname $user->name</td><td>$user->phone</td></tr>";
        }
    }
    
    if(isset($data['add_foodtype'])){
        if(empty(trim($data['foodtype']))){
            $error[] = "Введите название типа";
        }
        if(empty($error)){
            $typ = R::dispense("types");
            $typ->name = $data['foodtype'];
            R::store($typ);
        } else {
            echo "<div style=\"color: red; font-size: 16px;\">".array_shift($error)."</div>";
        }
    }

    if(isset($data['add_food'])){
        if(empty($data['typefood'])){
            $error[] = "Выберите тип";
        }
        if(empty($data['food'])){
            $error[] = "Введите название еды";
        }
        if(empty($data['price'])){
            $error[] = "Введите цену еды";
        }
        if(empty($error)){
            $food = R::dispense("dishes");
            $food->name = $data['food'];
            $food->price = $data['price'];
            $food->type = $data['typefood'];
            R::store($food);
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
    <title>Dashboard | Pleasure</title>
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
    </style>
</head>
<body>
    <?php 
        if($_SESSION['user_info']->admin){           
    ?>
    <h1>Добавить тип еды</h1>
    <form action="dashboard.php" method="post">
        <label for="foodtype">Название типа</label><br><br>
        <input type="text" name="foodtype" id="foodtype"><br><br>
        <button type="submit" name="add_foodtype">Добавить</button>
    </form> 

    <h1>Добавить еды</h1>
    <form action="dashboard.php" method="post">
        <label for="typefood">Тип еды</label><br><br>
        <select name="typefood" id="typefood">
            <?php 
                $types = R::findAll("types");

                foreach($types as $type){
                    echo "<option value = '$type->id'> $type->name </option>";
                }
            ?>
        </select><br><br>
        <label for="food">Название еды</label><br><br>
        <input type="text" name="food" id="food"><br><br>
        <label for="price">Цена</label><br><br>
        <input type="number" name="price" id="price"><br><br>
        <button type="submit" name="add_food">Добавить</button>
    </form> 
    <?php 
            output_food(); 
            output_table();
        }
    ?>
</body>
</html>