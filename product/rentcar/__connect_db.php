<?php

$db_host="localhost";
$db_name="car_rental";
$db_user="root";
$db_pass="admin02";

$dsn="mysql:host={$db_host};dbname={$db_name}";

try{

    $pdo= new PDO($dsn,$db_user,$db_pass);
    $pdo->query("SET NAMES utf8");
    
}catch(PDOException $ex){
    echo "error".$ex->getMessage();
}

if(!isset($_SESSION)){
    session_start();
}




