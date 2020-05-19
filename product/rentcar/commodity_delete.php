<?php

require __DIR__. '/__connect_db.php';

$page_name = "commodity_delete";

$pNo = isset($_GET["pNo"])? intval($_GET["pNo"]) : 0;

$pdo->query("DELETE FROM `commodity` WHERE `pNo`=$pNo");


$goto ="commodity.php";

if(isset($_SERVER["HTTP_REFERER"])){
    $goto =$_SERVER["HTTP_REFERER"];

}
header("Location: $goto");