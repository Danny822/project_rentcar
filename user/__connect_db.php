<?php

$db_host = 'localhost';
$db_name = 'car_rental';
$db_user = 'kexy';
$db_pass = '12345';

$dsn = "mysql:host={$db_host};dbname={$db_name}";

try {
    $pdo = new PDO($dsn, $db_user, $db_pass);

    // 連線使用的編碼設定
    $pdo->query("SET NAMES utf8");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $sx){
    echo 'Error: '. $sx->getMessage();
}

if(! isset($_SESSION)){
    session_start();
}