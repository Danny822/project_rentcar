<?php

require __DIR__. "/__connect_db.php";
$per_page=5;

$result=[
    "success"=>false,
    "page"=>0,
    "totalRows"=>0,
    "perPage"=>$per_page,
    "totalPages"=>0,
    "data"=>[],
    "errorCode"=>0,
    "errorMsg"=>"",
];
$page=isset($_GET["page"])? intval($_GET["page"]): 1;

$t_sql="SELECT COUNT(1) FROM commodity";
$t_stmt=$pdo->query($t_sql);
$total_rows=$t_stmt->fetch(PDO::FETCH_NUM)[0];
$result["totalRows"]=intval($total_rows);

$total_pages=ceil($total_rows/$per_page);
$result["totalPages"]=$total_pages;

if($page<1)$page=1;
if($page>$total_pages)$page=$total_pages;
$result["page"]=$page;

$sql=sprintf("SELECT *FROM commodity ORDER BY pNO DESC LIMIT %s,%s",($page-1)*$per_page,$per_page );
$stmt=$pdo->query($sql);
$result["data"]=$stmt->fetchAll(PDO::FETCH_ASSOC);
$result["success"]=true;

echo json_encode($result, JSON_UNESCAPED_UNICODE);





?>