<?php
//require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [], //做echo檢查
];

$orderNo = isset($_POST['orderNo']) ? intval($_POST['orderNo']) : 0;

if (isset($_POST['mNo']) and !empty($orderNo)) {

    //1.修改資料之前可以先確認該筆資料是否存在

    $mNo = $_POST['mNo'];
    $mName = $_POST['mName'];
    $orderDate = $_POST['orderDate'];
    $total = $_POST['total'];

    $result['post'] = $_POST; //做echo檢查

    if (empty($mNo) or empty($mName) or empty($orderDate)) {
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // TODO: 檢查 name 長度

    // TODO: 檢查 email 格式
    // if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    //      $result['errorCode'] = 405;
    //     $result['errorMsg'] = 'Email 格式不正確';
    //     echo json_encode($result,JSON_UNESCAPED_UNICODE);
    //     exit;
    // }

    // TODO: 檢查 mobile 格式

    // 1. 修改資料之前可以先確認該筆資料是否存在
    // 2. Email 有沒有跟別筆的資料相同
    $s_sql = "SELECT * FROM `order` WHERE `orderNo`=? OR `mNo`=?";
    $s_stmt = $pdo->prepare($s_sql);
    $s_stmt->execute([$orderNo, $_POST['mNo']]);

    switch ($s_stmt->rowCount()) {
        case 0:
            $result['errorCode'] = 410;
            $result['errorMsg'] = '該筆資料不存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
            break;
        // case 2:
        //     $result['errorCode'] = 420;
        //     $result['errorMsg'] = 'Email 已存在';
        //     echo json_encode($result, JSON_UNESCAPED_UNICODE);
        //     exit;
        case 1:
            $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['orderNo'] != $orderNo) {
                $result['errorCode'] = 430;
                $result['errorMsg'] = '訂單編號不存在';
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
            }
    }

    $sql = "UPDATE `order` SET
                `mNo`=?,
                `mName`=?,
                `orderDate`=?,
                `total`=?
                WHERE `orderNo`=?";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['mNo'],
            $_POST['mName'],
            $_POST['orderDate'],
            $_POST['total'],
            $orderNo,
        ]);

        if ($stmt->rowCount() == 1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料沒有修改';
        }
    } catch (PDOException $ex) {
        $result['errorCode'] = 403;
        $result['errorMsg'] = '資料更新發生錯誤';
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
