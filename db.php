<?php
    require "libs/rb.php";
    R::setup( 'mysql:host=localhost;dbname=pleasure',
        'root', '' );
    $testconnection = R::testConnection();
    if(!$testconnection){
        echo "Нету подключения к базе данных";
    } 
    session_start();
?>