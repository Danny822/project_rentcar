<?php

$db_host = 'localhost';
$db_name = 'coupon';
$db_user = 'adaptor2006';
$db_pass = 'test';

$dsn = "mysql:host={$db_host};dbname={$db_name}";




try{

    $pdo = new PDO($dsn, $db_user, $db_pass);

    $pdo->query("SET NAMES utf8");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $ex){
    echo 'Error: '. $ex->getMessage();
}