<?php
require __DIR__. '/__cred.php';
require __DIR__. '/__connect.php';
$adNo= isset($_GET['adNo'])? intval($_GET['adNo']) : 0 ;

$pdo->query("DELETE FROM `advertisement` WHERE `advertisement`.`adNo` = $adNo");
$goto ='__ad_list.php';
if(isset($_SERVER['HTTP_REFERER'])){
    $goto = $_SERVER['HTTP_REFERER'];
}

    header("Location: $goto");
