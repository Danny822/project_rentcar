<?php

require __DIR__. '/ming__connect_db.php';

$couponSid = isset($_GET['couponSid']) ? intval($_GET['couponSid']) : 0;

$pdo->query("DELETE FROM `coupon` WHERE `couponSid`=$couponSid");


$goto = 'ming_data_list.php'; // 預設值

if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
}

header("Location: $goto");
