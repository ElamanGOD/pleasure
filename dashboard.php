<?php 
    require "db.php";

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
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard | Pleasure</title>
</head>
<body>
    <?php 
        if($_SESSION['user_info']->admin){
            output_food();
            output_table();            
        }
    ?>
</body>
</html>