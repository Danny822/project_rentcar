<?php
if(! isset($_SESSION)){ //先判斷session有沒有啟動
    session_start();    //如果沒有 就在此啟動session
}

if(! isset($_SESSION['admin'])){
    header('Location: login.php'); //如果沒有admin這個session 就導向登入頁
    exit;
}