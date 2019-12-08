<?php 
    require "db.php";
    if($_SESSION['user_info']->admin){
        echo "Hello";
    }
?>