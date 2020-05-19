<?php
require __DIR__. '/__cred.php';
require __DIR__. '/__connect_db.php';

//如果有拿到sid，就把它轉換成整數；如果沒有，就給它0
$mNo = isset($_GET['mNo']) ? intval($_GET['mNo']) : 0;

$pdo->query("DELETE FROM `lessee` WHERE `mNo`=$mNo");

$goto = 'm_list.php'; //讓$goto有一個 預設值

if(isset($_SERVER['HTTP_REFERER'])){ //如果有設定 (可以看是從哪一個網頁連過來的)
    $goto = $_SERVER['HTTP_REFERER']; //就回到來源的那一頁
}

header("Location: $goto"); //刪完資料以後，重新導向$goto這個變數所代表的頁面