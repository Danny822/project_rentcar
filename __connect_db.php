<?php

// $db_host = '192.168.27.44';
// $db_name = 'car_rental';
// $db_user = 'root';
// $db_pass = '-4g.3tk g; yj ru,4';
$db_host = 'localhost';
$db_name = 'car_rental';
$db_user = 'danny';
$db_pass = '1234';

$dsn = "mysql:host={$db_host};dbname={$db_name}";

try {

    $pdo = new PDO($dsn, $db_user, $db_pass);

    $pdo->query("SET NAMES utf8");

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $err) {
    echo 'Error: ' . $err->getMessage();
}

if (!isset($_SESSION)) {
    session_start();
}