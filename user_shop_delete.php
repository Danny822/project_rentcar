<?php

require __DIR__. '/__cred.php';
require __DIR__ . '/__connect_db.php';

$shopNo = isset($_GET['shopNo']) ? intval($_GET['shopNo']) : 0;

$sql = $pdo->query("DELETE FROM `user_shop` WHERE `shopNo` = $shopNo");

$goTo = 'user_shop_list01.php';

if (isset($_SERVER['HTTP_REFERER'])){
    $goTo = $_SERVER['HTTP_REFERER'];
}

header("Location: $goTo");