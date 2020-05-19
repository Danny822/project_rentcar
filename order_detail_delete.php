<?php
//require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';

$listNo = isset($_GET['listNo'])? intval($_GET['listNo']):0;

$pdo->query("DELETE FROM `order_detail` WHERE `listNo`= $listNo");

$goto = 'order_detail_list.php'; //預設值

/* $_SERVER['HTTP_REFERER'] 獲取前一頁面的URL地址*/
if(isset($_SERVER['HTTP_REFERER'])){
    $goto =$_SERVER['HTTP_REFERER'];
}

/* PHP執行轉跳頁面 */
header("Location: $goto");