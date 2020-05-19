<?php
require __DIR__ . '/__connect_db.php';

$page_name = 'user_shop_list';

$per_page = 10; //一頁10筆資料

$user_shop_result = [
    'success' => false,
    'page' => 0,
    'perPage' => 0,
    'totalRows' => 0,
    'totalPages' => 0,
    'data' => [],
    'errorCode' => 0,
    'errorMsg' =>'',
];

$user_shop_page = isset($_GET['page']) ? intval($_GET['page']) : 1; //得到當前頁數用

//總筆數

$t_user_shop = "SELECT COUNT(1) FROM `user_shop`";

$t_user_shop_stmt = $pdo->query($t_user_shop);

$t_user_shop_rows = $t_user_shop_stmt->fetch(PDO::FETCH_NUM)[0];

$user_shop_result['totalRows'] = intval($t_user_shop_rows);


//總頁數

$t_user_shop_page = ceil($t_user_shop_rows/$per_page);
$user_shop_result['totalPages'] = $t_user_shop_page;

if ($user_shop_page<1) $user_shop_page=1;
if ($user_shop_page>$t_user_shop_page) $user_shop_page = $t_user_shop_page;
$user_shop_result['page'] = $user_shop_page;

$sql = sprintf("SELECT * FROM `user_shop` LIMIT %s, %s",($user_shop_page-1)*$per_page,$per_page);

$stmt = $pdo->query($sql);

//所有資料

$user_shop_result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
$user_shop_result['success'] = true;

//陣列轉json

echo json_encode($user_shop_result, JSON_UNESCAPED_UNICODE);
