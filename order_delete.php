<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';

$orderNo = isset($_GET['orderNo'])? intval($_GET['orderNo']):0;

$pdo->query("DELETE FROM `order` WHERE `orderNo`=$orderNo");

$goto = 'order_list.php'; //預設值

/* $_SERVER['HTTP_REFERER'] 獲取前一頁面的URL地址*/
if(isset($_SERVER['HTTP_REFERER'])){
    $goto =$_SERVER['HTTP_REFERER'];
}

/* PHP執行轉跳頁面 */
header("Location: $goto");