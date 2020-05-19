<?php

require __DIR__. '/__connect_db.php';

$couponNo = isset($_GET['couponNo']) ? intval($_GET['couponNo']) : 0;

$pdo->query("DELETE FROM `coupon` WHERE `couponNo`=$couponNo");


$goto = 'ming_data_list.php'; // 預設值

if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
}

header("Location: $goto");
