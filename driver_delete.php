<?php
require __DIR__. '/__connect_db.php';

$driverNo = isset($_GET['driverNo']) ? intval($_GET['driverNo']) : 0;

$pdo->query("DELETE FROM `driver` WHERE `driverNo`=$driverNo");


$goto = 'driver_list.php'; // 預設值

if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
}

header("Location: $goto");